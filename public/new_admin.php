<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php $layout_context = "admin" ?>
<?php include("../includes/layouts/header.php"); ?>

        <div class="col-sm-9 main">
          <?php
          if (isset($_POST['submit'])) {
            // validations
            $required_fields = array("username", "password");
            validate_presences($required_fields);

            $fields_with_max_lengths = array("username" => 30);
            validate_max_lengths($fields_with_max_lengths);

            if (empty($errors)) {

              // Perform create
              $username = mysql_prep($_POST["username"]);
              $hashed_password = mysql_prep($_POST["password"]);

              // 2. Perform database query
              $query  = "INSERT INTO admins (";
              $query .= "  username, hashed_password";
              $query .= ") VALUES (";
              $query .= "  '{$username}', '{$hashed_password}'";
              $query .= ")";
              $result = mysqli_query($conn, $query);

              if ($result) {
                // Success
                $_SESSION["message"] = "Admin created.";
                redirect_to("manage_content.php");
              } else {
                $_SESSION["message"] = "Admin creation failed.";
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
          <h2>Create Admin</h2>
          <div class="form-group">
            <form role="form" method="post" action="new_admin.php">
              <p>
                Username: <input class="form-control" type="text" name="username" value="">
              </p>
              <p>
                Password: <input class="form-control" type="text" name="password" value="">
              </p>
              <input class="btn btn-default" type="submit" name="submit" value="Create Admin">
            </form>
          </div>
          <br>
          <a href="manage_admins.php">Cancel</a>
        </div>
      </div>
    </div>
    <?php mysqli_close($conn); ?>
<?php include("../includes/layouts/footer.php");  ?>
