<?php
$page_title = "E A E R  - API Testing";

if (isset($_POST['getAPI'])){
    $url = $_POST['request'];
} else {$url = 'http://reqeth.azurewebsites.net/api/requests/';}

if (isset($_POST['getAPI'])) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
// must set $url first....
// do your curl thing here afa
    $result = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//echo $http_status;
    curl_close($ch);
    $response = json_decode($response_json, true);
}
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
        <H2 class='docuheader'>API Test</H2>
        <H3 class='docuheader'>Available API end points:</H3>
        <H5 class='docuheader'>/api/requests/</H5>
        <H5 class='docuheader'>/api/requests/:request</H5>
        <H5 class='docuheader'>/api/requestors/</H5>
        <H5 class='docuheader'>/api/requestors/:requestor</H5>
        <H5 class='docuheader'>/net/api/users/</H5>
        <H5 class='docuheader'>/api/users/:user</H5>
        <input  type="text" name="request"
                value="http://reqeth.azurewebsites.net/api/"
                                                          class="form-control" id="requestField">
        <button type="submit" name="getAPI" class="btn btn-primary">
            Test GET API
        </button>
    </div>
    <label for="requestField">HTTP Status Code: <?php echo $http_status ?> </label>
</form>



<div class="container" >
    <p>
        <?php
        if ((strpos($_POST['request'], 'request') !== false) ) {
        print "<table class='apilist'>";
        print " <tr> ";
        print " <th>Request#</th> ";
        print " <th>Requestor</th> ";
        print " <th>Status</th> ";

        print " </tr> ";
        foreach($response as $item) {
            echo "<tr >";
            echo "<td >" . $item['request'] . "</td>";
            echo "<td>"  . $item['requestor'] . "</td>";
            echo "<td >" . $item['status'] . "</td>";
            echo "</tr>";
        }
        print "</table>";
        }
        ?>
    </p>
</div>


<div class="container" >
    <p>
        <?php
        if ((strpos($_POST['request'], 'user') !== false) ) {
            print "<table class='apilist'>";
            print " <tr> ";
            print " <th>UID#</th> ";
            print " <th>User Name</th> ";
            print " <th>First Name </th> ";

            print " </tr> ";
            foreach ($response as $item) {
                echo "<tr >";
                echo "<td >" . $item['uid'] . "</td>";
                echo "<td>" . $item['username'] . "</td>";
                echo "<td >" . $item['firstname'] . "</td>";
                echo "<td >" . $item['lastname'] . "</td>";
                echo "<td >" . $item['email'] . "</td>";
                echo "<td >" . $item['accessgroup'] . "</td>";
                echo "</tr>";
            }
            print "</table>";
        }
        ?>
    </p>
</div>

</body>
</html>