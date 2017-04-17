<?php
// Code below adopted from http://www.codingcage.com/2014/12/file-upload-and-view-with-php-and-mysql.html
// as at 12 April 2017 09:00
// AND also from
// Code below adapted from online course:
// site:            https://www.udemy.com
// Course title:    PHP: Complete Login and Registration System with PHP & MYSQL
// Instructor:      Osayawe Terry Ogbemudia
// https://teamtreehouse.com/community/deleting-individual-sql-table-rows-via-php

//add database connection script
include_once 'resource/dbConnect.php';
//include formvalidation functions
include_once 'resource/utilities.php';

$sql_uploaddocquery = "select * from uploads where request=:requestid; ";
$uploaddocstatement = $db->prepare($sql_uploaddocquery);
$uploaddocstatement->execute(array(':requestid' => $requestid));
$uploaddocsqlresult = $uploaddocstatement->fetchAll();

if ($uploaddocstatement->rowCount() > 0) {
    $displayheaders = "displayFUheaders";
} else $displayheaders =null;

if ((isset($_POST['uploadDocBtn']) || isset($_POST['updateRequestBtn']) )&& $_FILES['userfile']['size'] > 0) {
    //array to hold errors
    $form_errors = array();
    if (empty($form_errors)) {
        $file = rand(1000, 100000) . "-" . $_FILES['userfile']['name'];
        $file_name = $_FILES['userfile']['name'];
        $file_loc = $_FILES['userfile']['tmp_name'];
        $content = addslashes(file_get_contents($_FILES['userfile']['tmp_name']));
        $file_size = $_FILES['userfile']['size'];
        $file_type = $_FILES['userfile']['type'];
        $folder = "uploads/";

        if (!get_magic_quotes_gpc()) {
            $file_name = addslashes($file_name);
        }
        if (move_uploaded_file($file_loc, $folder . $file)) {
            try {
                //create SQL insert statement
                $sqlInsert = "INSERT INTO uploads(request,file,name,type,size,fileloc,content) VALUES(:request,:file,:filename,:file_type,:file_size,:file_loc,:content)";
                //use PDO prepared to sanitize data
                $insStatement = $db->prepare($sqlInsert);
                //add the data into the database
                $insStatement->execute(array(':request' => $requestid, ':file' => $file, ':filename' => $file_name, ':file_type' => $file_type, ':file_size' => $file_size, ':file_loc' => $file_loc, ':content' => $content));
                //check if one new row was created
                if ($insStatement->rowCount() == 1) {

                    $sql_uploaddocquery = "select * from uploads where request=:requestid; ";
                    $uploaddocstatement = $db->prepare($sql_uploaddocquery);
                    $uploaddocstatement->execute(array(':requestid' => $requestid));
                    $uploaddocsqlresult = $uploaddocstatement->fetchAll();

                    if ($uploaddocstatement->rowCount() > 0) {
                        $displayheaders = "displayFUheaders";
                    } else $displayheaders =null;
                    $result = flashMessage("File uploaded successfully: " . $file_name, "Pass");



                    $sql_commentquery = "select * from comments where request=:request; ";
                    $commentstatement = $db->prepare($sql_commentquery);
                    $commentstatement->execute(array(':request' => $request));
                    $sqlcommentresult = $commentstatement->fetchAll();

                    if ($commentstatement->rowCount() > 0) {
                        $displaycommentheaders = "displayCUheaders";
                    } else $displaycommentheaders =null;


                }
            } catch (PDOException $ex) {
                $result = flashMessage("An error occued: " . $ex->getMessage());
            }
        } else {
            $result = flashmessage("No file was selected, please select a file  BB");
        }
    } else {
        if (count($form_errors) == 1) {
            $result = flashmessage("There was 1 error in the form<br>");
        } else {
            $result = flashmessage("There were " . count($form_errors) . " errors in the form <br>");
        }
    }
}//}

if (isset($_POST['delreqdocid'])) {
    $form_errors = array();

    $delreqdocid = $_POST['delreqdocid'];



    try {
        $sql_del = "delete from uploads where id=:id and request=:request" ;

        $delstatement = $db->prepare($sql_del);
        $delstatement->execute(array(':id' => $delreqdocid,':request' => $requestid));


        if ($delstatement->rowCount() == 1) {

            $sql_query = "select * from uploads where request=:requestid; ";
            $statement = $db->prepare($sql_query);
            $statement->execute(array(':requestid' => $requestid));
            $sqlresult = $statement->fetchAll();

            if ($statement->rowCount() > 0) {
                $displayheaders = "displayFUheaders";
            } else $displayheaders =null;

            $result = flashMessage("File deleted  successfully: " . $file_name, "Pass");
        }
    } catch (PDOException $ex) {
        $result = flashMessage("An error occued: " . $ex->getMessage());
    }

}


?>