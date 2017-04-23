<?php
$page_title = "E A E R  - TEST API";


$url = 'http://reqeth.azurewebsites.net/api/requests/4';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPGET, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response_json = curl_exec($ch);
curl_close($ch);
$response=json_decode($response_json, true);
//echo var_dump($response);
echo var_dump($response);



?>



<div class="container">
        <p>
            <?php
            print "<table class='requestlist'>";
            print " <tr> ";
            print " <th>Request#</th> ";
            print " <th>Experiment Description</th> ";
            print " <th>Requestor</th> ";
            print " <th>Status</th> ";
            print " <th>Date Submitted</th> ";
            print " <th>1st EAO</th> ";
            print " <th>2nd EAO</th> ";
            print " </tr> ";
//            if ($statement->rowCount() > 0) {
//                foreach ($accessresult as $row) {
//                    $rowrequestid = $row['request'];
//                    $rowrequestid = $rowrequestid * 3;
//                    $urlid = base64_encode("649{$rowrequestid}");
//                    echo "<tr class ='reqlistrow'>";
   //                echo "<td >" . $row['request'] . "</a></td>";
//                    echo "<td>" . $row['description'] . "</td>";
//                    echo "<td>" . $row['firstname'] . " " . $row['lastname'] . "</td>";
//                    echo "<td class ='reqlistStatus'>" . $row['status'] . "</td>";
//                    echo "<td>" . $row['submitdate'] . "</td>";
//                    echo "<td>" . $row['e1firstname'] . " " . $row['e1lastname'] . "</td>";
//                    echo "<td>" . $row['e2firstname'] . " " . $row['e2lastname'] . "</td>";
//                    echo "</tr>";
//                }
//            } else $noRecords = "No requests exists that meets the criteria to be included in this list";
//            print "</table> ";
//            echo "<br><br>" . $noRecords;

            ?>
        </p>
</div>
</body>
</html>