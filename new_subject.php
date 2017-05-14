  <?php require_once("includes/functions.php"); ?>
  <?php include("includes/connection.php");
   ?>
  <?php
      find_selected_page();//this is to find the data from DB.
      //values in the function are declared global so they can be used inside html
   ?>
  <?php include("includes/header.php"); ?><!--this will include the header-->


        <table id="structure">
          <tr>
            <td id="navigation">
              <?php echo navigation($sel_subj,$sel_page); ?>
            </td>
            <td id="page">
              <h2>Add Subject</h2>
              <form action="create_subject.php" method="POST"><!--this is a form to take data from staff via POST-->
                <p>Subject name:
                  <input type="text" name="menu_name" value="" id="menu_name"/>
                </p>
                <p>Position:
                  <select name="position">
                    <?php
                        $subject_set=get_all_subjects();
                        $subject_count=mysql_num_rows($subject_set);//this function returns the number of all the element in subject_set
                        for($count=1;$count<=$subject_count+1;$count++)
                        {//subject_count+1 because we are adding a new subject
                          echo "<option value=\"{$count}\">{$count}</option>";
                        }
                     ?>
                  </select>
                </p>
                <p>Visible:
                  <input type="radio" name="visible" value="0"/>No
                  &nbsp;
                  <input type="radio" name="visible" value="1"/>Yes
                </p>
                <input type="submit" value="Add Subject"/>
              </form>
            </br>
            <a href="content.php">Cancel</a>
            </td>
          </tr>
        </table>
    <?php include("includes/footer.php"); ?>
    <?php
    mysql_close($connection);
     ?>
