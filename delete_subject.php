<?php require_once("includes/functions.php"); ?>
<?php include("includes/connection.php");
 ?>
<?php
    if(intval($_GET['subj'])==0){//if this does not have a integer value than page is redirected to content
      redirect_to("content.php");
    }
    $id=mysql_prep($_GET['subj']);
    if($subject=get_subject_by_id($id)) {

    $query="DELETE FROM subjects WHERE id={$id}";
    $result=mysql_query($query,$connection);
    if(mysql_affected_rows()==1){//success, redirected to content
      redirect_to("content.php");
    }
    else {
      echo "<p> Subject deletion failed.</p>";
      echo "<p>".mysql_error()."</p>";//error display
      echo "<a href=\"content.php\">Return to Main page";
    }
  } else {
    //subject didn't exist in database
    redirect_to("content.php");
  }
 ?>
 <?php mysql_close($connection); ?>
