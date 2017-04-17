<?php
$page_title = "E A E R  - Homepage";
include_once 'partials/header.php';
include_once 'partials/parseRequestList.php';
?>
<div class="container">

    <div>
        <?php if (isset($result)) echo $result; ?>
        <?php if (!empty($form_errors)) echo show_errors($form_errors); ?>
    </div>
    <div class="clearfix"></div>

    <?php if(!isset($_SESSION['username'])): ?>
        <p class="lead">You are not authorized to view this page <a href="login.php">Login</a>
            Not yet registered? <a href="signup.php">Signup</a> </p>
    <?php else: ?>
    <p>
        <?php
        print "<table class='requestlist'>";
        print " <tr> ";
        print " <th>Request#</th> ";
        print " <th>Description</th> ";
        print " <th>Requestor</th> ";
        print " <th>Status</th> ";
        print " <th>Date Submitted</th> ";
        print " <th>1st EAO</th> ";
        print " <th>2nd EAO</th> ";
        print " </tr> ";
        if ($statement->rowCount() > 0) {
        foreach ($accessresult as $row) {
            $rowrequestid =$row['request'];
            $rowrequestid = $rowrequestid*3;
            $urlid = base64_encode("649{$rowrequestid}");
            echo "<tr>" ;
            echo "<td><a href='editrequest.php?urlid=$urlid'>" . $row['request'] ."</a></td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['firstname'] ." ". $row['lastname'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td>" . $row['submitdate'] . "</td>";
            echo "<td>" . $row['eao1'] . "</td>";
            echo "<td>" . $row['eao2'] . "</td>";
            echo "</tr>";
        }
        } else $noRecords ="No requests exists that meets the criteria to be included in this list";
        print "</table> ";
        echo "<br><br>".$noRecords;

        ?>
    </p>
    <?php endif ?>
</div>
<?php include_once 'partials/footer.php'; ?>
</body>
</html>