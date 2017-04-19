<?php
// Code below adapted from online course:
// site:            https://www.udemy.com
// Course title:    PHP: Complete Login and Registration System with PHP & MYSQL
// Instructor:      Osayawe Terry Ogbemudia

//add database connection script
include_once 'resource/dbConnect.php';
//include formvalidation functions
include_once 'resource/utilities.php';

//process the form
if (isset($_POST['signupBtn'])) {
    //initialize an array to store any error message from the form
    $form_errors = array();

    //Form validation
    $required_fields = array('firstname', 'lastname', 'email', 'username', 'password');

    //call the function to check empty field and merge the return data into form_error array
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    //Fields that requires checking for minimum length
    $fields_to_check_length = array('username' => 4, 'password' => 6, 'firstname' => 3, 'lastname' => 3);

    //call the function to check minimum required length and merge the return data into form_error array
    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

    //email validation / merge the return data into form_error array
    $form_errors = array_merge($form_errors, check_email($_POST));

    //collect form data and store in variables
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $accessgroup = $_POST['accessgroup'];


    if (checkDuplicateEntries("users", "email", $email, $db)) {

        $result = flashMessage("Email is used on an existing acount, please us existing login or use diffrent email");
    }
    else if (checkDuplicateEntries("users", "username", $username, $db)) {
        $result = flashMessage("Username is used on an existing acount, please us existing login or use diffrent username");
    } //check if error array is empty, if yes process form data and insert record
    else if (empty($form_errors)) {
        //hashing the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        try {

            //create SQL insert statement
            $sqlInsert = "INSERT INTO users (username, email, password,firstname,lastname, join_date,accessgroup)
              VALUES (:username, :email, :password,:firstname,:lastname, now(),:accessgroup) ";

            //use PDO prepared to sanitize data
            $statement = $db->prepare($sqlInsert);

            //add the data into the database
            $statement->execute(array(':username' => $username, ':email' => $email, ':password' => $hashed_password, ':firstname' => $firstname, ':lastname' => $lastname, ':accessgroup' => $accessgroup));

            //check if one new row was created
            if ($statement->rowCount() == 1) {
                $result = flashMessage("Registration completed. <a href='login.php'>You can login here</a>", "Pass");
            }
        } catch (PDOException $ex) {
            $result = flashMessage("An error occued: " . $ex->getMessage());
        }
    } else {
        if (count($form_errors) == 1) {
            $result = flashmessage("There was 1 error in the form<br>");
        } else {
            $result = flashmessage("There were " . count($form_errors) . " errors in the form <br>");
        }
    }

}
?>