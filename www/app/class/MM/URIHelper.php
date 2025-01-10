<?php

namespace MM;

trait URIHelper
{
    private function uriRequest()
    {
        return explode("?", $_SERVER["REQUEST_URI"], 2)[0];
    }

    private function uriSegments()
    {
        return $this->uriSegment("all", "seg");
    }

    private function uriSegment($segmentIdentifier, $prefix = "")
    {
        $request = $this->uriRequest();
        $segments = explode("/", $request);
        unset($segments[0]);

        if (!empty($prefix)) {
            $segments = array_combine(
                array_map(function($k) use ($prefix) { return "$prefix$k"; }, array_keys($segments)),
                $segments
            );
        }

        if ($segmentIdentifier == "all") {
            return $segments;
        }

        if (isset($segments["$prefix$segmentIdentifier"])) {
            return $segments["$prefix$segmentIdentifier"];
        }

        return null;
    }
}
