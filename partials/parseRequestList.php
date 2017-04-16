<?php
// Code below adapted from online course:
// site:            https://www.udemy.com
// Course title:    PHP: Complete Login and Registration System with PHP & MYSQL
// Instructor:      Osayawe Terry Ogbemudia

include_once 'resource/session.php';
include_once 'resource/dbConnect.php';
include_once 'resource/utilities.php';
include 'resource/dbConnect.php';


$username = $_SESSION['username'];
$accessgroup = $_SESSION['accessgroup'];


if ($accessgroup == "student") {
    $sql_query = "select * from users, requests where username=requestor and username=:username; ";
    $statement = $db->prepare($sql_query);
    $statement->execute(array(':username' => $username));
    $accessresult = $statement->fetchAll();

} else if ($accessgroup == "admin") {
    $sql_query = "select * from users, requests where username=requestor  and (eao1 is null or eao2 is null) and status='submit'; ";
    $statement = $db->prepare($sql_query);
    $statement->execute(array());
    $accessresult = $statement->fetchAll();

} else if ($accessgroup == "eao"){
    $sql_query = "select * from users, requests 
      where username=requestor and status='assigned' 
      and (eao1=:username or eao2=:username) and not exists (select 1 from comments where comments.username=:username and status='Approve' and comments.request=requests.request); ";
    $statement = $db->prepare($sql_query);
    $statement->execute(array(':username' => $username));
    $accessresult = $statement->fetchAll();
}
?>