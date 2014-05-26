<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php $layout_context = "admin" ?>
<?php include("../includes/layouts/header.php"); ?>

        <div class="col-sm-9 main">
          <?php
          $username = "";
          if (isset($_POST['submit'])) {
            // validations
            $required_fields = array("username", "password");
            validate_presences($required_fields);

            if (empty($errors)) {

              // Attempt login
              $username = $_POST["username"];
              $password = $_POST["password"];
              $found_admin = attempt_login($username, $password);

              if ($found_admin) {
                // Success
                // Mark user as logged in
                $_SESSION["admin_id"] = $found_admin["id"];
                $_SESSION["username"] = $found_admin["username"];
                redirect_to("admin.php");
              } else {
                $_SESSION["message"] = "Username/password not found.";
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
          <h2>Login</h2>
          <div class="form-group">
            <form role="form" method="post" action="login.php">
              <p>
                Username: <input class="form-control" type="text" name="username" value="<?php echo htmlentities($username); ?>">
              </p>
              <p>
                Password: <input class="form-control" type="text" name="password" value="">
              </p>
              <input class="btn btn-default" type="submit" name="submit" value="Submit">
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php mysqli_close($conn); ?>
<?php include("../includes/layouts/footer.php");  ?>
