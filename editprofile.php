<?php
$page_title = "E A E R - Edit Profile";
include_once 'partials/header.php';
include 'partials/parseProfile.php';
?>

<div class="container">
    <section class="col col-lg-7">
        <h2>Edit User Profile: <?php echo $headerusername  ?>  </h2><hr>
        <div>
            <?php if(isset($result)) echo $result; ?>
            <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
        </div>
        <div class="clearfix"></div>
        <php echo ($_SESSION['username']) echo ($_SESSION['accessgroup']) ; </php>
        <?php if((!isset($_SESSION['username']) && ($_SESSION['accessgroup'])=='admin')||!isset($_GET['urlid']) ):?>
            <P class="lead">You are not authorized to view this page <a href="login.php">Login</a>
                Not yet registered? <a href="signup.php">Signup</a> </P>

        <?php else: ?>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="firstnameField">First Name</label>
                    <input type="text" name="firstname" value="<?php if(isset($firstname)) echo $firstname; ?>" class="form-control" id="firstnameField">
                </div>

                <div class="form-group">
                    <label for="lastnameField">Last Name</label>
                    <input type="text" name="lastname" value="<?php if(isset($lastname)) echo $lastname; ?>" class="form-control" id="lastnameField">
                </div>

                <div class="form-group">
                    <label for="emailField">Email</label>
                    <input type="text" name="email" class="form-control" id="emailField" value="<?php if(isset($email)) echo $email; ?>">
                </div>

                <div class="form-group">
                <label for="accessgroupField">Access Group</label>
                <select class="form-control" name="accessgroup" id="accessgroupField" value="<?php if(isset($accessgroup)) echo $accessgroup; ?>" class="form-control" id="accessgroupField">
                    <option>student</option>
                    <option>eao</option>
                    <option>admin</option>
                </select>
                </div>

                <div class="form-group">
                    <input type="hidden" name="username" value="<?php if(isset($username)) echo $username; ?>" class="form-control" id="username">
                </div>

                <button type="submit" name="updateProfileBtn" class="btn btn-primary pull-right">
                    Update Profile</button> <br />
            </form>


    </section>
    <p><a href="usersList.php">User List</a> </p>

    <?php endif ?>
</div>
<?php include_once 'partials/footer.php'; ?>
</body>
</html>
