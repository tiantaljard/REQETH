<?php
// Code from online course:
// site:            https://www.udemy.com
// Course title:    PHP: Complete Login and Registration System with PHP & MYSQL
// Instructor:      Osayawe Terry Ogbemudia

//add database connection script
include_once 'resource/dbConnect.php';
//include formvalidation functions
include_once 'resource/utilities.php';

//process the form
if(isset($_POST['signupBtn'])){
    //initialize an array to store any error message from the form
    $form_errors = array();

    //Form validation
    $required_fields = array('email', 'username', 'password','firstname','lastname');

    //call the function to check empty field and merge the return data into form_error array
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    //Fields that requires checking for minimum length
    $fields_to_check_length = array('username' => 4, 'password' => 6, 'firstname'=>3,'lastname'=>3);

    //call the function to check minimum required length and merge the return data into form_error array
    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

    //email validation / merge the return data into form_error array
    $form_errors = array_merge($form_errors, check_email($_POST));

    //check if error array is empty, if yes process form data and insert record

    if(empty($form_errors)){
        //collect form data and store in variables
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $accesgroup = $_POST['accessgroup'];



        //hashing the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        try{

            //create SQL insert statement
            $sqlInsert = "INSERT INTO users (username, email, password,firstname,lastname, join_date,accessgroup)
              VALUES (:username, :email, :password,:firstname,:lastname, now(),:accessgroup) ";

            //use PDO prepared to sanitize data
            $statement = $db->prepare($sqlInsert);

            //add the data into the database
            $statement->execute(array(':username' => $username, ':email' => $email, ':password' => $hashed_password,':firstname' => $firstname,':lastname' => $lastname,':accessgroup' => $accessgroup));

            //check if one new row was created
            if($statement->rowCount() == 1){
                $result = "<p style='padding:20px; border: 1px solid gray; color: green;'> Registration Successful</p>";
            }
        }catch (PDOException $ex){
            $result = "<p style='padding:20px; border: 1px solid gray; color: red;'> An error occurred: ".$ex->getMessage()."</p>";
        }
    }
    else{
        if(count($form_errors) == 1){
            $result = "<p style='color: red;'> There was 1 error in the form<br>";
        }else{
            $result = "<p style='color: red;'> There were " .count($form_errors). " errors in the form <br>";
        }
    }

}
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>REQETH Student Registration</title>
</head>
<body>
<h1>Request for ethical approval of experiment</h1><hr>

<h3>Register new student</h3>

<?php if(isset($result)) echo $result; ?>
<?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
<form method="post" action="">
    <table>
        <tr><td>First Name:</td> <td><input type="text" value="STU3Frist" name="firstname"></td></tr>
        <tr><td>Last Name:</td> <td><input type="text" value="STU3Last" name="lastname"></td></tr>
        <tr><td>Email:</td> <td><input type="text" value="tianSTU3@yahoo.com" name="email"></td></tr>
        <tr><td>Username:</td> <td><input type="text" value="STU3" name="username"></td></tr>
        <tr><td>Password:</td> <td><input type="password" value="asdfgh" name="password"></td></tr>
        <tr class="hidden" style="display: none;"><td>Accessgroup:</td> <td><input type="text" value="student" name="accessgroup"></td></tr>

        <tr><td></td><td><input style="float: right;" type="submit" name="signupBtn" value="Signup"></td></tr>
    </table>


</form>
<p><a href="index.php">Back</a> </p>
</body>
</html>