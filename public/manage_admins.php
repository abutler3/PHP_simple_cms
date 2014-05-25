<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php");  ?>
<?php require_once("../includes/db_connection.php");  ?>
<?php $layout_context = "admin" ?>
<?php include("../includes/layouts/header.php");  ?>
<?php $admin_set = find_all_admins(); ?>

        <div class="col-sm-9 main">
          <?php echo message(); ?>

            <h1>Manage Users</h1>
              <table>
                <tr>
                  <th style="text-align: left; width: 200px;">Username</th>
                  <th colspan="2" style="text-align: left;">Actions</th>
                </tr>
                <?php while($admin = mysqli_fetch_assoc($admin_set)) { ?>
                  <tr>
                    <td><?php echo htmlentities($admin["username"]); ?></td>
                    <td><a href="edit_admin.php?id=<?php echo urlencode($admin["id"]); ?>">Edit</a></td>
                    <td><a href="delete_admin.php?id=<?php echo urlencode($admin["id"]); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
                  </tr>
                <?php } ?>
              </table>
              <br>
              <p><a href="new_admin.php">Add new admin</a></p>
        </div>
      </div>
    </div>
    <?php mysqli_close($conn); ?>
<?php include("../includes/layouts/footer.php");  ?>
