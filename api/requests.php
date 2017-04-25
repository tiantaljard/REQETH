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
            get_requests();
        }
        break;
    case 'POST':
        // Insert request
        //insert_request();
        header("HTTP/1.0 405 Method Not Allowed");
        break;
    case 'PUT':
        // Update request
        //$request=intval($_GET["request"]);
        //update_request($request);
        header("HTTP/1.0 405 Method Not Allowed");
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
function get_requests($request = 0)
{
    global $connection;
    $query = "SELECT request,requestor,status FROM requests ";
    if ($request != 0)
    {
        $query .= " WHERE request=" . $request . " LIMIT 1";
    }
    $response = array();
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_array($result))
    {
            $response[] = $row;
    }

    try {
        JSON.parse(str);
        header('Content-Type: application/json');
        echo json_encode($response);

    } catch (e $jsonerror) {
        header("HTTP/1.0 400 Bad Request");
    }
}

