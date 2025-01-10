<?php

namespace MM;

trait Layout
{
    public function layoutInit()
    {
        // start output buffer
        ob_start();
    }

    public function layout($layout = "primary", $layoutContent = null)
    {
        // initialize variables
        $variables = [];

        // if no content is passed, get from output buffer
        if (empty($layoutContent)) {
            // capture all output into layoutContent member of template variables array
            $variables = [
                "layoutContent" => ob_get_clean(),
            ];
        } else {
            $variables = compact("layoutContent");
        }

        return $this->loadTemplate("layout/$layout", $variables);
    }
}
