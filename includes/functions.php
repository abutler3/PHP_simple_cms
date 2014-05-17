<?php
function redirect_to($new_location) {
  header("Location:" . $new_location);
  exit;
}

  function mysql_prep($string) {
    global $conn;
    $escaped_string = mysqli_real_escape_string($conn, $string);
    return $escaped_string;
  }

  function confirm_query($result_set) {
    if (!$result_set) {
      die("Database query failed.");
    }
  }

  function form_errors($errors=array()) {
    $output = "";
    if (!empty($errors)) {
      $output .= "<div class=\"error\">";
      $output .= "Please fix the following errors:";
      $output .= "<ul>";
      foreach ($errors as $key => $error) {
        $output .= "<li> htmlentities($error); </li>";
      }
      $output .= "</ul>";
      $output .= "</div>";
    }
    return $output;
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
    $safe_subject_id = mysqli_real_escape_string($conn, $subject_id);

    $query  = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "WHERE visible = 1 ";
    $query .= "AND subject_id = {$safe_subject_id} ";
    $query .= "ORDER BY position ASC";
    $page_set = mysqli_query($conn, $query);
    confirm_query($page_set);
    // confirm_query is in the functions.php file
    return $page_set;
  }

  function find_subject_by_id($subject_id) {
    global $conn;
    $safe_subject_id = mysqli_real_escape_string($conn, $subject_id);
    $query  = "SELECT * ";
    $query .= "FROM subjects ";
    $query .= "WHERE id = {$safe_subject_id} ";
    $query .= "LIMIT 1";
    $subject_set = mysqli_query($conn, $query);
    confirm_query($subject_set);
    if ($subject = mysqli_fetch_assoc($subject_set)) {
      return $subject;
    } else {
      return null;
    }
    // confirm_query is in the functions.php file
  }

  function find_page_by_id($page_id) {
    global $conn;
    $safe_page_id = mysqli_real_escape_string($conn, $page_id);
    $query  = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "WHERE id = {$safe_page_id} ";
    $query .= "LIMIT 1";
    $page_set = mysqli_query($conn, $query);
    confirm_query($page_set);
    if ($page = mysqli_fetch_assoc($page_set)) {
      return $page;
    } else {
      return null;
    }
    // confirm_query is in the functions.php file
  }

  function find_selected_page() {
    global $selected_subject_id;
    global $current_subject;
    global $selected_page_id;
    global $current_page;

    if (isset($_GET["subject"])) {
      $selected_subject_id = $_GET["subject"];
      $current_subject = find_subject_by_id($selected_subject_id);
      $selected_page_id = null;
      $current_page = null;
    } elseif (isset($_GET["page"])) {
      $selected_page_id = $_GET["page"];
      $current_page = find_page_by_id($selected_page_id);
      $selected_subject_id = null;
      $current_subject = null;
    } else {
      $selected_page_id = null;
      $selected_subject_id = null;
      $current_page = null;
      $current_subject = null;
    }
  }
