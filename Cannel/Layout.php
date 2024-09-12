<?php
class Layout
{
    public static bool $Header = true;
    public static bool $Footer = true;
    public static function Header_layout(bool $header): void
    {
        if ($header) file_exists("./Layout/Header.php") ? require "./Layout/Header.php" : self::$Header = false;
    }
    public static function Footer_layout(bool $footer): void
    {
        if ($footer) file_exists("./Layout/Footer.php") ?  require "./Layout/Footer.php" : self::$Footer = false;
    }
}
