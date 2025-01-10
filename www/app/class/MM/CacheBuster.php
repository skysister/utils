<?php

namespace MM;

trait CacheBuster
{
    public function bustCSS($path)
    {
        return '<link rel="stylesheet" href="' . $this->getCacheBuster($path) . '">' . "\n";
    }

    public function bustJS($path, $options = "")
    {
        return '<script src="' . $this->getCacheBuster($path) . '"' . $options . '></script>' . "\n";
    }

    private function getCacheBuster($path)
    {
        if (file_exists($_SERVER["DOCUMENT_ROOT"] . $path)) {
            return "$path?d=" . filemtime($_SERVER["DOCUMENT_ROOT"] . $path);
        }
        
        return $path;
    }
}
