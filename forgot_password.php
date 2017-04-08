<?php
$page_title = "E A E R  - Forgot Password";
include_once 'partials/parseForget_pasword.php';
include_once 'partials/header.php';
?>

<div class="container">
    <section class="col-lg-7">
        <h2>Password Reset</h2><hr>
        <div>
            <?php if(isset($result)) echo $result; ?>
            <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
        </div>

        <div class="clearfix"></div>
        <form action="" method="post">

            <div class="form-group">
                <label for="emailField">Email</label>
                <input type="text" class="form-control" name="email" id="emailField" placeholder="Email">

            </div>

            <div class="form-group">
                <label for="passwordField">Password</label>
                <input type="password" name="new_password" class="form-control" id="passwordField" placeholder="New Password">
            </div>

            <div class="form-group">
                <label for="passwordConfirmField">Password</label>
                <input type="password" name="confirm_password" class="form-control" id="passwordConfirmField" placeholder="Confirm New Password">
            </div>

            <div >
                <button type="submit" name="passwordResetBtn" class="btn btn-primary pull-right">Reset Password</button>
                <p><a href="index.php">Back</a> </p>

            </div>
        </form>
    </section>
</div>
</body>
</html>

