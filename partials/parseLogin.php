<?php
// Code below adapted from online course:
// site:            https://www.udemy.com
// Course title:    PHP: Complete Login and Registration System with PHP & MYSQL
// Instructor:      Osayawe Terry Ogbemudia
include_once 'resource/session.php';
include_once 'resource/dbConnect.php';
include_once 'resource/utilities.php';
//M
if(isset($_POST['loginBtn'])){
    //array to hold errors
    $form_errors = array();
    //validate
    $required_fields = array('username', 'password');
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    if(empty($form_errors)) {
        //collect form data
        $user = $_POST['username'];
        $password = $_POST['password'];
        //check if user exist in the database
        $sqlQuery = "SELECT * FROM users WHERE username = :username";
        $statement = $db->prepare($sqlQuery);
        $statement->execute(array(':username' => $user));
        if ($row = $statement->fetch()) {
            $id = $row['uid'];
            $accessgroup = $row['accessgroup'];
            $hashed_password = $row['password'];
            $username = $row['username'];
            if (password_verify($password, $hashed_password)) {
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['accessgroup'] = $accessgroup;
                redirectTo('requestList');
            } else {
                $result = flashmessage("Invalid  password");
            }
        } else {
            $result = flashmessage("Invalid username");
        }
    }else{
        if(count($form_errors) == 1){
            $result = flashmessage("There was one error in the form");
        }else{
            $result = flashmessage("There were " .count($form_errors). " error in the form");
        }
    }
}
?>