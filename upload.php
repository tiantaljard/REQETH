<?php
$page_title = "E A E R - Upload Document";
include_once 'partials/header.php';
include 'partials/parseRequest.php';
include 'partials/parseUpload.php';
?>

<div class="container">


    <section class="col col-lg-7">
        <h2>Upload Documents for : <?php echo $description ?>  </h2>
        <hr>

        <div>
            <?php if (isset($result)) echo $result; ?>
            <?php if (!empty($form_errors)) echo show_errors($form_errors); ?>
        </div>

        <div class="clearfix"></div>

        <?php if (!isset($studentgroup)): ?>
            <p class="lead">You are not authorized to view this page <a href="login.php">Login</a>
                Not yet registered? <a href="signup.php">Signup</a></p>


        <?php else: ?>
        <form method="post" enctype="multipart/form-data">
            <table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
                <tr>
                    <td width="246">
                        <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                        <input name="userfile" type="file" id="userfile">
                    </td>
                    <td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td>
                </tr>
            </table>
        </form



        <br>
        <?php
        $request = $request * 3;
        $urlid = base64_encode("649{$request}");
        echo "<p><a href='editrequest.php?urlid=$urlid'>Edit Request</a></p>";
        ?>
        <p><a href="requestList.php">Request List</a></p>
    </section>

    <?php endif ?>
</div>

<div class="container">
    <table width="80%" border="1">
        <tr>
            <td>File Name</td>
            <td>File Type</td>
            <td>File Size(KB)</td>
            <td>View</td>
        </tr>
        <?php
        foreach ($sqlresult as $row)
        {
            ?>
            <tr>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['type'] ?></td>
                <td><?php echo $row['size'] ?></td>
                <td><a href="uploads/<?php echo $row['file'] ?>" target="_blank">Get file</a></td>
            </tr>
            <?php
        }
        ?>
    </table>

</div>






<?php include_once 'partials/footer.php'; ?>
</body>
</html>