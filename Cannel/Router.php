<?php
class Router
{
    public static string $Root = "/";
    public static string $Extension = ".php";
    public static string $Home_Page = "index";
    private static bool $Check_dir = false;
    private static string $Dir_page = "Pages";
    private static bool $Return_404 = true;
    private static bool $Sub_Folder = false;
    public static function AutoRouter(): void
    {
        $root = self::$Root;
        $dir_page = self::$Dir_page;
        $ext = self::$Extension;
        $index = self::$Home_Page;
        self::CheckSub();
        self::CheckPage(self::$Dir_page, $_SERVER["REQUEST_URI"], $ext, $root);
        self::Index_Fetching($root, $dir_page, $index, $ext);
        self::Page_Fetching($root, $dir_page, $ext);
        // if (self::$Sub_Folder && self::$Return_404) {
        //     $sub_folders = self::GetSub();
        //     foreach ($sub_folders as $subfolder) {
        //         self::CheckPage($dir_page . $subfolder, $_SERVER["REQUEST_URI"], $ext, $root);
        //         echo $_SERVER["REQUEST_URI"] . "<br>";
        //         echo $dir_page . $subfolder . "<br>";
        //     }

        //     self::Index_Fetching($root, $dir_page . $subfolder, $index, $ext);
        //     self::Page_Fetching($root, $dir_page . $subfolder, $ext);
        // }

        if (self::$Return_404) self::Return404();
    }
    private static function Index_Fetching(string $root, string $dir_page, string $index, string $ext): void
    {
        if ($_SERVER["REQUEST_URI"] === "$root/") {
            if (file_exists("./$dir_page/$index$ext")) {
                require_once "./$dir_page/$index$ext";
                self::$Return_404 = false;
            } else ErrorText::Show("(Using Auto Router) $index$ext file not found in source code. Check the file dictionary.");
        }
    }
    private static function Page_Fetching(string $root, string $dir_page, string $ext): void
    {
        if (self::$Check_dir) {
            require_once str_replace($root, "$dir_page", $_SERVER["REQUEST_URI"]) . "$ext";
        }
    }
    private static function CheckPage(string $dir_page, string $currentUri, string $ext, string $root): void
    {
        $file = str_replace("$root/", "", $currentUri);
        if (file_exists("$dir_page/$file$ext")) {
            self::$Check_dir = true;
            self::$Return_404 = false;
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

    private static function GetSub()
    {
        $subfolders = glob('./Pages/*', GLOB_ONLYDIR);
        foreach ($subfolders as $subfolder) {
            $array[] = str_replace('./Pages', '', $subfolder);
        }
        return $array;
    }
    private static function CheckSub()
    {
        (count(glob('./Pages/*', GLOB_ONLYDIR)) > 0) ? self::$Sub_Folder = true : self::$Sub_Folder = false;
    }
}
