<?php
require_once "./Cannel/Layout.php";
require_once "./Cannel/Router.php";
class Page
{
    public static bool $Bootstrap = true;
    public static bool $Tailwind = true;
    public static bool $Setting = true;
    public static bool $AutoRouter = true;

    public static function Index(): void
    {
        Layout::Headerlayout(Layout::$Header);
        self::Handle(self::$AutoRouter);
        Layout::Footerlayout(Layout::$Footer);
    }
    public static function RemoveHeader(string $filename): void
    {
        if (Router::CurrentPage($filename)) Layout::$Header = false;
    }
    public static function RemoveFooter(string $filename): void
    {
        if (Router::CurrentPage($filename)) Layout::$Footer = false;
    }

    public static function LoadBootstrap(): void
    {
        if (self::$Bootstrap) {
            if (file_exists("./Cannel/script/Bootstrap.php")) {
                require "script/Bootstrap.php";
            } else {
                ErrorMessage::Show('There is no Bootstrap.php in ./Cannel/script.');
                die();
            }
        }
    }
    public static function LoadTailwind(): void
    {
        if (self::$Tailwind) {
            if (file_exists("./Cannel/script/Tailwind.php")) {
                require "script/Tailwind.php";
            } else {
                ErrorMessage::Show('There is no Tailwind.php in ./Cannel/script.');
                die();
            }
        }
    }
    public static function LoadSetting(bool $setting): void
    {
        if ($setting) {
            if (file_exists("./Setting.php")) {
                require_once "./Setting.php";
            } else {
                ErrorMessage::Show('There is no "Setting.php" in root folder.');
                die();
            }
        }
    }

    public static function Handle(bool $auto_router): void
    {
        $auto_router ?  Router::AutoRouter() : Router::ManualRouter();
    }
}

class ErrorMessage
{
    public static function Show(string $error): void
    {
        echo "<h6>$error</h6>";
    }
}
