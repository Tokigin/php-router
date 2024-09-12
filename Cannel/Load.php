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
        Layout::Header_layout(Layout::$Header);
        self::$AutoRouter ? AutoRouter::Run() : ManualRouter::Run();
        Layout::Footer_layout(Layout::$Footer);
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
        if (self::$Bootstrap) file_exists("./Cannel/script/Bootstrap.php") ? require "script/Bootstrap.php" : ErrorText::Show('There is no Bootstrap.php in ./Cannel/script.');
    }
    public static function LoadTailwind(): void
    {
        if (self::$Tailwind) file_exists("./Cannel/script/Tailwind.php") ? require "script/Tailwind.php" : ErrorText::Show('There is no Tailwind.php in ./Cannel/script.');
    }
    public static function LoadSetting(bool $setting): void
    {
        if ($setting) {
            if (file_exists("./Setting.php")) {
                require_once "./Setting.php";
            } else {
                ErrorText::Show('There is no "Setting.php" in root folder.');
                die();
            }
        }
    }
}

class ErrorText
{
    public static function Show(string $error): void
    {
        echo "<h5>$error</h5>";
    }
}
Page::LoadSetting(Page::$Setting);
