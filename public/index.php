<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php");  ?>
<?php require_once("../includes/db_connection.php");  ?>
<?php $layout_context = "public" ?>
<?php include("../includes/layouts/header.php");  ?>
<?php include("public_sidebar.php");  ?>


        <div class="col-sm-9 main">
          <?php if ($current_page) { ?>
            <h2><?php echo htmlentities($current_page["menu_name"]); ?>
</h2>
            <?php echo nl2br(htmlentities($current_page["content"])); ?>
          <?php } else {  ?>
            <p>Welcome!</p>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php mysqli_close($conn); ?>
<?php include("../includes/layouts/footer.php");  ?>
<?
