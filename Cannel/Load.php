<?php
require_once "./Cannel/Layout.php";
require_once "./Cannel/Router.php";
class Page
{
    public static $LoadDB = false;
    public static $Boostrap = true;
    public static $Setting = true;

    public static function Index()
    {
        self::LoadSetting(self::$Setting);
        self::LoadDB(self::$LoadDB);
        self::LoadBoostrap(self::$Boostrap);
        Layout::Headerlayout(Layout::$Header);
        Router::Handle();
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
    public static function LoadDB($loaddb)
    {
        if ($loaddb) {
            require "Connection.php";
            Connection::CreateDB();
            Connection::CreateUserTable();
        }
    }
    public static function LoadBoostrap($boostrap)
    {
        if ($boostrap) {
            require "script/Boostrap.php";
        }
    }
    public static function LoadSetting($setting)
    {
        if ($setting) {
            require_once "./Cannel/Setting.php";
        }
    }
}
