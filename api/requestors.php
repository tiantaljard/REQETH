<?php
// Code adopted from:
// https://www.apptha.com/blog/how-to-build-a-rest-api-using-php/
// as on 22 April 20:00 please sync. try again.
// Connect to database
include_once '../resource/dbConnect.php';
$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'GET':
        // Retrive requestors
        if (!empty($_GET["requestor"])) {
                $requestor = ($_GET["requestor"]);
                get_requestors($requestor);
        } else {
            get_requestors();
        }
        break;
    case 'POST':
        // Insert requestor
        //insert_requestor();
        header("HTTP/1.0 405 Method Not Allowed");
        break;
    case 'PUT':
        // Update requestor
        //$requestor=intval($_GET["requestor"]);
        //update_requestor($requestor);
        header("HTTP/1.0 405 Method Not Allowed");
        break;
    case 'DELETE':
        // Delete requestor
        $requestor = intval($_GET["requestor"]);
        header("HTTP/1.0 405 Method Not Allowed");
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
function get_requestors($requestor)
{
    global $connection;
    $query = "SELECT request,requestor,status FROM requests ";
    if (strlen($requestor)>0)
    {
        $query .= ' WHERE requestor="' . $requestor . '"';
    }

    $response = array();
    $result = mysqli_query($connection, $query);
    $row_cnt = $result->num_rows;
    if ($row_cnt >0) {
        while ($row = mysqli_fetch_array($result))
        {
            $response[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($response);

    } else {
        header("HTTP/1.1 204 No Content Found");
    }
}
