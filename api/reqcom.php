<?php
// Code adopted from:
// https://www.apptha.com/blog/how-to-build-a-rest-api-using-php/
// as on 22 April 20:00 please sync. try again.
// Connect to database
include_once '../resource/dbConnect.php';
$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'GET':
        // Retrive requests
        if (!empty($_GET["request"])) {
                $request = intval($_GET["request"]);
                get_requests($request);
        } else {
            header("HTTP/1.0 422 record :request key required");
        }
        break;
    case 'POST':
        // Insert request
        //insert_request();
        header("HTTP/1.0 405 Method Not Allowed");
        break;
    case 'PUT':
        // Update request
        $request=intval($_GET["request"]);
        update_request($request);
        //header("HTTP/1.0 405 Method Not Allowed");
        break;
    case 'DELETE':
        // Delete request
        $request = intval($_GET["request"]);
        header("HTTP/1.0 405 Method Not Allowed");
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
function get_requests($request)
{
    global $connection;
    $query = "SELECT ru.lastname as requestorlastname,au.lastname as apprvlastname,c.comment,c.commentdate,c.status
                FROM requests r, comments c, users ru, users au  where r.request=c.request and r.requestor=ru.username
                and c.username=au.username ";
    if (strlen($request) >0)
    {
        $query .= " AND request=" . $request . " ";
    }

    $response = array();
    $result = mysqli_query($connection, $query);
    $row_cnt = $result->num_rows;
    if ($row_cnt >0) {
        while ($row = mysqli_fetch_assoc($result))
        {
            $response[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($response);

    } else {
        echo $query." here ";
     //   header("HTTP/1.0 204 No Content Found");
    }
}