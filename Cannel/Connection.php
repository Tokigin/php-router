<!-- delete this page if there is no need to connect to database -->
<?php

class Connection
{
    private static $Server = "localhost";
    private static $User = "root";
    private static $Password = "";
    private static $DBName = "cms";

    public static function CreateDB()
    {
        // stable
        try {
            include("script/dbc.php");
            $conn = new mysqli($server, $user, $password);
            $sql = "CREATE DATABASE $database";
            $conn->query($sql);
            $conn->close();
        } catch (Exception $e) {

            if ($e->getMessage() == "Can't create database 'cms'; database exists") {
            } else {
                echo "" . $e->getMessage();
            }
        }
    }
    public static function CreateUserTable()
    {
        // stable 
        try {
            include("script/dbc.php");
            $conn = new mysqli($server, $user, $password, $database);
            // $sql = "CREATE TABLE Users (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,username VARCHAR(30) NOT NULL,password VARCHAR(30) NOT NULL,email VARCHAR(50) NOT NULL,reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
            $sql = self::CreateTableSql("Users", "id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,username VARCHAR(30) NOT NULL,password VARCHAR(30) NOT NULL,email VARCHAR(50) NOT NULL,reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
            $conn->query($sql);
            $conn->close();
        } catch (Exception $e) {

            if ($e->getMessage() == "Table 'users' already exists") {
            } else {
                echo "" . $e->getMessage();
            }
        }
    }
    public static function DBQuarry($insert_data)
    {
        // stable 
        include("script/dbc.php");
        $conn = new mysqli($server, $user, $password, $database);
        $sql = "$insert_data";
        $conn->query($sql);
        $conn->close();
    }
    public static function DBSelect($select_data)
    {
        // stable 
        include("script/dbc.php");
        $conn = new mysqli($server, $user, $password, $database);
        $sql = "$select_data";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    public static function CreateTableSql($tablename, $column)
    {
        return "CREATE TABLE $tablename ( $column );";
    }
    public static function SelectSql($tablename, $selectdata)
    {
        return "SELECT * FROM $tablename WHERE $selectdata; ";
    }
    public static function SelectAllSql($tablename)
    {
        return "SELECT * FROM $tablename;";
    }
    public static function DeleteSql($tablename, $deletedata)
    {
        return "DELETE FROM $tablename WHERE $deletedata;";
    }
    public static function UpdateSql($tablename, $updatecolumn, $updatedata)
    {
        return "UPDATE $tablename SET $updatecolumn where $updatedata";
    }
    public static function InsertSql($tablename, $insertdata)
    {
        return "INSERT INTO $tablename VALUES ( $insertdata )";
    }
}
