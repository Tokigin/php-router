<?php
class Layout
{
    public static bool $Header = true;
    public static bool $Footer = true;
    public static function Headerlayout(bool $header): void
    {
        if ($header) {
            if (file_exists("./Layout/Header.php")) {
                require "./Layout/Header.php";
            } else {
                ErrorMessage::Show('"Header.php" not found. Create Header.php file in ./Layout or use "Layout::$Header = false;" in Setting.php');
            }
        }
    }
    public static function Footerlayout(bool $footer): void
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
