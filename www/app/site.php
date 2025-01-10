<?php

if (!function_exists("site")) {
    function site()
    {
        return Site\Site::instance();
    }
}
