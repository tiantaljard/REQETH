<?php
// Code below adopted from http://www.codingcage.com/2014/12/file-upload-and-view-with-php-and-mysql.html
// as at 12 April 2017 09:00
// AND also from
// Code below adapted from online course:
// site:            https://www.udemy.com
// Course title:    PHP: Complete Login and Registration System with PHP & MYSQL
// Instructor:      Osayawe Terry Ogbemudia

//add database connection script
include_once 'resource/dbConnect.php';
//include formvalidation functions
include_once 'resource/utilities.php';



$sql_query = "select * from uploads where request=:requestid; ";
$statement = $db->prepare($sql_query);
$statement->execute(array(':requestid' => $requestid));
$result = $statement->fetchAll();
if ($statement->rowCount() > 0) {
    $displayheaders="displayFUheaders";
}




if (isset($_POST['upload'])) {

    //if(isset($_POST['upload']) && $_FILES['file']['size'] > 0){


    //array to hold errors
    $form_errors = array();

    if (empty($form_errors)) {

        $file = rand(1000, 100000) . "-" . $_FILES['userfile']['name'];
        $file_name = $_FILES['userfile']['name'];
        $tmpName  = $_FILES['userfile']['tmp_name'];
        $file_loc = $_FILES['userfile']['tmp_name'];
        $userfiletmp=addslashes (file_get_contents($_FILES['userfile']['tmp_name']));

        $file_size = $_FILES['userfile']['size'];
        $file_type = $_FILES['userfile']['type'];
        $folder = "uploads/";

        $content =$userfiletmp;

        echo $folder;

        if(!get_magic_quotes_gpc())
        {
            $fileName = addslashes($fileName);
        }

        if (move_uploaded_file($file_loc, $folder . $file)) {
            try {
                //create SQL insert statement
                $sqlInsert = "INSERT INTO uploads(request,file,name,type,size,content) VALUES(:request,:file,:filename,:file_type,:file_size,:content)";


                //use PDO prepared to sanitize data
                $statement = $db->prepare($sqlInsert);
                //add the data into the database
                $statement->execute(array(':request' => $requestid, ':file' => $file, ':filename' => $file_name, ':file_type' => $file_type, ':file_size' => $file_size, ':content' => $content));


                //check if one new row was created
                if ($statement->rowCount() == 1) {
                    $result = flashMessage("File uploaded successfully: ".$file_name, "Pass");
                }
            } catch (PDOException $ex) {


                $result = flashMessage("An error occued: " . $ex->getMessage());
            }
        } else {
            $result = flashmessage("No file was selected, please select a file  BB");
        }
    } else {
        if (count($form_errors) == 1) {
            $result = flashmessage("There was 1 error in the form<br>");
        } else {
            $result = flashmessage("There were " . count($form_errors) . " errors in the form <br>");
        }

    }
}//}
?>
<!--
if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
{
$fileName = $_FILES['userfile']['name'];
$tmpName  = $_FILES['userfile']['tmp_name'];
$fileSize = $_FILES['userfile']['size'];
$fileType = $_FILES['userfile']['type'];

$fp      = fopen($tmpName, 'r');
$content = fread($fp, filesize($tmpName));
$content = addslashes($content);
fclose($fp);

if(!get_magic_quotes_gpc())
{
$fileName = addslashes($fileName);
}
include 'library/config.php';
include 'library/opendb.php';

$query = "INSERT INTO upload (name, size, type, content ) ".
"VALUES ('$fileName', '$fileSize', '$fileType', '$content')";

mysql_query($query) or die('Error, query failed');
include 'library/closedb.php';

echo "<br>File $fileName uploaded<br>";
}
?>


-->