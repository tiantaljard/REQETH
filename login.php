<?php
// Code below adapted from online course:
// site:            https://www.udemy.com
// Course title:    PHP: Complete Login and Registration System with PHP & MYSQL
// Instructor:      Osayawe Terry Ogbemudia

$page_title = "E A E R  - Homepage";
include_once 'partials/parseLogin.php';
include_once 'partials/header.php';
?>

<div class="container">
    <section class="col-lg-7">
        <h2>Login Form </h2>
        <hr>
        <div>
            <?php if (isset($result)) echo $result; ?>
            <?php if (!empty($form_errors)) echo show_errors($form_errors); ?>
        </div>

        <div class="clearfix"></div>
        <form action="" method="post">
            <div class="form-group">
                <label for="usernameField">Username</label>
                <input type="text" class="form-control" name="username" id="usernameField" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="passwordField">Password</label>
                <input type="password" name="password" class="form-control" id="passwordField" placeholder="Password">
            </div>

            <div class="checkbox">

                <a href="forgotpassword.php">Forgot Password?</a>

                <input type="hidden" name="token" value="<?php if (function_exists('_token')) echo _token(); ?>">
                <button type="submit" name="loginBtn" class="btn btn-primary pull-right">Sign in</button>
                <p><a href="index.php">Back</a></p>
            </div>
        </form>

    </section>

</div>
</body>
</html>
