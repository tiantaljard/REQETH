<?php include_once 'resource/session.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>E A E R - Home</title>
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">

</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">

    <div class="flag">
        <h1>Ethical Approval of Experiment Request</h1>
        <p class="lead">Use this application to manage the ethical review process.<br> at Robert Gordon University.</p>

        <?php if(!isset($_SESSION['username'])): ?>
            <P class="lead">You are currently not signin <a href="login.php">Login</a> Not yet a member? <a href="signup.php">Signup</a> </P>
        <?php else: ?>
            <p class="lead">You are logged in as <?php if(isset($_SESSION['username'])) echo $_SESSION['username']; ?> <a href="logout.php">Logout</a> </p>
        <?php endif ?>
    </div>

</div>

<main>
    <!-- Check of user is connected-->







<!--
    <div class="loginBox"> M
        <h2>Login Form</h2>
        <br><br>
        <form method="post" action="login.php">
            <label>Username:</label><br>
            <input type="text" name="username" placeholder="username" /><br><br>
            <label>Password:</label><br>
            <input type="password" name="password" placeholder="password" />  <br><br>
            <input type="submit" name="submit" value = "login"/>
        </form>
        <div class="error"><?php echo $error;?><?php echo $username; echo $password;?></div>
    </div>

!-->



</main>
<footer>
</footer>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>