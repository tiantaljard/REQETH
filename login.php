<?php
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

            $id = $row['id'];
            $hashed_password = $row['password'];
            $username = $row['username'];

            if (password_verify($password, $hashed_password)) {
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $username;
                redirectTo('index');
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

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>REQETH Login</title>
</head>
<body>
<h1>Request for ethical approval of experiment</h1>

<h3>Login Form</h3>

<?php if(isset($result)) echo $result; ?>
<?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
<form method="post" action="">
    <table>
        <tr><td>Username:</td> <td><input type="text" value="" name="username"></td></tr>
        <tr><td>Password:</td> <td><input type="password" value="" name="password"></td></tr>
        <tr><td><a href="forgot_password.php">Forgot Password?</a></td><td><input style="float: right;" type="submit" name="loginBtn" value="Signin"></td></tr>
    </table>
</form>
<p><a href="index.php">Back</a> </p>
</body>
</html>
