<?php
class Layout
{
    public static bool $Header = true;
    public static bool $Footer = true;
    public static function Headerlayout(bool $header): void
    {
        if ($header) file_exists("./Layout/Header.php") ? require "./Layout/Header.php" : self::$Header = false;
    }
    public static function Footerlayout(bool $footer): void
    {
        if ($footer) file_exists("./Layout/Footer.php") ?  require "./Layout/Footer.php" : self::$Footer = false;
    }
}
