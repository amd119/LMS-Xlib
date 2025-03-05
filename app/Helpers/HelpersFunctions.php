<?php

namespace App\Helpers;

class HelpersFunctions {
    function getTitle($url)
    {
        $title = '';

        if (isset($url) && is_array($url)) {
            $title = (count($url) === 3) ? $url[2].' '.($url[0] ?? '') : ((count($url) === 2) ? $url[1].' '.($url[0] ?? '') : ($url[0] ?? ''));
        }

        return ucfirst($title);
    }
}
