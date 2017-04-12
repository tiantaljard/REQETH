<?php
$page_title = "E A E R - Edit Request";
include_once 'partials/header.php';
include 'partials/parseRequest.php';

?>

<div class="container">
    <section class="col col-lg-7">
        <h2>Edit Request#: <?php echo $request ?>  </h2><hr>
        <div>
            <?php if(isset($result)) echo $result; ?>
            <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
        </div>
        <div class="clearfix"></div>

        <?php if(!isset($_SESSION['username']) ): ?>
            <P class="lead">You are not authorized to view this page <a href="login.php">Login</a>
                Not yet a member? <a href="signup.php">Signup</a> </P>
        <?php else: ?>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="requestField">Request</label>
                    <input <? if(isset($request)) echo $readonly; ?> type="text" name="request" value="<?php if(isset($request)) echo $request; ?>" class="form-control" id="requestField">
                </div>

                <div class="form-group">
                    <label for="descriptionField">Description</label>
                    <input <? if(isset($admineaogroup)) echo $readonly; ?> type="text" name="description" value="<?php if(isset($description)) echo $description; ?>" class="form-control" id="descriptionField">
                </div>

                <div class="form-group">
                    <label for="requestorField">Requestor</label>
                    <input <? if(isset($admineaogroup)) echo $readonly; ?> type="text" name="requestor" class="form-control" id="requestorField" value="<?php if(isset($requestor)) echo $requestor; ?>">
                </div>

                <div class="form-group">
                    <label for="statusField">Status</label>
                    <input <? if(isset($admineaogroup)) echo $readonly; ?> type="text" name="status" class="form-control" id="statusField" value="<?php if(isset($status)) echo $status; ?>">
                </div>

                <div class="form-group">
                    <label for="ethicsField">Ethics</label>
                    <input <? if(isset($admineaogroup)) echo $readonly ; ?> type="text" name="ethics" class="form-control" id="ethicsField" value="<?php if(isset($ethics)) echo $ethics; ?>">
                </div>


                <div class="form-group">
                    <label  for="fileField">Document</label>
                    <input type="file" name="file" id="fileField" class="btn btn-default ">
                    <button type="submit" name="fileUploadBtn" class="btn btn-default ">Upload selected file</button>
                </div>

                <div class="form-group" <?php if(isset($eaostudentgroup)){?>style="display:none"<?php } ?> >
                    <label for="eao1Field">1st EAO</label>
                    <input <? if(isset($eaostudentgroup)) echo $readonly; ?>  type="text" name="eao1" class="form-control" id="eao1Field" value="<?php if(isset($eao1)) echo $eao1; ?>">
                </div>

                <div class="form-group" <?php if(isset($eaostudentgroup)){?>style="display:none"<?php } ?>>
                    <label for="eao2Field">2st EAO</label>
                    <input <? if(isset($eaostudentgroup)) echo $readonly; ?> type="text" name="eao2" class="form-control" id="eao2Field" value="<?php if(isset($eao2)) echo $eao2; ?>">
                </div>

                <!--<div class="form-group">
                <label for="accessgroupField">Access Group</label>
                <select class="form-control" name="accessgroup" id="accessgroupField" value="<?php /*if(isset($accessgroup)) echo $accessgroup; */?>" class="form-control" id="accessgroupField">
                    <option>student</option>
                    <option>eao</option>
                    <option>admin</option>
                </select>
                </div>-->

<!--                <div class="form-group">
                    <input type="hidden" name="username" value="<?php /*if(isset($username)) echo $username; */?>" class="form-control" id="username">
                </div>-->
                <!--<input type="hidden" name="token" value="<?php /*if(function_exists('_token')) echo _token(); */?>">-->
                <button type="submit" name="updateProfileBtn" class="btn btn-primary pull-right">
                    Update Request Record</button> <br />
            </form>

        <?php endif ?>
    </section>
    <p><a href="requestList.php">Request List</a> </p>
</div>
<?php include_once 'partials/footer.php'; ?>
</body>
</html>
