<?php
class Router
{
    public static string $Root = "/";
    public static string $Dir_page = "Pages";
    public static string $Extention = ".php";
    public static bool $Checkdir = false;
    public static bool $Return_404 = true;
    public static function Handle(): void
    {
        $root = self::$Root;
        $dir_page = self::$Dir_page;
        $ext = self::$Extention;
        $currentUri = $_SERVER["REQUEST_URI"];
        self::CurrentUri($dir_page, $currentUri, $ext, $root);

        if ($currentUri === "$root/") {
            require_once "./$dir_page/home$ext";
            self::$Return_404 = false;
        }
        if (self::$Checkdir) {
            $page_return = str_replace($root, "$dir_page", $currentUri);
            require_once "$page_return$ext";
        }
        if (self::$Return_404) {
            require_once "./Layout/404$ext";
        }
    }
    public static function CurrentUri(string $dir_page, string $currentUri, string $ext, string $root): void
    {
        foreach (glob($dir_page . "/*$ext") as $file) {
            $page = str_replace("$dir_page/", "", $file);
            if ("$currentUri$ext" == "$root/$page") {
                self::$Checkdir = true;
                self::$Return_404 = false;
            }
        }
    }
    public static function CurrentPage(string $filename): bool
    {
        $currentUri = $_SERVER["REQUEST_URI"];
        $root = self::$Root;
        if ($currentUri == "$root/$filename") {
            return true;
        } else {
            return false;
        }
    }
    public static function ManualRoute(): void
    {
        if (file_exists("./ManualRouter.php")) {
            require_once "ManualRouter.php";
            $root = self::$Root;
            $ext = self::$Extention;
            foreach (ManualRoute::$Route as $request => $file) {
                if ($_SERVER['REQUEST_URI'] == "$root/$request") {
                    self::$Return_404 = false;
                    if (file_exists("$file")) {
                        require "$file";
                    } else {
                        self::$Return_404 = true;
                        ErrorMessage::Show('(Using Manual Router) File not found in source code. Check the file dictionary.');
                    }
                }
            }
            if (self::$Return_404) {
                require_once "./Layout/404$ext";
            }
        } else {
            ErrorMessage::Show('(Using Manual Router) There is no "Manualrouter.php" in root folder. ');
        }
    }
}
