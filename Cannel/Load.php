<?php
require_once "./Cannel/Layout.php";
require_once "./Cannel/Router.php";
class Page
{
    public static $LoadDB = false;
    public static $Boostrap = true;

    public static function Index()
    {
        require_once "./Cannel/Setting.php";
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
        }
    }
    public static function LoadBoostrap($boostrap)
    {
        if ($boostrap) {
            require "script/Boostrap.php";
        }
    }
}
