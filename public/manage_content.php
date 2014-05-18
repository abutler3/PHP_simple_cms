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

            <div class="pages-section">
              <h3>Pages in this subject</h3>
                <ul>
                  <?php
                    $subject_pages = find_pages_for_subject($current_subject["id"]);
                    while($page = mysqli_fetch_assoc($subject_pages)) {
                      echo "<li>";
                      $safe_page_id = urlencode($page["id"]);
                      echo "<a href=\"manage_content.php?page={$safe_page_id}\">";
                      echo htmlentities($page["menu_name"]);
                      echo "</a>";
                      echo "</li>";
                    }
                  ?>
                </ul>
                <br>
                <p>+<a href="new_page.php?subject=<?php echo urlencode($current_subject["id"]); ?>">Add a new page to this subject</a></p>
            </div>
          <?php } elseif ($current_page) { ?>
            <h1 class="page-header">Manage Page</h1>
            <p>Menu name: <?php echo htmlentities($current_page["menu_name"]); ?></p>
            <p>Position: <?php echo $current_page["position"]; ?></p>
            <p>Visible: <?php echo $current_page["visible"] == 1 ? 'yes' : 'no'; ?></p>
            <p>Content:</p>
            <div class="view-content">
              <?php echo htmlentities($current_page["content"]); ?>
            </div>
            <br>
            <br>
            <p><a href="edit_page.php?page=<?php echo urlencode($current_page['id']); ?>">Edit page</a></p>
          <?php } else {  ?>
            <p>Please select a subject or page.</p>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php mysqli_close($conn); ?>
<?php include("../includes/layouts/footer.php");  ?>
