<?php

namespace MM;

trait AddJS
{
    protected $addedJSVariables = [];

    public function addJS($value, $type = "literal")
    {
        $this->addedJS[] = [
            "type" => $type,
            "value" => $value,
        ];
    }

    public function addJSSegments()
    {
        $this->addJSVariables(site()->segmentVariables());
    }

    public function addJSVariables($variables)
    {
        if (is_array($variables)) {
            $this->addedJSVariables += $variables;
        }
    }

    public function addedJS()
    {
        $addedJS = "";
        if (!empty($this->addedJSVariables)) {
            $addedJS .= "<script>\n";
            foreach ($this->addedJSVariables as $name => $value) {
                $addedJS .= "var $name = " . json_encode($value);
                $addedJS .= ";\n";
            }
            $addedJS .= "</script>\n";
        }
        if (isset($this->addedJS)) {
            foreach ($this->addedJS as $js) {
                switch ($js["type"]) {
                    case "literal":
                        $addedJS .= "<script>{$js["value"]}</script>\n";
                        break;
                    case "file":
                        if (method_exists($this, "bustJS")) {
                            $addedJS .= $this->bustJS($js["value"]);
                        } else {
                            $addedJS .= "<script src=\"{$js["value"]}\"></script>\n";
                        }
                        break;
                }
            }
        }

        return $addedJS;
    }
}
