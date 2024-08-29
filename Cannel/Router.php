<?php
class Router
{
    public static string $Root = "/";
    public static string $Extension = ".php";
    public static string $Home_Page = "index";
    private static bool $Check_dir = false;
    private static string $Dir_page = "Pages";
    private static bool $Return_404 = true;
    public static function AutoRouter(): void
    {
        $root = self::$Root;
        $dir_page = self::$Dir_page;
        $ext = self::$Extension;
        $index = self::$Home_Page;
        self::CheckPage($dir_page, $_SERVER["REQUEST_URI"], $ext, $root);
        if ($_SERVER["REQUEST_URI"] === "$root/") {
            if (file_exists("./$dir_page/$index$ext")) {
                require_once "./$dir_page/$index$ext";
                self::$Return_404 = false;
            } else ErrorText::Show("(Using Auto Router) $index$ext file not found in source code. Check the file dictionary.");
        }
        if (self::$Check_dir) require_once str_replace($root, "$dir_page", $_SERVER["REQUEST_URI"]) . "$ext";
        if (self::$Return_404) self::Return404();
    }
    private static function CheckPage(string $dir_page, string $currentUri, string $ext, string $root): void
    {
        foreach (glob("$dir_page/*$ext") as $file) {
            $page = str_replace("$dir_page/", "", $file);
            if ("$currentUri$ext" === "$root/$page") {
                self::$Check_dir = true;
                self::$Return_404 = false;
            }
        }
    }
    public static function CurrentPage(string $filename): bool
    {
        return $_SERVER["REQUEST_URI"] === self::$Root . "/$filename" ? true : false;
    }
    public static function ManualRouter(): void
    {
        if (file_exists("./ManualRouter.php")) {
            require_once "./ManualRouter.php";
            $root = self::$Root;
            foreach (ManualRoute::$Route as $request => $file) {
                if ($_SERVER['REQUEST_URI'] == "$root/$request") {
                    if (file_exists("$file")) {
                        self::$Return_404 = false;
                        require "$file";
                    } else ErrorText::Show("(Using Manual Router) $file file not found in source code. Check the file dictionary.");
                }
            }
            if (self::$Return_404) self::Return404();
        } else ErrorText::Show('(Using Manual Router) There is no "ManualRouter.php" in root folder. ');
    }
    public static function Return404(): void
    {
        $ext = self::$Extension;
        $dir_page = self::$Dir_page;
        $index = self::$Home_Page;
        file_exists("./Layout/404$ext") ? require_once "./Layout/404$ext" : require_once "./$dir_page/$index$ext";
    }
}
