<?php

namespace Site;

class Site
{
    use \MM\AddCSS;
    use \MM\AddJS;
    use \MM\CacheBuster;
    use \MM\Layout;
    use \MM\Loadable;
    use \MM\SoftSingleton;
    use \MM\Templateable;
    use \MM\Traceable;
    use \MM\URIHelper;

    private $pageTitle = [ "Sky Sister" ];

    private $version = [
        "before" => "",
        "sem" => [ 0, 4, 3],
        "after" => "",
    ];

    public function __construct()
    {
        $this->enableTrace("Enabled in constructor.");
        $this->setTemplatePath($_SERVER["DOCUMENT_ROOT"] . "/app/template");
        $this->addTemplateVariables($this->uriSegments());
    }

    public function env($var, $show = false)
    {
        $output = "$var: ";
        $value = getenv($var);
        if ($value) {
            $output .= $show ? $value : "Present! Found " . strlen($value) . " characters.";
        } else {
            $output .= "Value not present.";
        }
        return "$output\n";
    }
    
    public function pageTitle()
    {
        return implode(" :: ", $this->pageTitle);
    }

    public function addPageTitle($title)
    {
        $this->pageTitle[] = $title;
    }

    public function topBanner()
    {
        if ($_SERVER["HTTP_HOST"] == "ss-utils.localhost") {
            return $this->loadTemplate("site/header-local");
        }

        if ($_SERVER["HTTP_HOST"] == "skysister.looseaffiliations.pub") {
            return $this->loadTemplate("site/header-loose");
        }
        
        return "";
    }

    public function changes()
    {
        $entries = $_SERVER["DOCUMENT_ROOT"] . "/app/rsrc/changelog.json";
        $variables = [
            "theme" => "ssc-a",
            "entries" => json_decode(file_get_contents($entries), true),
        ];

        return $this->loadTemplate("content/changes", $variables);
    }

    public function version()
    {
        $version = $this->version;
        $version["sem"] = implode(".", $version["sem"]);
        return implode(" ", $version);
    }

    public function route()
    {
        $this->load("Site\Router")->handleRequest();
    }

    public function header()
    {
        return $this->loadTemplate("site/header");
    }

    public function footer()
    {
        return $this->loadTemplate("site/footer");
    }
}
