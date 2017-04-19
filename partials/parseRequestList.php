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
    $sql_query = "select u.*,requests.*,
      u1.username as u1username ,
      u1.firstname as e1firstname ,
      u1.lastname as e1lastname ,
      u2.username as e2username,
       u2.firstname as e2firstname ,
      u2.lastname as e2lastname  
      from users u, requests
      left outer join users u1 on eao1 = u1.username
      left outer join users u2 on eao2 = u2.username
      where 
      u.username=requestor AND 
      u.username=:username  ; ";
    $statement = $db->prepare($sql_query);
    $statement->execute(array(':username' => $username));
    $accessresult = $statement->fetchAll();

} else if ($accessgroup == "admin") {
    $sql_query = "select u.*,requests.*,
      u1.username as u1username ,
      u1.firstname as e1firstname ,
      u1.lastname as e1lastname ,
      u2.username as e2username,
       u2.firstname as e2firstname ,
      u2.lastname as e2lastname 
      from users u, requests 
      left outer join users u1 on eao1 = u1.username
      left outer join users u2 on eao2 = u2.username
      where u.username=requestor  and ((eao1 IS NULL  or eao1 =' ' or eao1='unassigned') or (eao2 IS NULL  or eao2 =' ' or eao2='unassigned')) and status='submit'; ";
    $statement = $db->prepare($sql_query);
    $statement->execute(array());
    $accessresult = $statement->fetchAll();

} else if ($accessgroup == "eao") {
    $sql_query = "select u.*,requests.*,
      u1.username as u1username ,
      u1.firstname as e1firstname ,
      u1.lastname as e1lastname ,
      u2.username as e2username,
       u2.firstname as e2firstname ,
      u2.lastname as e2lastname 
      from users u, requests 
      left outer join users u1 on eao1 = u1.username
      left outer join users u2 on eao2 = u2.username
      where u1.username=requestor and status='assigned' 
      and (eao1=:username or eao2=:username) and not exists (select 1 from comments where comments.username=:username and status='Approve' and comments.request=requests.request); ";
    $statement = $db->prepare($sql_query);
    $statement->execute(array(':username' => $username));
    $accessresult = $statement->fetchAll();
}
?>