<?php
$page_title = "E A E R  - Homepage";
include_once 'partials/header.php';
?>
<div class="container">

    <div class="flag">
        <h1>Ethical Approval of Experiment Request</h1>
        <p class="lead">Use this application to manage the ethical review process.<br> at Robert Gordon University.</p>

        <?php if(!isset($_SESSION['username'])): ?>
            <P class="lead">You are currently not signed <a href="login.php">Login</a> Not yet a member? <a href="signup.php">Signup</a> </P>
        <?php else: ?>
            <p class="lead">You are logged in as <?php if(isset($_SESSION['username'])) echo $_SESSION['username']; ?> <a href="logout.php">Logout</a> </p>
        <?php endif ?>
    </div>
</div>

<?php include_once 'partials/footer.php'; ?>
</body>
</html>