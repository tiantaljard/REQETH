<?php
// Code below adapted from online course:
// site:            https://www.udemy.com
// Course title:    PHP: Complete Login and Registration System with PHP & MYSQL
// Instructor:      Osayawe Terry Ogbemudia
include_once 'resource/dbConnect.php';
include_once 'resource/utilities.php';
;

if((isset($_SESSION['id'])) && !isset($_POST['updateProfileBtn'])){

    $url_encoded_id = $_GET['urlid'];
    $decode_id = base64_decode($url_encoded_id);
    $request_id_array = explode("649",$decode_id);
    $requestid = $request_id_array[1];
    $requestid =$requestid/3;



    $sqlQuery = "SELECT * FROM requests WHERE request = :request";
    $statement = $db->prepare($sqlQuery);
    $statement->execute(array(':request' => $requestid));

    while($rs = $statement->fetch()){
        $request =$rs['request'];
        $description = $rs['description'];
        $requestor = $rs['requestor'];
        $status = $rs['status'];
        $ethics = $rs['ethics'];
        $eao1 = $rs['eao1'];
        $eao2 = $rs['eao2'];
    }

}
else if(isset($_POST['updateProfileBtn'])){

    $url_encoded_id = $_GET['urlid'];
    $decode_id = base64_decode($url_encoded_id);
    $request_id_array = explode("649",$decode_id);
    $requestid = $request_id_array[1];
    $requestid =$requestid/3;


        //process the form
        //initialize an array to store any error message from the form
        $form_errors = array();

        //Form validation
        if ($_SESSION['accessgroup']=="admin"){
            $required_fields = array('eao1','eao2');
        } else {
        $required_fields = array('request','description','ethics');}

        //call the function to check empty field and merge the return data into form_error array
        $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

        //Fields that requires checking for minimum length
        $fields_to_check_length = array('accessgroup' => 3);

        //call the function to check minimum required length and merge the return data into form_error array
        $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

        //email validation / merge the return data into form_error array
        $form_errors = array_merge($form_errors, check_email($_POST));


        //collect form data and store in variables
        $request = $_POST['request'];
        $description = $_POST['description'];
        $requestor = $_POST['requestor'];
        $status = $_POST['status'];
        $eao1 =$_POST['eao1'];
        $eao2 =$_POST['eao2'];
        $ethics =$_POST['ethics'];



        if(empty($form_errors)){
            try{
                //create SQL update statement
                $sqlUpdate = "UPDATE requests SET request =:request,description=:description,requestor=:requestor,ethics =:ethics, eao1=:eao1,eao2=:eao2 WHERE request = :request";

                //use PDO prepared to sanitize data
                $statement = $db->prepare($sqlUpdate);

                //update the record in the database
                $statement->execute(array(':request' => $request,':description' => $description, ':requestor' => $requestor, ':ethics' => $ethics,':eao1' => $eao1,':eao2' => $eao2 ,':request' => $request));

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
