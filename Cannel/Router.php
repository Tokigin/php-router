<?php
class Router
{
    public static string $Root = "/";
    public static string $Extension = ".php";
    public static string $Home_Page = "index";
    private static bool $Check_dir = false;
    public static string $Dir_page = "Pages";
    public static bool $Return_404 = true;
    public static bool $Sub_Folder = false;
    public static function SetRoot(string $root): void
    {
        self::$Root = "/" . str_replace("/", "", $root);
    }

    public static function Index_Fetching(string $root, string $dir_page, string $index, string $ext): void
    {
        if ($_SERVER["REQUEST_URI"] === "$root/") {
            if (file_exists("./$dir_page/$index$ext")) {
                require_once "./$dir_page/$index$ext";
                self::$Return_404 = false;
            } else ErrorText::Show("(Using Auto Router) $index$ext file not found in source code. Check the file dictionary.");
        }
    }
    public static function Page_Fetching(string $dir_page, string $ext, string $root): void
    {
        if (self::$Check_dir) require_once str_replace($root, "$dir_page", $_SERVER["REQUEST_URI"]) . "$ext";
    }
    public static function Sub_Page_Fetching(string $dir_page, string $ext, string $root): void
    {
        $sub_folders = self::Get_Sub_Folder();
        foreach ($sub_folders as $subfolder) {
            self::CheckPage($dir_page . $subfolder, $ext, $root);
        }
        self::Page_Fetching($dir_page . $subfolder, $ext, $root);
    }
    public static function CheckPage(string $dir_page, string $ext, string $root): void
    {
        $file  = str_replace("$root/", "", $_SERVER["REQUEST_URI"]);
        if (file_exists("$dir_page/$file$ext")) {
            self::$Check_dir = true;
            self::$Return_404 = false;
        }
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

    private static function Get_Sub_Folder(): array
    {
        $folders = glob('./Pages/*', GLOB_ONLYDIR);
        foreach ($folders as $folder) {
            $array[] = str_replace('./Pages', '', $folder);
        }
        return $array;
    }
    public static function Check_Sub_Folder(): void
    {
        (count(glob('./Pages/*', GLOB_ONLYDIR)) > 0) ? self::$Sub_Folder = true : self::$Sub_Folder = false;
    }
}

class AutoRouter extends Router
{
    public static function RunRouter(): void
    {
        self::Check_Sub_Folder();
        self::Index_Fetching(self::$Root, self::$Dir_page, self::$Home_Page, self::$Extension);
        self::CheckPage(self::$Dir_page, self::$Extension, self::$Root);
        self::Page_Fetching(self::$Dir_page, self::$Extension, self::$Root);
        if (self::$Sub_Folder && self::$Return_404) self::Sub_Page_Fetching(self::$Dir_page, self::$Extension, self::$Root);
        if (self::$Return_404) self::Return_404();
    }
}
class ManualRouter extends Router
{
    public static function RunRouter(): void
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
            if (self::$Return_404) self::Return_404();
        } else ErrorText::Show('(Using Manual Router) There is no "ManualRouter.php" in root folder. ');
    }
}
