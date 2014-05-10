
<?php require_once("../includes/functions.php");  ?>
<?php require_once("../includes/db_connection.php");  ?>
<?php include("../includes/layouts/header.php");  ?>

<?php include("../includes/layouts/sidebar.php");  ?>

        <div class="col-sm-9 main">
          <h1 class="page-header">Manage Content</h1>
          <?php echo $selected_subject_id; ?><br>
          <?php echo $selected_page_id; ?>
        </div>
      </div>
    </div>
    <?php mysqli_close($conn); ?>
<?php include("../includes/layouts/footer.php");  ?>
