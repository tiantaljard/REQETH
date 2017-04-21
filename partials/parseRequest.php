<?php
// Code below adapted from online course:
// site:            https://www.udemy.com
// Course title:    PHP: Complete Login and Registration System with PHP & MYSQL
// Instructor:      Osayawe Terry Ogbemudia
include_once 'resource/dbConnect.php';
include_once 'resource/utilities.php';;


$username = $_SESSION['username'];
//echo $_SESSION['urlid']."what what".$_SESSION[username];

if ((isset($_SESSION['id'])) && isset($_SESSION['urlid']) && !isset($_POST['updateRequestBtn'])) {
    $url_encoded_id = $_SESSION['urlid'];
    $decode_id = base64_decode($url_encoded_id);
    $request_id_array = explode("649", $decode_id);
    $requestid = $request_id_array[1];
    $newrequestid = $requestid / 3;
}


if ((isset($_SESSION['id'])) && !isset($_POST['updateRequestBtn'])) {

    $url_encoded_id = $_GET['urlid'];
    $decode_id = base64_decode($url_encoded_id);
    $request_id_array = explode("649", $decode_id);
    $requestid = $request_id_array[1];
    $requestid = $requestid / 3;

    $sqlQuery = "SELECT *, CONCAT(firstname, ' ', lastname) AS flname  FROM requests, users  WHERE username =requestor and request = :request";
    $statement = $db->prepare($sqlQuery);
    $statement->execute(array(':request' => $requestid));
    while ($rs = $statement->fetch()) {
        $request = $rs['request'];
        $description = $rs['description'];
        $requestor = $rs['requestor'];
        $status = $rs['status'];
        $ethics = $rs['ethics'];
        $eao1 = $rs['eao1'];
        $eao2 = $rs['eao2'];
        $firstname = $rs['firstname'];
        $lastname = $rs['lastname'];
        $flname = $rs['flname'];
    }

    $sql_commentquery = "select * from comments where request=:request; ";
    $commentstatement = $db->prepare($sql_commentquery);
    $commentstatement->execute(array(':request' => $request));
    $sqlcommentresult = $commentstatement->fetchAll();
    if ($commentstatement->rowCount() > 0) {
        $displaycommentheaders = "displayCUheaders";
    } else $displaycommentheaders = null;

} else if (isset($_POST['updateRequestBtn'])) {

    $url_encoded_id = $_GET['urlid'];
    $decode_id = base64_decode($url_encoded_id);
    $request_id_array = explode("649", $decode_id);
    $requestid = $request_id_array[1];
    $requestid = $requestid / 3;

    //process the form
    //initialize an array to store any error message from the form
    $form_errors = array();

    //Form validation depending on Access Group
    if ($_SESSION['accessgroup'] == "admin") {
        $required_fields = array();
    } else if ($_SESSION['accessgroup'] == "eao") {
        $required_fields = array('eaocomment', 'eaostatus');
    } else {
        $required_fields = array('request', 'description', 'ethics');
    }

    //call the function to check empty field and merge the return data into form_error array
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    //Fields that requires checking for minimum length
    $fields_to_check_length = array('accessgroup' => 3);

    //call the function to check minimum required length and merge the return data into form_error array
    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

    //collect form data and store in variables
    $request = $_POST['request'];
    $description = $_POST['description'];
    $requestor = $_POST['requestor'];
    // set status to new status for student status update
    $status = $_POST['status'];
    $statusUpdate = $_POST['statusUpdate'];
    if (strlen($_POST['statusUpdate']) > 2) {
        $status = $_POST['statusUpdate'];
    }
    // set ea01 for updated ea01
    $eao1 = $_POST['eao1'];
    if (strlen($_POST['assignEao1']) > 2) {
        $eao1 = $_POST['assignEao1'];
    }
    // set ea02 for updated ea02
    $eao2 = $_POST['eao2'];
    if (strlen($_POST['assignEao2']) > 2) {
        $eao2 = $_POST['assignEao2'];
    }


    // update status to assigned if EAO1 and EAO2 are assigned by the admin
    if ((isset($admingroup)) && $status == 'submit' && strlen($eao1) > 2 && strlen($eao2) > 2 && $eao1 != 'unassigned' && $eao2 != 'unassigned') {
        $status = 'assigned';
    }
    if ((isset($admingroup)) && $status == 'assigned' && ($eao1 == 'unassigned' || $eao2 == 'unassigned')) {
        $status = 'submit';
    }



    $ethics = $_POST['ethics'];
    $eaoComment = $_POST['eaocomment'];
    $eaoStatus = $_POST['eaostatus'];
    $flname = $_POST['flname'];


    if (empty($form_errors)) {
        if (isset($adminstudentgroup)) {
            try {
                //create SQL update statement
                $sqlUpdate = "UPDATE requests SET description=:description,status=:status,ethics =:ethics,eao1=:eao1,eao2=:eao2 WHERE request = :request";
                //use PDO prepared to sanitize data
                $updatestatement = $db->prepare($sqlUpdate);
                //update the record in the database

                $updatestatement->execute(array(':description' => $description, ':status' => $status, ':ethics' => $ethics, ':eao1' => $eao1, ':eao2' => $eao2, ':request' => $request));

                if ($updatestatement->rowCount() == 1) {

                    $result = flashMessage("Update successful", "Pass");
                }
            } catch (PDOException $ex) {
                $result = flashMessage("An error occurred in : " . $ex->getMessage());
            }
        }
        if (isset($eaogroup)) {
            try {
                //create SQL insert statement
                $sqlInsert = "INSERT INTO comments(username,request,comment,status,commentdate) VALUES(:username,:request,:comment,:status,now())";
                //use PDO prepared to sanitize data
                $insStatement = $db->prepare($sqlInsert);
                //add the data into the database
                $insStatement->execute(array(':username' => $username, ':request' => $request, ':comment' => $eaoComment, ':status' => $eaoStatus));
                //check if one new row was created
                if ($insStatement->rowCount() == 1) {

                    $sql_commentquery = "select * from comments where request=:request; ";
                    $commentstatement = $db->prepare($sql_commentquery);
                    $commentstatement->execute(array(':request' => $request));
                    $sqlcommentresult = $commentstatement->fetchAll();

                    if ($commentstatement->rowCount() > 0) {
                        $displaycommentheaders = "displayCUheaders";
                    } else $displaycommentheaders = null;

                    $result = flashMessage("Comments saved successfully: ", "Pass");
                }
            } catch (PDOException $ex) {
                $result = flashMessage("An error occurred in : " . $ex->getMessage());
            }
        }
    } else {
        if (count($form_errors) == 1) {
            $result = flashMessage("There was 1 error in the form<br>");
        } else {
            $result = flashMessage("There were " . count($form_errors) . " errors in the form <br>");
        }
    }
}
if ((isset($_SESSION['id'])) && isset($_POST['delreqcommentid'])) {
    $form_errors = array();

    $delreqcommentid = $_POST['delreqcommentid'];
    try {
        //create SQL insert statement
        $sqlcomdel = "DELETE FROM comments where request=:request and uid=:uid";
        //use PDO prepared to sanitize data
        $delcomStatement = $db->prepare($sqlcomdel);
        //add the data into the database
        $delcomStatement->execute(array(':request' => $request, ':uid' => $delreqcommentid));
        //check if one new row was created
        if ($delcomStatement->rowCount() == 1) {

            $sql_commentquery = "select * from comments where request=:request; ";
            $commentstatement = $db->prepare($sql_commentquery);
            $commentstatement->execute(array(':request' => $request));
            $sqlcommentresult = $commentstatement->fetchAll();

            if ($commentstatement->rowCount() > 0) {
                $displaycommentheaders = "displayCUheaders";
            } else $displaycommentheaders = null;

            $result = flashMessage("Comment delete successfully: ", "Pass");
        }
    } catch (PDOException $ex) {
        $result = flashMessage("An error occurred in : " . $ex->getMessage());
    }


}
?>

