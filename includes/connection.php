<?php //step 1
 $connection=mysql_connect("localhost","root","");
//echo !$connection;
if(!$connection) {//this is to check if connection is established
  die("Database connection failed: ".mysql_error());
  //step 2
}
  $db_select=mysql_select_db("widget_corp",$connection);
  if(!$db_select) {//this is to check if selection of the database succeeded
    die("database selection failed: ".mysql_error());
  }
?>
