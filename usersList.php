<?php
$page_title = "E A E R  - Homepage";
include_once 'partials/header.php';
include_once 'partials/parseUserList.php';
?>


<div class="container">

    <?php if (!isset($admingroup)): ?>
        <p class="lead">You are not authorized to view this page <a href="login.php">Login</a>
            Not yet a member? <a href="signup.php">Signup</a></p>
    <?php else: ?>

        <p>
            <?php
            print "<table style='padding: 15px; text-align: left; width: 80%;'>";
            print " <tr> ";
            print " <th>Username</th> ";
            print " <th>First Name</th> ";
            print " <th>Last Name</th> ";
            print " <th>Email</th> ";
            print " <th>Access Group</th> ";

            print " </tr> ";
            foreach ($result as $row) {
                $rowuserid = $row['uid'];
                $rowuserid = $rowuserid * 3;
                $urlid = base64_encode("649{$rowuserid}");

                echo "<tr>";
                echo "<td><a href='editprofile.php?urlid=$urlid'>" . $row['username'] . "</a></td>";
                echo "<td>" . $row['firstname'] . "</td>";
                echo "<td>" . $row['lastname'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['accessgroup'] . "</td>";
                echo "</tr>";
            }
            print "</table> ";

            ?>
        </p>
    <?php endif ?>
</div>
<?php include_once 'partials/footer.php'; ?>
</body>
</html>