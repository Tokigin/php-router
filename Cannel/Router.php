<?php
class Router
{
    public static string $Root = "/";
    public static string $Extension = ".php";
    public static string $Home_Page = "index";
    private static bool $Checkdir = false;
    private static string $Dir_page = "Pages";
    private static bool $Return_404 = true;
    public static function AutoRouter(): void
    {
        $root = self::$Root;
        $dir_page = self::$Dir_page;
        $ext = self::$Extension;
        $index = self::$Home_Page;
        self::CurrentUri($dir_page, $_SERVER["REQUEST_URI"], $ext, $root);
        if ($_SERVER["REQUEST_URI"] === "$root/") {
            if (file_exists("./$dir_page/$index$ext")) {
                require_once "./$dir_page/$index$ext";
                self::$Return_404 = false;
            } else {
                ErrorMessage::Show("(Using Auto Router) File not found in source code. Check the file dictionary.");
            }
        }
        if (self::$Checkdir) {
            $page_return = str_replace($root, "$dir_page", $_SERVER["REQUEST_URI"]);
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
        $root = self::$Root;
        return ($_SERVER["REQUEST_URI"] === "$root/$filename") ? true : false;
    }
    public static function ManualRouter(): void
    {
        if (file_exists("./ManualRouter.php")) {
            require_once "ManualRouter.php";
            $root = self::$Root;
            $ext = self::$Extension;
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
            if (self::$Return_404) require_once "./Layout/404$ext";
        } else {
            ErrorMessage::Show('(Using Manual Router) There is no "ManualRouter.php" in root folder. ');
        }
    }
}
