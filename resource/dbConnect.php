<?php
//initialize variables to hold connection parameters M
$connectstr_dbhost = '';
$connectstr_dbname = '';
$connectstr_dbusername = '';
$connectstr_dbpassword = '';

// get connection detail for azure host and db
foreach ($_SERVER as $key => $value) {
    if (strpos($key, "MYSQLCONNSTR_localdb") !== 0) {
        continue;
    }
    $connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
    $connectstr_dbname = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
    $connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
    $connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
}

//If we are not on Azure
if (!$connectstr_dbhost) {
    $connectstr_dbhost = 'localhost';
    $connectstr_dbname = 'reqlocaldb';
    $connectstr_dbusername = 'root';
    $connectstr_dbpassword = 'Zppsit0!';
}

$connection=mysqli_connect($connectstr_dbhost,$connectstr_dbusername,$connectstr_dbpassword,$connectstr_dbname);
$link=mysqli_connect($connectstr_dbhost,$connectstr_dbusername,$connectstr_dbpassword,$connectstr_dbname);

// Build strings for creating PHP Database Object - PDO
$dsn = "mysql:host=$connectstr_dbhost; dbname=$connectstr_dbname";
$password = $connectstr_dbpassword;
$username = $connectstr_dbusername;

// Code below to create PDO class from online course:
// site:            https://www.udemy.com
// Course title:    PHP: Complete Login and Registration System with PHP & MYSQL
// Instructor:      Osayawe Terry Ogbemudia
// ..

try {
    //create an instance of the PDO class with the required parameters
    $db = new PDO($dsn, $username, $password);

    //set pdo error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //display success message
    //echo "Connected to the register database";

} catch (PDOException $ex) {
    //display error message
    echo "Connection failed " . $ex->getMessage();
}
