<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>

<?php
  $_SESSION["admin_id"] = null;
  $_SESSION["username"] = null;
  redirect_to("login.php");
 ?>
