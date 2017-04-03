<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Request for ethical approval of experiment</title>
</head>
<body>
<header>
    <h1>Request for ethical approval of experiment</h1>
</header>
<main>
    <!-- Connection to the Database -->
    <section>
        <?
        include 'resource/dbConnect.php';
        ?>
    </section>
    <p>You are currently not signin <a href="login.php">Login</a> Not yet a member? <a href="signup.php">Signup</a> </p>

    <p>You are logged in as {username} <a href="logout.php">Logout</a> </p>





<!--
    <div class="loginBox">
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
</body>
</html>