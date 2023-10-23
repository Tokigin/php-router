<?php
class Connection
{
    private static $Server = "localhost";
    private static $User = "root";
    private static $Password = "";
    public static $DBName = "cms";
    public static $InsertSql = fn ($tablename, $insertdata) => "INSERT INTO " . $tablename . " VALUES (" . $insertdata . ")";
    public static $UpdateSql = fn ($tablename, $updatecolumn, $updatedata) => "UPDATE " . $tablename . " SET " . $updatecolumn . " where " . $updatedata;
    public static $DeleteSql = fn ($tablename, $deletedata) => "DELETE FROM " . $tablename . " WHERE " . $deletedata;
    public static $SelectAllSql = fn ($tablename) => "SELECT * FROM " . $tablename;
    public static $SelectSql = fn ($tablename, $selectdata) => "SELECT * FROM " . $tablename . " WHERE " . $selectdata;

    public static function CreateDB()
    {
        // not stable 
        $dbname = self::$DBName;
        $server = self::$Server;
        $user = self::$User;
        $password = self::$Password;
        if (isset($server[""]) || isset($password[""]) || isset($user[""])) {
            die("mising connection data bruh");
        }
        $conn = new mysqli($server, $user, $password);
        $sql = "CREATE DATABASE $dbname";
        $conn->query($sql);
        $conn->close();
    }
    public static function CreateUserTable()
    {
        // not stable 
        $server = self::$Server;
        $user = self::$User;
        $password = self::$Password;
        $database = self::$DBName;
        if (isset($server[""]) || isset($password[""]) || isset($user[""])) {
            die("mising connection data bruh");
        }
        $conn = new mysqli($server, $user, $password, $database);
        $sql = "CREATE TABLE Users (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,username VARCHAR(30) NOT NULL,password VARCHAR(30) NOT NULL,email VARCHAR(50) NOT NULL,reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
        $conn->query($sql);
        $conn->close();
    }
    public static function DBQuarry($insert_data)
    {
        // stable 
        $server = self::$Server;
        $user = self::$User;
        $password = self::$Password;
        $database = self::$DBName;
        if (isset($server[""]) || isset($password[""]) || isset($user[""])) {
            die("mising connection data bruh");
        }
        $conn = new mysqli($server, $user, $password, $database);
        $sql = "$insert_data";
        $conn->query($sql);
        $conn->close();
    }
    public static function DBSelect($insert_data)
    {
        // stable 
        $server = self::$Server;
        $user = self::$User;
        $password = self::$Password;
        $database = self::$DBName;
        if (isset($server[""]) || isset($password[""]) || isset($user[""])) {
            die("mising connection data bruh");
        }
        $conn = new mysqli($server, $user, $password, $database);
        $sql = "$insert_data";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
}
