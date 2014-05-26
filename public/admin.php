<?php require_once("../includes/session.php");  ?>
<?php require_once("../includes/functions.php");  ?>
<?php confirm_logged_in(); ?>
<?php $layout_context = "admin" ?>
<?php include("../includes/layouts/header.php");  ?>


        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Welcome to the Admin Area, <?php echo htmlentities($_SESSION["username"]); ?></h1>
          <ul>
            <li><a href="manage_content.php">Manage Website Content</a></li>
            <li><a href="manage_admins.php">Manage Admin Users</a></li>
          </ul>
        </div>
      </div>
    </div>
<?php include("../includes/layouts/footer.php");  ?>
