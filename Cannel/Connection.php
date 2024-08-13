<!-- delete this page if there is no need to connect to database -->
<?php

class Connection
{
    private static string $Server = "localhost";
    private static string $User = "root";
    private static string $Password = "";
    private static string $DBName = "cms";

    public static function CreateDB(): void
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
    public static function CreateUserTable(): void
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
    public static function DBQuarry(string $insert_data): void
    {
        // stable 
        include("script/dbc.php");
        $conn = new mysqli($server, $user, $password, $database);
        $sql = "$insert_data";
        $conn->query($sql);
        $conn->close();
    }
    public static function DBSelect(string $select_data): bool
    {
        // stable 
        include("script/dbc.php");
        $conn = new mysqli($server, $user, $password, $database);
        $sql = "$select_data";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    public static function CreateTableSql(string $tablename, string $column): string
    {
        return "CREATE TABLE $tablename ( $column );";
    }
    public static function SelectSql(string $tablename, string $selectdata): string
    {
        return "SELECT * FROM $tablename WHERE $selectdata; ";
    }
    public static function SelectAllSql(string $tablename): string
    {
        return "SELECT * FROM $tablename;";
    }
    public static function DeleteSql(string $tablename, string $deletedata): string
    {
        return "DELETE FROM $tablename WHERE $deletedata;";
    }
    public static function UpdateSql(string $tablename, string $updatecolumn, string $updatedata): string
    {
        return "UPDATE $tablename SET $updatecolumn where $updatedata";
    }
    public static function InsertSql(string $tablename, string $insertdata): string
    {
        return "INSERT INTO $tablename VALUES ( $insertdata )";
    }
}
