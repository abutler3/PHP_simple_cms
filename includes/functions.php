<?php

  function confirm_query($result_set) {
    if (!$result_set) {
      die("Database query failed.");
    }
  }

  function find_all_subjects() {
    global $conn;
    $query  = "SELECT * ";
    $query .= "FROM subjects ";
    $query .= "WHERE visible = 1 ";
    $query .= "ORDER BY position ASC";
    $subject_set = mysqli_query($conn, $query);
    confirm_query($subject_set);
    // confirm_query is in the functions.php file
    return $subject_set;
  }

  function find_pages_for_subject($subject_id) {
    global $conn;
    $query  = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "WHERE visible = 1 ";
    $query .= "AND subject_id = {$subject_id} ";
    $query .= "ORDER BY position ASC";
    $page_set = mysqli_query($conn, $query);
    confirm_query($page_set);
    // confirm_query is in the functions.php file
    return $page_set;
  }
?>