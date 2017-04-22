<?php
// Code adopted from:
// https://www.apptha.com/blog/how-to-build-a-rest-api-using-php/
// as on 22 April 20:00


// Connect to database
include_once '../resource/dbConnect.php';

$request_method=$_SERVER["REQUEST_METHOD"];
switch($request_method)
{
    case 'GET':
        // Retrive requests
        if(!empty($_GET["request_id"]))
        {
            $request_id=intval($_GET["request_id"]);
            get_requests($request_id);
        }
        else
        {
            get_requests();
        }
        break;
    case 'POST':
        // Insert request
        insert_request();
        break;
    case 'PUT':
        // Update request
        $request_id=intval($_GET["request_id"]);
        update_request($request_id);
        break;
    case 'DELETE':
        // Delete request
        $request_id=intval($_GET["request_id"]);
        delete_request($request_id);
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}



function get_requests($request_id=0)
{
    global $connection;
    $query="SELECT * FROM requests";
    if($request_id != 0)
    {
        $query.=" WHERE request=".$request_id." LIMIT 1";
    }
    $response=array();
    $result=mysqli_query($connection, $query);
    while($row=mysqli_fetch_array($result))
    {
        $response[]=$row;
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function update_request($request_id)
{
    global $connection;
    parse_str(file_get_contents("php://input"),$post_vars);
    $description=$post_vars["description"];
    $query="UPDATE requests SET desription='{$description}' WHERE request=".$request_id;
    if(mysqli_query($connection, $query))
    {
        $response=array(
            'status' => 1,
            'status_message' =>'request Updated Successfully.'
        );
    }
    else
    {
        $response=array(
            'status' => 0,
            'status_message' =>'request Updation Failed.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
function delete_request($request_id)
{
    global $connection;
    $query="DELETE FROM requests WHERE request=".$request_id;
    if(mysqli_query($connection, $query))
    {
        $response=array(
            'status' => 1,
            'status_message' =>'request Deleted Successfully.'
        );
    }
    else
    {
        $response=array(
            'status' => 0,
            'status_message' =>'request Deletion Failed.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>


