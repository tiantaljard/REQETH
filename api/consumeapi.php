<?php
$page_title = "E A E R  - TEST API";


$url = 'http://reqeth.azurewebsites.net/api/requests/4';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPGET, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response_json = curl_exec($ch);
curl_close($ch);
$response=json_decode($response_json,true);
echo var_dump($response);
//echo var_dump($response);

print "<br>";
print "<br>";

echo $response[0][0]."A";
echo $response[0][1]."B";
echo $response[1][0]."C";
//
//// Result: object(stdClass)#1 (2) { ["foo"]=> string(3) "bar" ["cool"]=> string(4) "attr" }
//var_dump($result);
//
//// Prints "bar"
//echo $result->foo;
//
//// Prints "attr"
//echo $result->cool;
//


//array(1) { [0]=> object(stdClass)#1 (2) { ["0"]=> string(1) "4" ["request"]=> string(1) "4" } }


?>



<div class="container">
        <p>
            <?php
            print "<table class='requestlist'>";
            print " <tr> ";
            print " <th>Request#</th> ";
//            print " <th>Experiment Description</th> ";
            print " <th>Requestor</th> ";
            print " <th>Status</th> ";
  //          print " <th>Date Submitted</th> ";
    //        print " <th>1st EAO</th> ";
      //      print " <th>2nd EAO</th> ";
            print " </tr> ";

                    echo "<tr >";
                    echo "<td >" . $response[0][0] . "</a></td>";
//                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $response[1][0] . " " . $row['lastname'] . "</td>";
                    echo "<td >" . $response[0][2] . "</td>";
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