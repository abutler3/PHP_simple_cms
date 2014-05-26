<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php $layout_context = "admin" ?>
<?php include("../includes/layouts/header.php"); ?>
<?php include("../includes/layouts/sidebar.php"); ?>

        <div class="col-sm-9 main">
          <?php
          if (isset($_POST['submit'])) {
            // validations
            $required_fields = array("menu_name", "position", "visible");
            validate_presences($required_fields);

            $fields_with_max_lengths = array("menu_name" => 30);
            validate_max_lengths($fields_with_max_lengths);

            if (empty($errors)) {

              // Perform update
              $id = $current_subject["id"];
              $menu_name = mysql_prep($_POST["menu_name"]);
              $position = (int) $_POST["position"];
              $visible = (int) $_POST["visible"];

              // 2. Perform database query
              $query  = "UPDATE subjects SET ";
              $query .= "menu_name = '{$menu_name}', ";
              $query .= "position = {$position}, ";
              $query .= "visible = {$visible} ";
              $query .= "WHERE id = {$id} ";
              $query .= "LIMIT 1";
              $result = mysqli_query($conn, $query);

              if ($result && mysqli_affected_rows($conn) >= 0) {
                // Success
                $_SESSION["message"] = "Subject updated.";
              } else {
                $_SESSION["message"] = "Subject update failed.";
                // die("Database query failed. " . mysqli_error($connection));
              }
            }
            } else {
              // Probably a GET request

            } // if (isset($_POST['submit']))

          ?>

          <?php if (!empty($_SESSION["message"])) {
            echo "<div class=\"alert alert-info\">" . htmlentities($_SESSION["message"]) . "</div>";
            $_SESSION["message"] = null;
          } ?>
          <?php echo form_errors($errors); ?>
          <h2>Edit Subject: <?php echo htmlentities($current_subject["menu_name"]); ?></h2>
          <div class="form-group">
            <form role="form" method="post" action="edit_subject.php?subject=<?php echo urlencode($current_subject["id"]); ?>" >
              <p>
                Menu name: <input class="form-control" type="text" name="menu_name" value="<?php echo htmlentities($current_subject["menu_name"]); ?>">
              </p>
              <p>
                Position:
                <select name="position">
                  <?php
                  $subject_set = find_all_subjects(false);
                  $subject_count = mysqli_num_rows($subject_set);
                    for($count = 1; $count <= ($subject_count); $count++) {
                      echo "<option value=\"{$count}\"";
                      if ($current_subject["position"] == $count) {
                        echo " selected";
                      }
                      echo ">{$count}</option>";
                    }
                  ?>
                </select>
              </p>
              <p>Visible:
                <input type="radio" name="visible" value="0" <?php if ($current_subject["visible"] == 0) { echo "checked"; }?> >&nbsp; No
                &nbsp;
                <input type="radio" name="visible" value="1" <?php if ($current_subject["visible"] == 1) { echo "checked"; }?> >&nbsp; Yes
              </p>
              <input class="btn btn-default" type="submit" name="submit" value="Edit Subject">
            </form>
          </div>
          <br>
          <a href="manage_content.php">Cancel</a>
          &nbsp;
          &nbsp;
          <a href="delete_subject.php?subject=<?php echo urlencode($current_subject["id"]); ?>" onclick="return confirm('Are you sure?');">Delete Subject</a>
        </div>
      </div>
    </div>
    <?php mysqli_close($conn); ?>
<?php include("../includes/layouts/footer.php");  ?>
