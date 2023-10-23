<?php
class Layout
{
    public static $Header = true;
    public static $Footer = true;


    public static function Headerlayout($header)
    {
        if ($header) {
            require "./Layout/Header.php";
        }
    }
    public static function Footerlayout($footer)
    {
        if ($footer) {
            require "./Layout/Footer.php";
        }
    }
}
