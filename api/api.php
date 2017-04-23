<?php
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);
if (!$input) $input = array();
// connect to the mysql database
//$link = mysqli_connect('localhost', 'php-crud-api', 'php-crud-api', 'php-crud-api');
$connectstr_dbhost = '';
$connectstr_dbname = '';
$connectstr_dbusername = '';
$connectstr_dbpassword = '';

// get connection detail for azure host and db
foreach ($_SERVER as $key => $value) {
    if (strpos($key, "MYSQLCONNSTR_localdb") !== 0) {
        continue;
    }
    $connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
    $connectstr_dbname = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
    $connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
    $connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
}

//If we are not on Azure
if (!$connectstr_dbhost) {
    $connectstr_dbhost = 'localhost';
    $connectstr_dbname = 'reqlocaldb';
    $connectstr_dbusername = 'root';
    $connectstr_dbpassword = 'Zppsit0!';
}

$connection=mysqli_connect($connectstr_dbhost,$connectstr_dbusername,$connectstr_dbpassword,$connectstr_dbname);
$link=mysqli_connect($connectstr_dbhost,$connectstr_dbusername,$connectstr_dbpassword,$connectstr_dbname);




mysqli_set_charset($link,'utf8');
// retrieve the table and key from the path
$table = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
$key = array_shift($request)+0;
// escape the columns and values from the input object
$columns = preg_replace('/[^a-z0-9_]+/i','',array_keys($input));
$values = array_map(function ($value) use ($link) {
    if ($value===null) return null;
    return mysqli_real_escape_string($link,(string)$value);
},array_values($input));
// build the SET part of the SQL command
$set = '';
for ($i=0;$i<count($columns);$i++) {
    $set.=($i>0?',':'').'`'.$columns[$i].'`=';
    $set.=($values[$i]===null?'NULL':'"'.$values[$i].'"');
}
// create SQL based on HTTP method
switch ($method) {
    case 'GET':
        $sql = "select * from `$table`".($key?" WHERE id=$key":''); break;
    case 'PUT':
        $sql = "update `$table` set $set where id=$key"; break;
    case 'POST':
        $sql = "insert into `$table` set $set"; break;
    case 'DELETE':
        $sql = "delete `$table` where id=$key"; break;
}
// execute SQL statement
$result = mysqli_query($link,$sql);
// die if SQL statement failed
if (!$result) {
    http_response_code(404);
    die(mysqli_error());
}
// print results, insert id or affected row count
if ($method == 'GET') {
    if (!$key) echo '[';
    for ($i=0;$i<mysqli_num_rows($result);$i++) {
        echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
    }
    if (!$key) echo ']';
} elseif ($method == 'POST') {
    echo mysqli_insert_id($link);
} else {
    echo mysqli_affected_rows($link);
}
// close mysql connection
mysqli_close($link);