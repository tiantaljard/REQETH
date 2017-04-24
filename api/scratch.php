<?php
/**
 * Created by PhpStorm.
 * User: TianTaljard
 * Date: 24/04/2017
 * Time: 09:40
 */

//function get_requests($request=0)
//{
//    global $connection;
//    $query="SELECT request,requestor,status FROM requests ";
//    if($request != 0)
//    {
//        $query.=" WHERE request=".$request." LIMIT 1";
//    }
//    $response=array();
//
//    if (!mysqli_query($connection,$query))
//    {
//        $apiQueryError=("Error description: " . mysqli_error($connection));
//    } else {
//        $result=mysqli_query($connection, $query);
//
//        while($row=mysqli_fetch_array($result))
//        {
//            $response[]=$row;
//        }
//        header('Content-Type: application/json');
//        echo json_encode($response);
//    }
//
//
//}

//
//
//WORKING
//
//function get_requests($request=0)
//{
//    global $connection;
//    $query="SELECT request,requestor,status FROM requests ";
//    if($request != 0)
//    {
//        $query.=" WHERE request=".$request." LIMIT 1";
//    }
//    $response=array();
//    $result=mysqli_query($connection, $query);
//
//    while($row=mysqli_fetch_array($result))
//    {
//        $response[]=$row;
//    }
//    header('Content-Type: application/json');
//    echo json_encode($response);
//}
//
//
//?>