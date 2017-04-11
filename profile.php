<?php
// Code below adapted from online course:
// site:            https://www.udemy.com
// Course title:    PHP: Complete Login and Registration System with PHP & MYSQL
// Instructor:      Osayawe Terry Ogbemudia

$page_title = "E A E R - User Admin";
include_once 'partials/header.php';
include_once 'partials/parseProfile.php';
?>

<div class="container">
    <div >
        <h1>User Info</h1>
        <?php if(!isset($_SESSION['username'])  && (($_SESSION['accessgroup'])=='adm')  ): ?>
            <P class="lead">You are not authorized to view this page <a href="login.php">Login</a>
                Not yet a member? <a href="signup.php">Signup</a> </P>
        <?php else: ?>
            <section class="col col-lg-7">

                <table class="table table-bordered table-condensed">
                    <tr><th style="width: 20%;">Username:</th><td><?php if(isset($username)) echo $username; ?></td></tr>
                    <tr><th>First Name:</th><td><?php if(isset($firstname)) echo $firstname; ?></td></tr>
                    <tr><th>Last Name:</th><td><?php if(isset($lastname)) echo $lastname; ?></td></tr>
                    <tr><th>Email:</th><td><?php if(isset($email)) echo $email; ?></td></tr>
                    <tr><th>Access Group:</th><td><?php if(isset($accessgroup)) echo $accessgroup; ?></td></tr>
                    <tr><th></th><td>
                            <a class="" href="editprofile.php?urlid=<?php if(isset($url_encoded_id)) echo $url_encoded_id; ?>">
                                <span class="glyphicon glyphicon-edit"></span>Edit User</a> &nbsp; &nbsp;

                        </td></tr>
                </table>
            </section>
        <?php endif ?>
    </div>
</div>
<?php include_once 'partials/footer.php'; ?>
</body>
</html>