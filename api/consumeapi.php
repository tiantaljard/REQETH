

<?php
$page_title = "E A E R  - TEST API";

if (isset($_POST['request'])){
    $url = $_POST['request'];
} else {$url = 'http://localhost/~TianTaljard/REQETH/api/requests/';}


$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPGET, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response_json = curl_exec($ch);
curl_close($ch);
$response=json_decode($response_json,true);


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php if (isset($page_title)) echo $page_title; ?></title>
    <!-- Bootstrap -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/custom.css" rel="stylesheet">
    <link href="../assets/css/upload.css" rel="stylesheet">
    <script src="../js/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../assets/css/sweetalert.css">

</head>
<body>


<form method="post" action="" enctype="multipart/form-data">
    <div style="width: 50%">
        <H2 class='docuheader'>API test returned values</H2>
        <label for="requestField">URL to test</label>
        <H5 class='docuheader'>Enter the request # of a single record, or leave blank to retrieve the complete list.</H5>
        <input  type="text" name="request"
                value="http://reqeth.azurewebsites.net/api/requests"


                                                          class="form-control" id="requestField">
        <button type="submit" name="updateProfileBtn" class="btn btn-primary">
            Test API Call
        </button>
    </div>
    <label for="requestField">HTTP Status Code: <?php echo $httpcode ?> </label>
</form>

<div class="container">



    <p>
        <?php
        echo var_dump($response);
        print "<table class='apilist'>";
        print " <tr> ";
        print " <th>Request#</th> ";
        print " <th>Requestor</th> ";
        print " <th>Status</th> ";

        print " </tr> ";
        foreach($response as $item) {
            echo "<tr >";
            echo "<td >" . $item[0] . "</td>";
            echo "<td>"  . $item[1] . "</td>";
            echo "<td >" . $item[2] . "</td>";
            echo "</tr>";
        }
        print "</table>";
        ?>
    </p>
</div>
</body>
</html>