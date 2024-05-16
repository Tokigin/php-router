<?php
class Router
{
    public static $Root = "/"; // project name (remove if deploy to server eg."/")
    public static $Dir_page = "Pages";
    public static $Extention = ".php";
    public static $Checkdir = false;
    public static $Return_404 = true;
    public static function Handle()
    {
        $root = self::$Root;
        $dir_page = self::$Dir_page;
        $ext = self::$Extention;
        $currentUri = $_SERVER["REQUEST_URI"];
        self::CurrentUri($dir_page, $currentUri, $ext, $root);
        $checkdir = self::$Checkdir;
        $return_404 = self::$Return_404;

        if ($currentUri === "$root/") {
            require_once "./$dir_page/home$ext";
            $return_404 = false;
        }
        if ($checkdir) {
            $page_return = str_replace($root, "$dir_page", $currentUri);
            require_once "$page_return$ext";
        }
        if ($return_404) {
            require_once "./Layout/404$ext";
        }
        /////

        /////

    }
    public static function CurrentUri($dir_page, $currentUri, $ext, $root)
    {
        foreach (glob($dir_page . "/*$ext") as $file) {
            $page = str_replace("$dir_page/", "", $file);
            if ("$currentUri$ext" == "$root/$page") {
                self::$Checkdir = true;
                self::$Return_404 = false;
            }
        }
    }
    public static function CurrentPage($filename)
    {
        $currentUri = $_SERVER["REQUEST_URI"];
        $root = self::$Root;
        $dirfile = "$root/$filename";
        if ($currentUri == $dirfile) {
            return true;
        } else {
            return false;
        }
    }
    public static function Rout($route, $path_to_include)
    {
        self::$Checkdir = false;
        self::$Return_404 = false;
        $root = self::$Root;
        switch ($_SERVER['REQUEST_URI']) {
            case "$root/items/p1":
                require "Pages/items/p1.php";
        }
    }
}
