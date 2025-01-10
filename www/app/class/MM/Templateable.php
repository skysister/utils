<?php

namespace MM;

trait Templateable
{
    private $templatePath = __DIR__ . "/template";
    private $templateVariables = array();
    
    public function setTemplatePath($templatePath)
    {
        $this->templatePath = $templatePath;
    }
    
    public function addTemplateVariables($variables)
    {
        $this->templateVariables = array_merge($this->templateVariables, $variables);
    }
    
    public function loadTemplate($template, $variables = array())
    {
        $templatePath = $this->templatePath . "/$template.php";
        if (!file_exists($templatePath)) {
            error_log("Could not find $templatePath. Aborting.");
            return false;
        }
        
        extract(array_merge($this->templateVariables, $variables));
        
        ob_start();
        include($templatePath);
        return ob_get_clean();
    }
}
