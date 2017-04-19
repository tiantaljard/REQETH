<?php
// Code below adapted from online course:
// site:            https://www.udemy.com
// Course title:    PHP: Complete Login and Registration System with PHP & MYSQL
// Instructor:      Osayawe Terry Ogbemudia

/**
 **
 * @param $required_fields_array, n array containing the list of all required fields
 * @return array, containing all errors
 */

// create and assign value to readonly variable
$readonly ="readonly";
$hidden="style=&quot;display: none;&quot";



if (isset($_SESSION['accessgroup'])) {
    if (($_SESSION['accessgroup'])=='admin'){$admingroup='admin';}
    if(($_SESSION['accessgroup'])=='eao'){$eaogroup='eao';}
    if(($_SESSION['accessgroup'])=='student'){$studentgroup='student';}
    if(($_SESSION['accessgroup'])=='eao' || ($_SESSION['accessgroup'])=='admin'){$admineaogroup='admmineao';}
    if(($_SESSION['accessgroup'])=='admin' || ($_SESSION['accessgroup'])=='student'){$adminstudentgroup='admminstudent';}
    if(($_SESSION['accessgroup'])=='eao' || ($_SESSION['accessgroup'])=='student'){$eaostudentgroup='eaostudent';}
}



function check_empty_fields($required_fields_array){
    //initialize an array to store error messages
    $form_errors = array();

    //loop through the required fields array snd popular the form error array
    foreach($required_fields_array as $name_of_field){
        if(!isset($_POST[$name_of_field]) || $_POST[$name_of_field] == NULL){
            $form_errors[] = $name_of_field . " is a required field";
        }
    }

    return $form_errors;
}

/**
 * @param $fields_to_check_length, an array containing the name of fields
 * for which we want to check min required length e.g array('username' => 4, 'email' => 12)
 * @return array, containing all errors
 */
function check_min_length($fields_to_check_length){
    //initialize an array to store error messages
    $form_errors = array();

    foreach($fields_to_check_length as $name_of_field => $minimum_length_required){
        if(strlen(trim($_POST[$name_of_field])) < $minimum_length_required && $_POST[$name_of_field] != NULL){
            $form_errors[] = $name_of_field . " is too short, must be {$minimum_length_required} characters long";
        }
    }
    return $form_errors;
}

/**
 * @param $data, store a key/value pair array where key is the name of the form control
 * in this case 'email' and value is the input entered by the user
 * @return array, containing email error
 */
function check_email($data){
    //initialize an array to store error messages
    $form_errors = array();
    $key = 'email';
    //check if the key email exist in data array
    if(array_key_exists($key, $data)){

        //check if the email field has a value
        if($_POST[$key] != null){

            // Remove all illegal characters from email
            $key = filter_var($key, FILTER_SANITIZE_EMAIL);

            //check if input is a valid email address
            if(filter_var($_POST[$key], FILTER_VALIDATE_EMAIL) === false){
                $form_errors[] = $key . " is not a valid email address";
            }
        }
    }
    return $form_errors;
}

/**
 * @param $form_errors_array, the array holding all
 * errors which we want to loop through
 * @return string, list containing all error messages
 */
function show_errors($form_errors_array){
    $errors = "<p><ul style='color: red;'>";

    //loop through error array and display all items in a list
    foreach($form_errors_array as $the_error){
        $errors .= "<li> {$the_error} </li>";
    }
    $errors .= "</ul></p>";
    return $errors;
}


/**
 * @param $form_errors_array, the array holding all
 * errors which we want to loop through
 * @return string, list containing all error messages
 */

function flashmessage($message,$passOrFail="Fail"){
    if ($passOrFail === "Pass"){
        $data = "<p style='padding:20px; border: 1px solid gray; color: green;'> {$message}</p>";
    }else {
        $data = "<p style='padding:20px; border: 1px solid gray; color: red;'>{$message}</p>";
    }
    return $data;
}

/**
 * @param $page, redirect user to page specified
 */
function redirectTo($page){
    header("Location: {$page}.php");
}

/**
 * @param $table, table that we want to search
 * @param $column_name, the column name
 * @param $value, the data collected from the form
 * @param $db, database object
 * @return bool, returns true if record exist else false
 */
function checkDuplicateEntries($table, $column_name, $value, $db){
    try{
        $sqlQuery = "SELECT * FROM " .$table. " WHERE " .$column_name."=:$column_name";
        $statement = $db->prepare($sqlQuery);
        $statement->execute(array(":$column_name" => $value));

        if($row = $statement->fetch()){
            return true;
        }
        return false;
    }catch (PDOException $ex){
        //handle exception
    }
}
function signout(){
    unset($_SESSION['username']);
    unset($_SESSION['id']);
    session_destroy();
    redirectTo('index');
}
function guard(){
    $isValid = true;
    $inactive = 60 * 15; //5 min
    $fingerprint = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
    if((isset($_SESSION['fingerprint']) && $_SESSION['fingerprint'] != $fingerprint)){
        $isValid = false;
        signout();
    }else if((isset($_SESSION['last_active']) && (time() - $_SESSION['last_active']) > $inactive) && $_SESSION['username']){
        $isValid = false;
        signout();
    }else{
        $_SESSION['last_active'] = time();
    }
    return $isValid;
}
function _token(){
    $randonToken = base64_encode(openssl_random_pseudo_bytes(32));
    //$randonToken = md5(uniqid(rand(), true))." md5";

    return $_SESSION['token'] = $randonToken;
}
function validate_token($requestToken){
    if(isset($_SESSION['token']) && $requestToken === $_SESSION['token']){
        unset($_SESSION['token']);

        return true;
    }

    return false;
}
?>
