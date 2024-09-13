<?php
class Router
{
    public static string $Root = "/";
    public static string $Extension = ".php";
    public static string $Home_Page = "index";
    public static string $Dir_page = "Pages";
    public static bool $Return_404 = true;


    public static function SetRoot(string $root): void
    {
        self::$Root = "/" . str_replace("/", "", $root);
    }
    public static function CurrentPage(string $filename): bool
    {
        return $_SERVER["REQUEST_URI"] === self::$Root . "/$filename" ? true : false;
    }
    public static function Return_404(): void
    {
        $ext = self::$Extension;
        $dir_page = self::$Dir_page;
        $index = self::$Home_Page;
        file_exists("./Layout/404$ext") ? require_once "./Layout/404$ext" : require_once "./$dir_page/$index$ext";
    }
    public static function File($file): string
    {
        if (!empty($file)) {
            ($file[strlen($file) - 1] === "/") ? $file = rtrim($file, "/") : $file;
            (str_contains($file, "?")) ? $file = substr($file, 0, strpos($file, "?"))  : $file;
        }
        return $file;
    }
}

class AutoRouter extends Router
{
    private static bool $Check_dir = false;
    private static function Index_Fetching(string $dir_page, string $index, string $ext, string $root): void
    {
        if ($_SERVER["REQUEST_URI"] === "$root/") {
            if (file_exists("./$dir_page/$index$ext")) {
                require_once "./$dir_page/$index$ext";
                self::$Return_404 = false;
            } else ErrorText::Show("(Using Auto Router) $index$ext file not found in source code. Check the file dictionary.");
        }
    }
    private static function Page_Fetching(string $dir_page, string $ext, string $root): void
    {
        $file = self::File($_SERVER["REQUEST_URI"]);
        if (self::$Check_dir) require_once str_replace($root, "$dir_page", "$file$ext");
    }
    private static function CheckPage(string $dir_page, string $ext, string $root): void
    {
        $file = self::File(str_replace("$root/", "", $_SERVER["REQUEST_URI"]));
        if (file_exists("$dir_page/$file$ext")) {
            self::$Check_dir = true;
            self::$Return_404 = false;
        }
    }

    public static function Run(): void
    {
        self::Index_Fetching(self::$Dir_page, self::$Home_Page, self::$Extension, self::$Root,);
        if (self::$Return_404) self::CheckPage(self::$Dir_page, self::$Extension, self::$Root);
        self::Page_Fetching(self::$Dir_page, self::$Extension, self::$Root);
        if (self::$Return_404) self::Return_404();
    }
}
class ManualRouter extends Router
{
    public static function Run(): void
    {
        if (file_exists("./ManualRouter.php")) {
            require_once "./ManualRouter.php";
            $root = self::$Root;
            $requested_file = self::File($_SERVER["REQUEST_URI"]);
            foreach (ManualRoute::$Route as $request => $file) {
                if ($requested_file === "$root$request") {
                    if (file_exists($file)) {
                        self::$Return_404 = false;
                        require $file;
                    } else ErrorText::Show("(Using Manual Router) $file file not found in source code. Check the file dictionary.");
                }
            }
            if (self::$Return_404) self::Return_404();
        } else ErrorText::Show('(Using Manual Router) There is no "ManualRouter.php" in root folder. ');
    }
}
