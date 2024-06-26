<?php
class Layout
{
    public static $Header = true;
    public static $Footer = true;
    public static function Headerlayout($header)
    {
        if ($header) {
            if (file_exists("./Layout/Header.php")) {
                require "./Layout/Header.php";
            } else {
                ErrorMessage::Show('"Header.php" not found. Create Header.php file in ./Layout or use "Layout::$Header = false;" in Setting.php');
            }
        }
    }
    public static function Footerlayout($footer)
    {
        if ($footer) {
            if (file_exists("./Layout/Footer.php")) {
                require "./Layout/Footer.php";
            } else {
                ErrorMessage::Show('"Footer.php" not found. Create Header.php file in ./Layout or use "Layout::$Footer = false;" in Setting.php');
            }
        }
    }
}
