<!-- this file can be deleted if using Auto Router  -->
<!-- "Request URl" => "File Path" -->
<?php
class ManualRoute
{
    public static array $Route = array(
        "/" => "Pages/home.php",
        "/about" => "Pages/about.php",
        "/hello" => "Pages/hello/home.php",
        "/hello/new" => "Pages/hello/new.php",
    );
}
