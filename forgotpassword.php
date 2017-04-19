<?php
// Code below adapted from online course:
// site:            https://www.udemy.com
// Course title:    PHP: Complete Login and Registration System with PHP & MYSQL
// Instructor:      Osayawe Terry Ogbemudi
$page_title = "E A E R  - Forgot Password";
include_once 'partials/parseforgotpasword.php';
include_once 'partials/header.php';
?>

<div class="container">
    <section class="col-lg-7">
        <h2>Password Reset</h2>
        <hr>
        <div>
            <?php if (isset($result)) echo $result; ?>
            <?php if (!empty($form_errors)) echo show_errors($form_errors); ?>
        </div>

        <div class="clearfix"></div>
        <form action="" method="post">
            <div class="form-group">
                <label for="emailField">Email</label>
                <input type="text" class="form-control" name="email" id="emailField" placeholder="Email">

            </div>

            <div class="form-group">
                <label for="passwordField">Password</label>
                <input type="password" name="new_password" class="form-control" id="passwordField"
                       placeholder="New Password">
            </div>

            <div class="form-group">
                <label for="passwordConfirmField">Password</label>
                <input type="password" name="confirm_password" class="form-control" id="passwordConfirmField"
                       placeholder="Confirm New Password">
            </div>

            <div>

                <input type="hidden" name="token" value="<?php if (function_exists('_token')) echo _token(); ?>">
                <?php $_POST['token'] = $_SESSION['token'];
                /*
                echo var_dump($_SESSION);
                echo "<br> after SESSIOSN";
                echo "<br>";
                echo var_dump($_POST);
                echo "<br> after POST";
                echo "<br>";
                 */ ?>


                <button type="submit" name="passwordResetBtn" class="btn btn-primary pull-right">Reset Password</button>
                <p><a href="index.php">Home</a></p>

            </div>
        </form>
    </section>
</div>
</body>
</html>
