<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  define("DB_SERVER", "localhost");
  define("DB_USER", "root");
  define("DB_PASS", "root");
  define("DB_NAME", "widget_corp");

  $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  if(mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
  }
?>
