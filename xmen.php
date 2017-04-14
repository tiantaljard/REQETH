<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>X-Men Movies</title>
</head>
<body>
<header>
    <h1>X-Men  Movies</h1>
</header>
<main>
    <section>
        <h2>List of all Marvel Movies</h2>
        <?
        //M
        include 'resource/dbConnect.php';
        $sql_query = "SELECT marvelMovieID,yearReleased,title,productionStudio,notes,CHAR_LENGTH (notes) as llen FROM marvelmovies where UPPER(title) like '%MEN%'; ";
        $statement = $db->prepare($sql_query);
        $statement->execute(array());


        $result = $statement->fetchAll();
        //print_r($result);

        foreach ($result as $row)
        {
            echo $row['title'] .'  ' .$row['yearReleased'] . "<br>";
        }

            // print out fields from row of data
         //   echo "<p>".$row ['marvelMovieID']. " - ". $row ['yearReleased']." - ".$row ['title']." - ".$row ['productionStudio'].$db."</p>";
        //    $notes=$row ['notes'];
         //   $len=$row ['llen'];
         //   $isnull=$row ['isn'];
         //   if ($len>0) {
      //      echo "<p>".$row ['marvelMovieID']. " - ". $row ['title']." - ".$row ['productionStudio'].$db."</p>";
       //     }


        //}
        //$result->close();
        //$db->close();
        ?>



    </section>

</main>
<footer>
</footer>
</body>
</html>