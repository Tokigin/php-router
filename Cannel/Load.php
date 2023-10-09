<?php
require_once "./Cannel/Layout.php";
require_once "./Cannel/Router.php";
class Page
{
    public static function Index()
    {
        require_once "./Cannel/Setting.php";
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
}
