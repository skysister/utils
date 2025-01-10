<?php

namespace MM;

trait Traceable
{
    private static $globalTraceEnabled = true;
    protected $traceEnabled = false;
    
    public function traceIsEnabled()
    {
        return $this->traceEnabled;
    }

    public function enableTrace($message = false)
    {
        $this->traceEnabled = true;
        $this->trace($message);
    }
    
    public function disableTrace()
    {
        $this->traceEnabled = false;
    }
    
    private function convertToString($message)
    {
        if (is_array($message) || is_object($message)) {
            $message = print_r($message, true);
        }
        
        return $message;
    }
    
    public function trace($message, $type = "INFO")
    {
        // abort if not globally enabled, locally enabled or if the message is false
        if (!self::$globalTraceEnabled || !$this->traceEnabled || !isset($message) || !$message) {
            return false;
        }
        
        $path = explode("\\", get_class($this));
        $class = array_pop($path);
        $message = $this->convertToString($message);
        
        $folder    = "/tmp";
        $filestem  = "mptrace";
        $extension = ".log";
        
        $currentLogFile = "$folder/$filestem$extension";
        
        // define size variables
        $bytes  = 1;
        $kbytes = 1024 * $bytes;
        $mbytes = 1024 * $kbytes;
        
        // define threshold
        $threshold = 1 * $mbytes;
        
        // rotate when current log file is larger than threshold
        if (is_file($currentLogFile) && filesize($currentLogFile) > $threshold) {
            $indices = array("-9", "-8", "-7", "-6", "-5", "-4", "-3", "-2", "-1");
            foreach ($indices as $key => $index) {
                if ($key == 0) {
                    unlink("$folder/$filestem$index$extension");
                    continue;
                }
                rename("$folder/$filestem$index$extension", "$folder/$filestem" . $indices[$key - 1] . $extension);
            }
            rename($currentLogFile, "$folder/$filestem" . $indices[count($indices) - 1] . $extension);
        }
    
        $when = date("Y-m-d H:i:s");
        file_put_contents($currentLogFile, "$when [$type] $class: $message\n", FILE_APPEND | LOCK_EX);
    }
}
