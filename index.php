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
        <p class="lead">Use this application to manage the ethical review process.<br> at Robert Gordon University.</p>

        <?php if (!isset($_SESSION['username'])): ?>
            <P class="lead">You are currently not signed <a href="login.php">Login</a> Not registered yet? <a
                        href="signup.php">Signup</a></P>
        <?php else: ?>
            <p class="lead"><?php if (isset($_SESSION['loginfirstname'])) echo $_SESSION['loginfirstname']."  ".$_SESSION['loginlastname']; ?> are logged in as <?php if (isset($_SESSION['username'])) echo $_SESSION['username']; ?>
                with '<?php if (isset($_SESSION['accessgroup'])) echo $_SESSION['accessgroup']; ?>' access.  <a href="logout.php">Logout</a></p>
        <?php endif ?>
    </div>
</div>

<?php include_once 'partials/footer.php'; ?>
</body>
</html>