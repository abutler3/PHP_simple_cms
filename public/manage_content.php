<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php");  ?>
<?php require_once("../includes/db_connection.php");  ?>
<?php include("../includes/layouts/header.php");  ?>
<?php include("../includes/layouts/sidebar.php");  ?>

        <div class="col-sm-9 main">
          <?php echo message(); ?>
          <?php if ($current_subject) { ?>
            <h1 class="page-header">Manage Content</h1>

            <p>Menu name: <?php echo htmlentities($current_subject["menu_name"]); ?></p>
            <p>Position: <?php echo $current_subject["position"]; ?></p>
            <p>Visible: <?php echo $current_subject["visible"] == 1 ? 'yes' : 'no'; ?></p>
            <a href="edit_subject.php?subject=<?php echo urlencode($current_subject["id"]); ?>">Edit Subject</a>
          <?php } elseif ($current_page) { ?>
            <h1 class="page-header">Manage Page</h1>
            <p>Menu name: <?php echo htmlentities($current_page["menu_name"]); ?></p>
            <p>Position: <?php echo $current_page["position"]; ?></p>
            <p>Visible: <?php echo $current_page["visible"] == 1 ? 'yes' : 'no'; ?></p>
            <p>Content:</p>
            <div class="view-content">
              <?php echo htmlentities($current_page["content"]); ?>
            </div>
          <?php } else {  ?>
            <p>Please select a subject or page.</p>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php mysqli_close($conn); ?>
<?php include("../includes/layouts/footer.php");  ?>
