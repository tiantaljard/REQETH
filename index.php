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
    <section>
        <h2>Connect to  database</h2>
        <?
        include 'dbConnect.php';
        print " dbhost - ".$connectstr_dbhost."<br>";
        print " dbname- ".$connectstr_dbname."<br>";
        print " dbusername- ".$connectstr_dbusername."<br>";
        print " dbpassword- ".$connectstr_dbpassword."<br>";
        ?>
        <p><a href="all.php">All Request for ethical approval of experiment</a></p>
        <p><a href="xmen.php">All X-MEN 50Movies</a></p>

    </section>

    <div class="loginBox">
        <h3>Login Form</h3>
        <br><br>
        <form method="post" action="login.php">
            <label>Username:</label><br>
            <input type="text" name="username" placeholder="username" /><br><br>
            <label>Password:</label><br>
            <input type="password" name="password" placeholder="password" />  <br><br>
            <input type="submit" name="submit" value = "login"/>
        </form>
        <div class="error"><?php //echo $error;?><?php //echo $username; echo $password;?></div>

    </div>





</main>
<footer>
</footer>
</body>
</html>