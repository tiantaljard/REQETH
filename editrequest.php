<?php
$page_title = "E A E R - Edit Request";
include 'partials/header.php';
include 'partials/parseRequest.php';
include 'partials/parseUpload.php';
?>
<div class="container">
    <div class="col col-lg-7">
        <h2>Edit Request#: <?php echo $request ?>  </h2>
        <hr>
        <div>
            <?php if (isset($result)) echo $result; ?>
            <?php if (!empty($form_errors)) echo show_errors($form_errors); ?>
        </div>
        <div class="clearfix"></div>

        <?php if (!isset($_SESSION['username']) || !isset($_GET['urlid'])): ?>


            <P class="lead">You are not authorized to view this page. Please follow the correct procedure. <br>  <a href="login.php">Login</a>
                Not yet registered? <a href="signup.php">Signup</a></P>
        <?php else: ?>
        <form method="post" action="" enctype="multipart/form-data">

            <div class="form-group">
                <label for="requestField">Request: </label>
                <input <? if (isset($request)) echo $readonly; ?> type="text" name="request"
                                                                  value="<?php if (isset($request)) echo $request; ?>"
                                                                  class="form-control" id="requestField">
            </div>
            <div class="form-group">
                <label for="flnameField">Requestor:</label>
                <input <? echo $readonly; ?> type="text" name="flname"
                                                                        class="form-control" id="flnameField"
                                                                        value="<?php if (isset($flname)) echo $flname; ?>">
                <input  type="hidden" name="flname"
                                                                        class="form-control" id="flnameField"
                                                                        value="<?php if (isset($flname)) echo $flname; ?>">
            </div>

            <div class="form-group">
                <label for="statusField">Status:</label>
                <input <? echo $readonly; ?> type="text" name="status"
                                                                        class="form-control" id="statusField"
                                                                        value="<?php if (isset($status)) echo $status; ?>">
                <input  type="hidden" name="status"
                                                                        class="form-control" id="statusField"
                                                                        value="<?php if (isset($status)) echo $status; ?>">
            </div>

            <div class="form-group" <?php if (isset($admineaogroup)){ ?>style="display:none"<?php } ?>>
                <label for="statusUpdateField">Route Subbmission</label>
                <select class="form-control" name="statusUpdate" id="statusUpdateField"
                        value="<?php if (isset($statusUpdate)) echo $statusUpdate; ?>" class="form-control"
                        id="statusUpdateField">
                        <option></option>
                        <option>submit</option>
                        <option>prepare</option>
                    </select>
                </div>
            <div class="form-group">
                <label for="descriptionField">Description</label>
                <input <? if (isset($admineaogroup)) echo $readonly; ?> type="text" name="description"
                                                                value="<?php if (isset($description)) echo $description; ?>"
                                                                class="form-control" id="descriptionField">
            </div>

            <div class="form-group">
                <label for="ethicsField">Ethics</label>
                <textarea <? if (isset($admineaogroup)) echo $readonly; ?> type="text" name="ethics"
                                                                           class="form-control" id="ethicsField"><?php if (isset($ethics)) echo $ethics; ?></textarea>
            </div>

            <div class="form-group" <?php if (isset($eaogroup)){ ?>style="display:none"<?php } ?> >
                <label for="eao1Field">1st EAO</label>
                <input <?  echo $readonly; ?> type="text" name="eao1"
                                                                        class="form-control" id="eao1Field"
                                                                        value="<?php if (isset($eao1)) echo $eao1; ?>">
                <input  type="hidden" name="eao1"
                                                                        class="form-control" id="eao1Field"
                                                                        value="<?php if (isset($eao1)) echo $eao1; ?>">
            </div>
            <div class="form-group" <?php if (isset($eaogroup)){ ?>style="display:none"<?php } ?> >
                <label for="eao2Field">2nd EAO</label>
                <input <?  echo $readonly; ?> type="text" name="eao2"
                                                                        class="form-control" id="eao2Field"
                                                                        value="<?php if (isset($eao2)) echo $eao2; ?>">
                <input  type="hidden" name="eao2"
                                                                        class="form-control" id="eao2Field"
                                                                        value="<?php if (isset($eao2)) echo $eao2; ?>">
            </div>
            <div class="form-group" <?php if (isset($eaostudentgroup)){ ?>style="display:none"<?php } ?>>
                <label for="assignEao1Field">Assign 1st EAO</label>
                <select class="form-control" name="assignEao1" id="assignEao1Field"
                        value="<?php if (isset($assignEao1)) echo $assignEao1; ?>" class="form-control"
                        id="assignEao1Field">
                    <option></option>
                    <option>unassigned</option>
                    <option>eaoUser1</option>
                    <option>eaoUser2</option>
                    <option>eaoUser3</option>
                    <option>eaoUser4</option>
                    <option>eaoUser5</option>
                </select>
            </div>
            <div class="form-group" <?php if (isset($eaostudentgroup)){ ?>style="display:none"<?php } ?>>
                <label for="assignEao2Field">Assign 2nd EAO</label>
                <select class="form-control" name="assignEao2" id="assignEao2Field"
                        value="<?php if (isset($assignEao2)) echo $assignEao2; ?>" class="form-control"
                        id="assignEao2Field">
                    <option></option>
                    <option>unassigned</option>
                    <option>eaoUser1</option>
                    <option>eaoUser2</option>
                    <option>eaoUser3</option>
                    <option>eaoUser4</option>
                    <option>eaoUser5</option>
                </select>
            </div>

            <div class="form-group" <?php if (isset($adminstudentgroup)){ ?>style="display:none"<?php } ?>>
                <label for="eaoCommentField">Leave Comment</label>
                <textarea type="text" name="eaocomment"
                       class="form-control" id="eaoCommentField"
                          value=""></textarea>
            </div>
            <div class="form-group" <?php if (isset($adminstudentgroup)){ ?>style="display:none"<?php } ?>>
                <label for="eaoStatusField">Route Subbmission</label>
                <select class="form-control" name="eaostatus" id="eaoStatusField"
                        value="<?php if (isset($accessgroup)) echo $accessgroup; ?>" class="form-control"
                        id="eaoStatusField">
                    <option></option>
                    <option>Approve</option>
                    <option>Reject</option>
                    <option>More Info Required</option>
                </select>
            </div>
            <div class="form-group" <?php if (isset($admineaogroup)){ ?>style="display:none"<?php } ?>>
                <label for="fileUploadField">Upload Supporting Documents</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                <input name="userfile" type="file" id="fileUploadField">
            </div>
            <input type="hidden" name="token" value="<?php if(function_exists('_token')) echo _token(); ?>">
            <button type="submit" name="updateRequestBtn" class="btn btn-primary pull-right">
                Update Request Record

            </div>
            <br/>
            <br/>
            <br/>
        </form>
    </div>


        <div class="container">
            <?php if (isset($displaycommentheaders)): ?>
                <p>
                <?php
                print "<H2 class='commentheader'>EAO Comments</H2>";

                foreach ($sqlcommentresult as $row) {
                    print "<div class='commentholder'";
                    echo "<P class='eao'><span class='username'> " . $row['username'] . "</span>";
                    echo "<span class='commentdate'> " . $row['commentdate'] . "</span></p>";
                    echo "<P class='eaorouting'> Status: " . $row['status'] . "</P>";
                    echo "<P class='comment'> " . $row['comment'] . "</P>";


                if (isset($eaogroup))
                    echo '
                            <form action="" method="post">
                            <input type="hidden" value="' . $row['uid'] . '" name="delreqcommentid">
                            <input type="submit" value="Delete">
                            </form>
                ';
                    print "</div>";


                }

                ?>
                </p>
            <?php endif ?>
        </div>

    <div class="container">

        <?php if (isset($displayheaders)): ?>


            <p>
            <?php
            print "<H2 class='docuheader'>Documents</H2>";
            print "<table class='doculist'>";
            print " <tr> ";
            print " <th>File Name</th> ";
            print " <th>File Size</th> ";
            foreach ($uploaddocsqlresult as $row) {
                echo "<tr>";
                    ?>
                <td><a href="uploads/<?php echo $row['file'] ?>" target="_blank"><?php echo $row['name'] ?></a></td>
                    <?php
                echo "<td>" . $row['size'] . "</td>";
                    if (!isset($admineaogroup))
                echo '<td>  <form action="" method="post">
                      <input type="hidden" value="'.$row['id'].'" name="delreqdocid">
                      <input type="submit" value="Delete">
                 </form>
            </td>';


                echo "</tr>";
            }
            print "</table> ";

            ?>

            </p>
        <?php endif ?>
    </div>

        <div class="form-group" <?php if (isset($admineaogroup)){ ?>style="display:none"<?php } ?>
    <?php
    $request = $request * 3;
    $urlid = base64_encode("649{$request}");
    ?>

<?php endif ?>

</section>

</div>
<?php include_once 'partials/footer.php'; ?>
</body>
</html>
