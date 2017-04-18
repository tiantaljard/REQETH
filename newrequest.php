<?php
$page_title = "E A E R - New Request";
include_once 'partials/header.php';
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
        <form method="post" <?php if (!isset($rowrequestid)) echo 'action=""'; else echo 'action="editrequest.php?urlid=' . $urlid . '"' ?>
              enctype="multipart/form-data">
            <div class="form-group" <?php if (!isset($rowrequestid)){ ?>style="display:none"<?php } ?>>
                <label for="requestField">Request</label>
                <input <? if (isset($rowrequestid)) echo $readonly; ?> type="text" name="request"
                                                                       value="<?php if (isset($rowrequestid)) echo $rowrequestid; ?>"
                                                                       class="form-control" id="requestField">
            </div>

            <div class="form-group">
                <label for="descriptionField">Description</label>
                <input <? if (isset($rowrequestid)) echo $readonly; ?> type="text" name="description"
                                                                       value="<?php if (isset($description)) echo $description; ?>"
                                                                       class="form-control" id="descriptionField">
            </div>
            <div class="form-group" <?php if (!isset($rowrequestid)){ ?>style="display:none"<?php } ?>>
                <label for="requestorField">Requestor</label>
                <input <? if (isset($rowrequestid)) echo $readonly; ?> type="text" name="requestor"
                                                                       class="form-control" id="requestorField"
                                                                       value="<?php if (isset($requestor)) echo $requestor; ?>">
            </div>
            <div class="form-group" <?php if (!isset($rowrequestid)){ ?>style="display:none"<?php } ?>>
                <label for="statusField">Status</label>
                <input <? if (isset($rowrequestid)) echo $readonly; ?> type="text" name="status"
                                                                       class="form-control" id="statusField"
                                                                       value="<?php if (isset($status)) echo $status; ?>">
            </div>
            <div class="form-group" >
                <label for="ethicsField">Ethics</label>
                <textarea <? if (isset($rowrequestid)) echo $readonly; ?> type="text" name="ethics"
                                                                           class="form-control" id="ethicsField"><?php if (isset($ethics)) echo $ethics; ?></textarea>
            </div>

            <input type="hidden" name="token" value="<?php if(function_exists('_token')) echo _token(); ?>">
            <button type="submit" name="insertRequestBtn" class="btn btn-primary pull-right"
                    <?php if (isset($rowrequestid)){ ?>style="display:none"<?php } ?>>
                Insert Ethics Request Record
            </button>
            <button type="submit" name="editNewRequestBtn" class="btn btn-primary pull-right"
                    <?php if (!isset($rowrequestid)){ ?>style="display:none"<?php } ?>>
                Edit Ethics Request Record
            </button>

            <br/>
        </form>

        <div class="form-group" <?php if (!isset($rowrequestid)){ ?>style="display:none"<?php } ?>

    <?php echo "<p><a href='upload.php?urlid=$urlid'>Upload Doc</a></p>"; ?>

</div>

<?php endif ?>
</section>
</div>
<?php include_once 'partials/footer.php'; ?>
</body>
</html>