<?php

class Router
{
    public static function handle()
    {
        $root = "/php-router";
        $dir_page = "Pages";
        $currentUri = $_SERVER["REQUEST_URI"];
        $checkdir = false;
        $return_404 = true;
        foreach (glob($dir_page . '/*.php') as $file) {
            $page = str_replace("Pages/", "", $file);
            if ("$currentUri.php" == "$root/$page") {
                $checkdir = true;
                $return_404 = false;
            }
        }
        if ($currentUri === "$root/") {
            require_once "./Pages/index.php";
            $return_404 = false;
        }
        if ($checkdir) {
            $page_return = str_replace($root, "Pages", $currentUri);
            require_once "$page_return.php";
        }
        if ($return_404) {
            require_once "./Layout/404.php";
        }
    }
}
