<?php
// Code below adapted from online course:
// site:            https://www.udemy.com
// Course title:    PHP: Complete Login and Registration System with PHP & MYSQL
// Instructor:      Osayawe Terry Ogbemudia
include_once 'resource/dbConnect.php';
include_once 'resource/utilities.php';

$username = $_SESSION['username'];
if (isset($_POST['insertRequestBtn'])) {
    //process the form
    //initialize an array to store any error message from the form
    $form_errors = array();

    //Form validation depending on Access Group
    $required_fields = array('description', 'ethics');
    //call the function to check empty field and merge the return data into form_error array
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    //Fields that requires checking for minimum length
    $fields_to_check_length = array('description' => 6, 'ethics' => 10);

    //call the function to check minimum required length and merge the return data into form_error array
    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

    //collect form data and store in variables

    $description = $_POST['description'];
    $requestor = $_SESSION['username'];
    $ethics = $_POST['ethics'];

    if (empty($form_errors)) {
        try {
            //create SQL update statement
            $sqlReqIns = "insert into  requests (description,requestor,ethics,status,submitdate) VALUES (:description,:requestor,:ethics,'prepare',now())";

            //use PDO prepared to sanitize data
            $statementReqIns = $db->prepare($sqlReqIns);

            //update the record in the database
            $statementReqIns->execute(array(':description' => $description, ':requestor' => $requestor, ':ethics' => $ethics));

            if ($statementReqIns->rowCount() == 1) {
                $request = $db->lastInsertId();
                $rowrequestid =$row['request'];
                $rowrequestid = $rowrequestid*3;
                $urlid = base64_encode("649{$rowrequestid}");
                header("Location: editRequest.php?$urlid");
                //$result = flashMessage("Insert successful", "Pass");
            }
        } catch (PDOException $ex) {
            $result = flashMessage("An error occurred in : " . $ex->getMessage());
        }
    } else {
        if (count($form_errors) == 1) {
            $result = flashMessage("There was 1 error in the form<br>");
        } else {
            $result = flashMessage("There were " . count($form_errors) . " errors in the form <br>");
        }
    }
}
