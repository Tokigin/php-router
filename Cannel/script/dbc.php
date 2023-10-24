<?php
$server = self::$Server;
$user = self::$User;
$password = self::$Password;
$database = self::$DBName;
if (isset($server[""]) || isset($password[""]) || isset($user[""])) {
    die("mising connection data bruh");
}
