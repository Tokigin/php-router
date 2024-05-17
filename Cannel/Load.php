<?php
require_once "./Cannel/Layout.php";
require_once "./Cannel/Router.php";
class Page
{
    public static $LoadDB = false;
    public static $Boostrap = true;
    public static $Setting = true;
    public static $AutoRouter = true;

    public static function Index()
    {
        self::LoadSetting(self::$Setting);
        DB::LoadDB(self::$LoadDB);
        self::LoadBoostrap(self::$Boostrap);
        Layout::Headerlayout(Layout::$Header);
        self::AutoRouter(self::$AutoRouter);
        Layout::Footerlayout(Layout::$Footer);
    }
    public static function RemoveHeader($filename)
    {
        $chk_dri = Router::CurrentPage($filename);
        if ($chk_dri) {
            Layout::$Header = false;
        }
    }
    public static function RemoveFooter($filename)
    {
        $chk_dri = Router::CurrentPage($filename);
        if ($chk_dri) {
            Layout::$Footer = false;
        }
    }

    public static function LoadBoostrap($boostrap)
    {
        if ($boostrap) {
            if (file_exists("./Cannel/script/Bootstrap.php")) {
                require "script/Bootstrap.php";
            } else {
                ErrorMessage::Show('There is no Bootstrap.php in ./Cannel/script.');
                die();
            }
        }
    }
    public static function LoadSetting($setting)
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

    public static function AutoRouter($autorouter)
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
    public static function LoadDB($loaddb)
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
    public static function Show($error)
    {
        echo "<h5>$error</h5>";
    }
}
