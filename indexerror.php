<?php
// Code below adapted from online course:
// site:            https://www.udemy.com
// Course title:    PHP: Complete Login and Registration System with PHP & MYSQL
// Instructor:      Osayawe Terry Ogbemudia

$page_title = "E A E R  - Homepage";
include_once 'partials/header.php';
?>
<div class="container">

    <div class="flag">
        <h1>Ethical Approval of Experiment Request</h1>
        <h2 style="color: red">You arrived at this page because something suspicious happend.<br> Please be normal.</h2>

        <?php if(!isset($_SESSION['username'])): ?>
            <P class="lead">You are currently not signed <a href="login.php">Login</a> Not registered yet? <a href="signup.php">Signup</a> </P>
        <?php else: ?>
            <p class="lead">You are logged in as <?php if(isset($_SESSION['username'])) echo $_SESSION['username']; ?> <a href="logout.php">Logout</a> </p>
        <?php endif ?>
    </div>
</div>

<?php include_once 'partials/footer.php'; ?>
</body>
</html>