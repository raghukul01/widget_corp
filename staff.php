<?php include("includes/header.php") ?><!--this part is common to all the pages so we created a header-->
<?php require_once("includes/functions.php") ?>
      <table id="structure">
        <tr>
          <td id="navigation">
            &nbsp;
          </td>
          <td id="page">
            <h2>Staff Menu</h2>
            <p>Wlecome to the staff area.</p>
            <ul>
              <li><a href="content.php">Manage Website Content</a></li>
              <li><a href="new_user.php">Add Staff User</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </td>
        </tr>
      </table>
  <?php include("includes/footer.php") ?>
