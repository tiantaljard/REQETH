<?php
// Code below adapted from online course:
// site:            https://www.udemy.com
// Course title:    PHP: Complete Login and Registration System with PHP & MYSQL
// Instructor:      Osayawe Terry Ogbemudia
include_once 'resource/dbConnect.php';
include_once 'resource/utilities.php';

if((isset($_SESSION['id'])) && !isset($_POST['updateProfileBtn'])){
    $url_encoded_id = $_GET['urlid'];
    $decode_id = base64_decode($url_encoded_id);
    $user_id_array = explode("649",$decode_id);
    $userprofile = $user_id_array[1];
    $userprofile =$userprofile/3;

    $sqlQuery = "SELECT * FROM users WHERE uid = :uid";
    $statement = $db->prepare($sqlQuery);
    $statement->execute(array(':uid' => $userprofile));

    while($rs = $statement->fetch()){
        $profileid =$rs['uid'];
        $username = $rs['username'];
        $headerusername = $rs['username'];
        $firstname = $rs['firstname'];
        $lastname = $rs['lastname'];
        $accessgroup = $rs['description'];
        $email = $rs['email'];


    }

}
else if(isset($_POST['updateProfileBtn'])){

    $url_encoded_id = $_GET['urlid'];
    $decode_id = base64_decode($url_encoded_id);
    $user_id_array = explode("649",$decode_id);
    $userprofile = $user_id_array[1];
    $userprofile =$userprofile/3;


        //process the form
        //initialize an array to store any error message from the form
        $form_errors = array();

        //Form validation
        $required_fields = array('email','accessgroup','firstname','lastname');

        //call the function to check empty field and merge the return data into form_error array
        $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

        //Fields that requires checking for minimum length
        $fields_to_check_length = array('accessgroup' => 3);

        //call the function to check minimum required length and merge the return data into form_error array
        $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

        //email validation / merge the return data into form_error array
        $form_errors = array_merge($form_errors, check_email($_POST));


        //collect form data and store in variables
        $email = $_POST['email'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $accessgroup = $_POST['accessgroup'];
        $accessgroupUpdate=$_POST['accessgroupUpdate'];
        if ( strlen (  $_POST['accessgroupUpdate'] ) >2 ) {$accessgroup=$_POST['accessgroupUpdate'] ;}

        $username =$_POST['username'];



        if(empty($form_errors)){
            try{
                //create SQL update statement
                $sqlUpdate = "UPDATE users SET firstname =:firstname,lastname=:lastname,accessgroup=:accessgroup,email =:email WHERE uid =:id";

                //use PDO prepared to sanitize data
                $statement = $db->prepare($sqlUpdate);

                //update the record in the database
                $statement->execute(array(':firstname' => $firstname,':lastname' => $lastname, ':accessgroup' => $accessgroup, ':email' => $email, ':id' => $userprofile));

                if($statement->rowCount() == 1){
                    $result = flashMessage("Update successful","Pass");
                }
            }catch (PDOException $ex){
                $result = flashMessage("An error occurred in : " .$ex->getMessage());
            }
        }
        else{
            if(count($form_errors) ==1){
                $result = flashMessage("There was 1 error in the form<br>");
            }else{
                $result = flashMessage("There were " .count($form_errors). " errors in the form <br>");
            }
        }


}