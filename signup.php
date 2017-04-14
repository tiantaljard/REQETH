<?php
// Code below adapted from online course:
// site:            https://www.udemy.com
// Course title:    PHP: Complete Login and Registration System with PHP & MYSQL
// Instructor:      Osayawe Terry Ogbemudia

$page_title = "E A E R  - Homepage";
include_once 'partials/parseSignup.php';
include_once 'partials/header.php';
?>
<div class="container">
    <section class="col col-lg-7">
        <h2>Student Registration Form </h2><hr>
        <div>
            <?php if(isset($result)) echo $result; ?>
            <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
        </div>
        <div class="clearfix"></div>

        <form action="" method="post">
            <div class="form-group">
                <label for="firstnameField">First Name</label>
                <input type="text" class="form-control" name="firstname" id="firstnameField" placeholder="first name">
            </div>

            <div class="form-group">
                <label for="lastnameField">Last Name</label>
                <input type="text" class="form-control" name="lastname" id="lastnameField" placeholder="last name">
            </div>
            <div class="form-group">
                <label for="emailField">Email Address</label>
                <input type="text" class="form-control" name="email" id="emailField" placeholder="email">
            </div>
            <div class="form-group">
                <label for="usernameField">Username</label>
                <input type="text" class="form-control" name="username" id="usernameField" placeholder="username">
            </div>
            <div class="form-group">
                <label for="passwordField">Password</label>
                <input type="password" name="password" class="form-control" id="passwordField" placeholder="password">
            </div>
            <div class="form-group" style="display:none">
                <label for="accessgroupField">Access Group</label>
                <input type="text" class="form-control" name="accessgroup" id="accessgroupField"
                       placeholder="access group" value="student" >
            </div>
            <button type="submit" name="signupBtn" class="btn btn-primary pull-right">Signup</button>
            <p><a href="index.php">Back</a> </p>
        </form>
    </section>

</div>






</body>
</html>