<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php include("../includes/layouts/header.php"); ?>
<?php include("../includes/layouts/sidebar.php"); ?>

        <div class="col-sm-9 main">
          <?php echo message(); ?>
          <?php $errors = errors(); ?>
          <?php echo form_errors($errors); ?>
          <h2>Create Subject</h2>
          <div class="form-group">
            <form role="form" action="create_subject.php" method="post">
              <p>
                Menu name: <input class="form-control" type="text" name="menu_name" value="">
              </p>
              <p>
                Position:
                <select name="position">
                  <?php
                  $subject_set = find_all_subjects();
                  $subject_count = mysqli_num_rows($subject_set);
                    for($count = 1; $count <= ($subject_count + 1); $count++) {
                      echo "<option value=\"{$count}\">{$count}</option>";
                    }
                  ?>
                </select>
              </p>
              <p>Visible:
                <input type="radio" name="visible" value="0">&nbsp; No
                &nbsp;
                <input type="radio" name="visible" value="1" checked>&nbsp; Yes
              </p>
              <input class="btn btn-default" type="submit" name="submit" value="Create Subject">
            </form>
          </div>
          <br>
          <a href="manage_content.php">Cancel</a>
        </div>
      </div>
    </div>
    <?php mysqli_close($conn); ?>
<?php include("../includes/layouts/footer.php");  ?>