<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php $layout_context = "admin" ?>
<?php include("../includes/layouts/header.php"); ?>
<?php $admin = find_admin_by_id($_GET["id"]);
  if (!$admin) {
    redirect_to("manage_admins.php");
  }

?>
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
              $id = $admin["id"];
              $username = mysql_prep($_POST["username"]);
              $hashed_password = password_encrypt($_POST["password"]);

              // 2. Perform database query
              $query  = "UPDATE admins SET ";
              $query .= "username = '{$username}', ";
              $query .= "hashed_password = '{$hashed_password}' ";
              $query .= "WHERE id = {$id} ";
              $query .= "LIMIT 1";
              $result = mysqli_query($conn, $query);

              if ($result && mysqli_affected_rows($conn) == 1) {
                // Success
                $_SESSION["message"] = "Admin updated.";
              } else {
                $_SESSION["message"] = "Admin update failed.";
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
          <h2>Edit Admin: <?php echo htmlentities($admin["username"]); ?></h2>
          <div class="form-group">
            <form role="form" method="post" action="edit_admin.php?id=<?php echo urlencode($admin["id"]); ?>">
              <p>
                Username: <input class="form-control" type="text" name="username" value="<?php echo htmlentities($admin["username"]); ?>">
              </p>
              <p>
                Password: <input class="form-control" type="text" name="password" value="">
              </p>
              <input class="btn btn-default" type="submit" name="submit" value="Edit Admin">
            </form>
          </div>
          <br>
          <a href="manage_admins.php">Back</a>
        </div>
      </div>
    </div>
    <?php mysqli_close($conn); ?>
<?php include("../includes/layouts/footer.php");  ?>
