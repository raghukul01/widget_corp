<?php require_once("includes/functions.php"); ?>
<?php include("includes/connection.php");
 ?>
<?php find_selected_page();?>
<?php include("includes/header.php"); ?><!--this will include the header-->


      <table id="structure">
        <tr>
          <td id="navigation">
            <?php echo navigation($sel_subj,$sel_page); ?>

           </ul>
         </br>
         <a href="new_subject.php">+Add a new subject</a>
          </td>
          <td id="page">
            <h2><?php if(isset($sel_subject)) echo $sel_subject['menu_name']; ?><!--this part of php prints menu_name-->
                <?php if(isset($sel_page_content)) echo $sel_page_content['menu_name']; ?><!--we check if value is set so as to prevent error-->
            </h2>
            </br><!--this is to check if get is working or not-->
            <div class="page-content">
            <?php if(isset($sel_page_content)) echo $sel_page_content['content']; ?>
          </div>
          </td>
        </tr>
      </table>
  <?php include("includes/footer.php"); ?>
  <?php
  mysql_close($connection);
   ?>
