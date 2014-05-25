<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php
  $admin = find_admin_by_id($_GET["id"]);
  if (!$admin) {
    redirect_to("manage_admins.php");
  }


  $id = $admin["id"];
  $query = "DELETE FROM admins WHERE id = {$id} LIMIT 1";
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_affected_rows($conn) == 1) {
    // Success
    $_SESSION["message"] = "Subject deleted.";
    redirect_to("manage_admins.php");
  } else {
    $_SESSION["message"] = "Subject deletion failed.";
    redirect_to("manage_admins.php");
    // die("Database query failed. " . mysqli_error($connection));
  }
?>
