<?php
$page_title = "E A E R  - Homepage";
include_once 'partials/header.php';
include_once 'partials/parseRequestList.php';


?>
<div class="container">
    <p>
        <?php
        print "<table style='padding: 15px; text-align: left; width: 80%;'>";
        print " <tr> ";
        print " <th>Request#</th> ";
        print " <th>Description</th> ";
        print " <th>Requestor</th> ";
        print " <th>Status</th> ";
        print " <th>Date Submitted</th> ";
        print " <th>1st EAO</th> ";
        print " <th>2nd EAO</th> ";
        print " </tr> ";
        foreach ($result as $row) {
            $rowrequestid =$row['request'];
            $rowrequestid = $rowrequestid*3;
            $urlid = base64_encode("649{$rowrequestid}");
            echo "<tr>" ;
            echo "<td><a href='editrequest.php?urlid=$urlid'>" . $row['request'] ."</a></td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['firstname'] ." ". $row['lastname'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td>" . $row['date submitted'] . "</td>";
            echo "<td>" . $row['eao1'] . "</td>";
            echo "<td>" . $row['eao2'] . "</td>";
            echo "</tr>";
        }print "</table> ";

        ?>
    </p>
</div>
<?php include_once 'partials/footer.php'; ?>
</body>
</html>