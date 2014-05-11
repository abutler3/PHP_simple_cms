
<?php require_once("../includes/functions.php");  ?>
<?php require_once("../includes/db_connection.php");  ?>
<?php include("../includes/layouts/header.php");  ?>

<?php include("../includes/layouts/sidebar.php");  ?>

        <div class="col-sm-9 main">
          <?php if ($current_subject) { ?>
            <h1 class="page-header">Manage Content</h1>

            <p>Menu name: <?php echo $current_subject["menu_name"]; ?></p>
          <?php } elseif ($current_page) { ?>
            <h1 class="page-header">Manage Page</h1>
            <p>Menu name: <?php echo $current_page["menu_name"]; ?></p>
          <?php } else {  ?>
            <p>Please select a subject or page.</p>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php mysqli_close($conn); ?>
<?php include("../includes/layouts/footer.php");  ?>
