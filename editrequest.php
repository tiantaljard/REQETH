<?php
$page_title = "E A E R - Edit Request";
include_once 'partials/header.php';
include 'partials/parseRequest.php';

?>

<div class="container">
    <section class="col col-lg-7">
        <h2>Edit Request#: <?php echo $request ?>  </h2>
        <hr>
        <div>
            <?php if (isset($result)) echo $result; ?>
            <?php if (!empty($form_errors)) echo show_errors($form_errors); ?>
        </div>
        <div class="clearfix"></div>

        <?php if (!isset($_SESSION['username']) || !isset($_GET['urlid'])): ?>
            <P class="lead">You are not authorized to view this page <a href="login.php">Login</a>
                Not yet registered? <a href="signup.php">Signup</a></P>
        <?php else: ?>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="requestField">Request</label>
                <input <? if (isset($request)) echo $readonly; ?> type="text" name="request"
                                                                  value="<?php if (isset($request)) echo $request; ?>"
                                                                  class="form-control" id="requestField">
            </div>

            <div class="form-group">
                <label for="descriptionField">Description</label>
                <input <? if (isset($admineaogroup)) echo $readonly; ?> type="text" name="description"
                                                                        value="<?php if (isset($description)) echo $description; ?>"
                                                                        class="form-control" id="descriptionField">
            </div>

            <div class="form-group">
                <label for="requestorField">Requestor</label>
                <input <? if (isset($admineaogroup)) echo $readonly; ?> type="text" name="requestor"
                                                                        class="form-control" id="requestorField"
                                                                        value="<?php if (isset($requestor)) echo $requestor; ?>">
            </div>

            <div class="form-group">
                <label for="statusField">Status</label>
                <input <? if (isset($admineaogroup)) echo $readonly; ?> type="text" name="status"
                                                                        class="form-control" id="statusField"
                                                                        value="<?php if (isset($status)) echo $status; ?>">
            </div>

            <div class="form-group">
                <label for="ethicsField">Ethics</label>
                <input <? if (isset($admineaogroup)) echo $readonly; ?> type="text" name="ethics"
                                                                        class="form-control" id="ethicsField"
                                                                        value="<?php if (isset($ethics)) echo $ethics; ?>">
            </div>

            <div class="form-group" <?php if (isset($eaostudentgroup)){ ?>style="display:none"<?php } ?> >
                <label for="eao1Field">1st EAO</label>
                <input <? if (isset($eaostudentgroup)) echo $readonly; ?> type="text" name="eao1"
                                                                          class="form-control" id="eao1Field"
                                                                          value="<?php if (isset($eao1)) echo $eao1; ?>">
            </div>

            <div class="form-group" <?php if (isset($eaostudentgroup)){ ?>style="display:none"<?php } ?>>
                <label for="eao2Field">2st EAO</label>
                <input <? if (isset($eaostudentgroup)) echo $readonly; ?> type="text" name="eao2"
                                                                          class="form-control" id="eao2Field"
                                                                          value="<?php if (isset($eao2)) echo $eao2; ?>">
            </div>


            <button type="submit" name="updateProfileBtn" class="btn btn-primary pull-right">
                Update Request Record
            </button>


            <br/>

        </form>


        <div class="form-group" <?php if (isset($admineaogroup)){ ?>style="display:none"<?php } ?>
    <?php
    $request = $request * 3;
    $urlid = base64_encode("649{$request}");
    echo "<p><a href='upload.php?urlid=$urlid'>Upload Doc</a></p>";
    ?>

</div>


    <p><a href="requestList.php">Request List</a></p>

<?php endif ?>

</section>

</div>
<?php include_once 'partials/footer.php'; ?>
</body>
</html>
