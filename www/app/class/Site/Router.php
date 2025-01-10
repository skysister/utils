<?php

namespace Site;

class Router
{
    use \MM\URIHelper;

    public function handleRequest()
    {
        // get the request and trim off the query string
        $request = $this->uriRequest();

        // send page
        $matchingPage = $this->findPathMatchForPage($request);
        if ($matchingPage) {
            $this->sendPageAndExit($request);
        }

        // insert conditions here
        
        // last ditch effort
        $this->sendPageAndExit();
    }

    private function sendPageAndExit($page = "/home")
    {
        require $this->findPathMatchForPage($page);
        exit();
    }
    
    private function findPathMatchForPage($page)
    {
        $pagepath = $_SERVER["DOCUMENT_ROOT"] . "/app/page/$page.php";
        if (file_exists($pagepath)) {
            return $pagepath;
        }
        
        return false;
    }
}
