<?php

namespace MM;

trait AddCSS
{
    public function addCSS($value, $type = "literal")
    {
        $this->addedCSS[] = [
            "type" => $type,
            "value" => $value,
        ];
    }

    public function addedCSS()
    {
        $addedCSS = "";
        if (isset($this->addedCSS)) {
            foreach ($this->addedCSS as $css) {
                switch ($css["type"]) {
                    case "literal":
                        $addedCSS .= "<style>{$css["value"]}</style>\n";
                        break;
                    case "file":
                        if (method_exists($this, "bustCSS")) {
                            $addedCSS .= $this->bustCSS($css["value"]);
                        } else {
                            $addedCSS .= "<link rel=\"stylesheet\" href=\"{$css["value"]}\">\n";
                        }
                        break;
                }
            }
        }

        return $addedCSS;
    }
}
