<?php
// Code adopted from:
// https://www.apptha.com/blog/how-to-build-a-rest-api-using-php/
// as on 22 April 20:00 please sync. try again.
// Connect to database
include_once '../resource/dbConnect.php';
$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'GET':
        // Retrive users
        if (!empty($_GET["user"])) {
                $user = ($_GET["user"]);
                get_users($user);
        } else {
            get_users();
        }
        break;
    case 'POST':
        // Insert user
        //insert_user();
        header("HTTP/1.0 405 Method Not Allowed");
        break;
    case 'PUT':
        // Update user
        //$user=intval($_GET["user"]);
        //update_user($user);
        header("HTTP/1.0 405 Method Not Allowed");
        break;
    case 'DELETE':
        // Delete user
        $user = intval($_GET["user"]);
        header("HTTP/1.0 405 Method Not Allowed");
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
function get_users($user)
{
    global $connection;
    $query = "SELECT uid,username,firstname,lastname,email,accessgroup FROM users ";
    if (strlen($user)>0)
    {
        $query .= " WHERE username='" . $user . "' LIMIT 1";
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
        header("HTTP/1.0 204 No Content Found");
    }
}
