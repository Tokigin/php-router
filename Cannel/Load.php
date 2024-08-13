<?php
require_once "./Cannel/Layout.php";
require_once "./Cannel/Router.php";
class Page
{
    public static bool $LoadDB = false;
    public static bool $Bootstrap = true;
    public static bool $Setting = true;
    public static bool $AutoRouter = true;

    public static function Index(): void
    {
        self::LoadSetting(self::$Setting);
        DB::LoadDB(self::$LoadDB);
        self::LoadBootstrap(self::$Bootstrap);
        Layout::Headerlayout(Layout::$Header);
        self::AutoRouter(self::$AutoRouter);
        Layout::Footerlayout(Layout::$Footer);
    }
    public static function RemoveHeader(string $filename): void
    {
        if (Router::CurrentPage($filename)) {
            Layout::$Header = false;
        }
    }
    public static function RemoveFooter(string $filename): void
    {
        if (Router::CurrentPage($filename)) {
            Layout::$Footer = false;
        }
    }

    public static function LoadBootstrap(bool $boostrap): void
    {
        self::$Bootstrap = $boostrap;
        if (self::$Bootstrap) {
            if (file_exists("./Cannel/script/Bootstrap.php")) {
                require "script/Bootstrap.php";
            } else {
                ErrorMessage::Show('There is no Bootstrap.php in ./Cannel/script.');
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

    public static function AutoRouter(bool $autorouter): void
    {
        switch ($autorouter) {
            case true:
                Router::Handle();
                break;
            case false:
                Router::ManualRoute();
                break;
        }
    }
}

class DB
{
    public static function LoadDB(bool $loaddb): void
    {
        if ($loaddb) {
            if (file_exists("./Cannel/Connectiondd.php")) {
                require "Connection.php";
                Connection::CreateDB();
                Connection::CreateUserTable();
            } else {
                ErrorMessage::Show('There is no Connection.php in ./Cannel.');
                die();
            }
        }
    }
}
class ErrorMessage
{
    public static function Show(string $error): void
    {
        echo "<h5>$error</h5>";
    }
}
