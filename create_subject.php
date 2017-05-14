<!--this page is for creating new subject-->
<?php require_once("includes/functions.php"); ?>
<?php include("includes/connection.php");
 ?>

<?php
    $menu_name=mysql_prep($_POST['menu_name']);
    $position=mysql_prep($_POST['position']);
    $visible=mysql_prep($_POST['visible']);
 ?>
 <?php
  //form validation
  $errors=array();
    $required_feilds=array('menu_name','position','visible');
    foreach ($required_feilds as $fieldname) {
      if(!isset($_POST[$fieldname])||empty($_POST[$fieldname]))
      $errors[]=$fieldname;//this loop checks if the variables are empty or they are not set, in that case it redirects it to previous page

    }
    $fields_with_lengths=array('menu_name'=>30);
    foreach ($fields_with_lengths as $fieldname => $maxlength) {
      if(strlen(trim(mysql_prep($_POST[$fieldname])))>$maxlength) {
        $errors[]=$fieldname;//to check if size is greater than 30
      }//trim function removes whitespace
    }

    if(!empty($errors)) {
      redirect_to("new_subject.php");
    }
  ?>

<?php
    $query="INSERT INTO subjects (
      menu_name,position,visible
    ) VALUES (
      '{$menu_name}',{$position},{$visible}
    )";//string must have single quoetes around them=>in menu name
    //magic_quotes_gpc allows to add slashes in get post and cookie request on its own

    if(mysql_query($query,$connection)) {
      //success
       redirect_to("content.php");//this will redirect to content.php
      exit;
    }
    else {
      //dispaly error message
      echo "<p>Subject creation failed.</p>";
      echo "<p>".mysql_error()."lol</p>";
    }
 ?>
<?php mysql_close($connection); ?>
<?php include("includes/footer.php"); ?>
