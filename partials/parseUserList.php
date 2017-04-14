<?php
// Code below adapted from online course:
// site:            https://www.udemy.com
// Course title:    PHP: Complete Login and Registration System with PHP & MYSQL
// Instructor:      Osayawe Terry Ogbemudia

include_once 'resource/session.php';
include_once 'resource/dbConnect.php';
include_once 'resource/utilities.php';

include 'resource/dbConnect.php';
$username  = $_SESSION['username'];
$accessgroup = $_SESSION['accessgroup'];

 if
($accessgroup=="admin"){
    $sql_query = "select * from users; ";
    $statement = $db->prepare($sql_query);
    $statement->execute(array());
    $result = $statement->fetchAll();
}


?>