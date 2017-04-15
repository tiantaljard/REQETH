<?php
$page_title = "E A E R - New Request";
include_once 'partials/header.php';
include 'partials/parseRequest.php';
include 'partials/parseNewRequest.php';

?>
<div class="container">
    <section class="col col-lg-7">
        <h2>Create New Request: <?php echo $admineaogroup ?>  </h2>
        <hr>
        <div>
            <?php if (isset($result)) echo $result; ?>
            <?php if (!empty($form_errors)) echo show_errors($form_errors); ?>
        </div>
        <div class="clearfix"></div>


        <?php if (!isset($_SESSION['username']) || !isset($studentgroup)): ?>
            <P class="lead">You are not authorized to view this page <a href="login.php">Login</a>
                Not yet registered? <a href="signup.php">Signup</a></P>
        <?php else: ?>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="descriptionField">Description</label>
                <input <? if (isset($admineaogroup)) echo $readonly; ?> type="text" name="description"
                                                                        value="<?php if (isset($description)) echo $description; ?>"
                                                                        class="form-control" id="descriptionField">
            </div>
            <div class="form-group">
                <label for="ethicsField">Ethics</label>
                <input <? if (isset($admineaogroup)) echo $readonly; ?> type="text" name="ethics"
                                                                        class="form-control" id="ethicsField"
                                                                        value="<?php if (isset($ethics)) echo $ethics; ?>">
            </div>

            <button type="submit" name="insertRequestBtn" class="btn btn-primary pull-right">
                Insert Ethics Request Record
            </button>
            <br/>
        </form>




        <div class="form-group" style="display:none">

    <?php
    $request = $request * 3;
    $urlid = base64_encode("649{$request}");
    echo "<p><a href='upload.php?urlid=$urlid'>Upload Doc</a></p>";
    ?>
        </div>
<div>
    <p><a href="requestList.php">Request List</a></p>
</div>
<?php endif ?>
</section>
</div>
<?php include_once 'partials/footer.php'; ?>
</body>
</html>