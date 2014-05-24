<?php find_selected_page(true); ?>

<div class="col-sm-3">
  <ul class="subjects">
    <?php $subject_set = find_all_subjects(true); ?>
    <?php
      while ($subject = mysqli_fetch_assoc($subject_set)) {
    ?>
    <?php echo "<li";
          if ($subject["id"] == $selected_subject_id) {
            echo " class=\"selected\"";
          }
          echo ">";
    ?>
        <a href="index.php?subject=<?php echo urlencode($subject["id"]); ?>"><?php echo htmlentities($subject["menu_name"]); ?></a>
        <?php if ($subject["id"] == $selected_subject_id) { ?>
          <?php $page_set = find_pages_for_subject($subject["id"], true); ?>
          <ul class="pages">
            <?php
              while ($page = mysqli_fetch_assoc($page_set)) {
            ?>
                <?php echo "<li";
                      if ($page["id"] == $selected_page_id) {
                        echo " class=\"selected\"";
                      }
                      echo ">";
                ?>
                <a href="index.php?page=<?php echo urlencode($page["id"]); ?>"><?php echo htmlentities($page["menu_name"]); ?></a></li>
              <?php
                }
              ?>
              <?php mysqli_free_result($page_set); ?>
          </ul>

      <?php
        }
      ?>
        <? } ?>
      </li>
    <?php mysqli_free_result($subject_set); ?>

  </ul>
</div>
