<?php
$server = self::$Server;
$user = self::$User;
$password = self::$Password;

if (isset($server[""]) || isset($password[""]) || isset($user[""])) {
    die("mising connection data bruh");
}
$conn = new mysqli($server, $user, $password);
