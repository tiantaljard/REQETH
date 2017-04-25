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

            try {
                $request = intval($_GET["request"]);
                get_requests($request);
            } catch (reqeustException $ex) {header("HTTP/1.0 204 That Content Other not Found");}


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
    try {
        $response = array();

    } catch (reqeustException $ex) {header("HTTP/1.0 204 That Content not Found");}

    $response = array();
    $result = mysqli_query($connection, $query);

    try {
    while ($row = mysqli_fetch_array($result))
    {
            $response[] = $row;
    }
        header('Content-Type: application/json');
        echo json_encode($response);
    } catch (reqeustException $ex)
        {header("HTTP/1.0 204 No Content Found");}
}

