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
            $required_fields = array("menu_name", "position", "visible", "content");
            validate_presences($required_fields);

            $fields_with_max_lengths = array("menu_name" => 30);
            validate_max_lengths($fields_with_max_lengths);

            if (empty($errors)) {

              // Perform create
              $subject_id = $current_subject["id"];
              $menu_name = mysql_prep($_POST["menu_name"]);
              $position = (int) $_POST["position"];
              $visible = (int) $_POST["visible"];
              $content = mysql_prep($_POST["content"]);

              // 2. Perform database query
              $query  = "INSERT INTO pages (";
              $query .= "  subject_id, menu_name, position, visible, content";
              $query .= ") VALUES (";
              $query .= "  {$subject_id}, '{$menu_name}', {$position}, {$visible}, '{$content}'";
              $query .= ")";
              $result = mysqli_query($conn, $query);

              if ($result) {
                // Success
                $_SESSION["message"] = "Page created.";
                // redirect_to("manage_content.php"); Redirect not working
              } else {
                $_SESSION["message"] = "Page creation failed.";
                // die("Database query failed. " . mysqli_error($connection));
              }
            }
            } else {
              // Probably a GET request
            } // if (isset($_POST['submit']))
          ?>
          <?php if (!empty($_SESSION["message"])) {
            echo "<div class=\"alert alert-info\">" . $_SESSION["message"] . "</div>";
            $_SESSION["message"] = null;
          } ?>
          <?php echo form_errors($errors); ?>
          <h2>Create Page</h2>
          <div class="form-group">
            <form role="form" method="post" action="new_page.php?subject=<?php echo urlencode($current_subject["id"]); ?>" >
              <p>
                Menu name: <input class="form-control" type="text" name="menu_name" value="">
              </p>
              <p>
                Position:
                <select name="position">
                  <?php
                  $page_set = find_pages_for_subject($current_subject["id"], false);
                  $page_count = mysqli_num_rows($page_set);
                    for($count = 1; $count <= ($page_count + 1); $count++) {
                      echo "<option value=\"{$count}\">{$count}</option>";
                    }
                  ?>
                </select>
              </p>
              <p>Visible:
                <input type="radio" name="visible" value="0"> No
                &nbsp;
                <input type="radio" name="visible" value="1" checked> Yes
              </p>
              <p>Content:<br>
                <textarea name="content" rows="20" cols="80"></textarea>
              </p>
              <input class="btn btn-default" type="submit" name="submit" value="Create Page">
            </form>
          </div>
          <br>
          <a href="manage_content.php?subject=<?php echo urlencode($current_subject["id"]); ?>">Cancel</a>
        </div>
      </div>
    </div>
    <?php mysqli_close($conn); ?>
<?php include("../includes/layouts/footer.php");  ?>
