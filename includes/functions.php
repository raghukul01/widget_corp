<?php
  //this file is the place to store all the function
  function confirm_query($result_set)
  {
  if(!$result_set) {//this is to check if query is made correctly
    die("database result failed: ".mysql_error());
  }
  }
  function get_all_subjects() {
    global $connection;
    $query="SELECT *
     FROM subjects
     ORDER BY position ASC";//this is query variable, to order in increasing position
    $subject_set=mysql_query($query,$connection);
    confirm_query($subject_set);
    return $subject_set;
  }
  function get_pages_for_subjects($subject_id){
    global $connection;
    $query="SELECT *
      FROM pages
      WHERE subject_id={$subject_id}
      ORDER BY position ASC";
    $page_set=mysql_query($query,$connection);
    confirm_query($page_set);
    return $page_set;
}
  function get_subject_by_id($subject_id) {
    global $connection;
    $query="SELECT * ";
    $query.="FROM subjects ";//we break query like this so that we can comment out part to check errors
    $query.="WHERE id={$subject_id}";
    //this is just to be sure to provide extra sequrity
    $result_set=mysql_query($query);//query
    //if no rows are returned , fetch_array will return false
    confirm_query($result_set);
    if($subject=mysql_fetch_array($result_set)) {
                 //fetching data
    return $subject;
      }else return NULL;
    }
    function get_page_by_id($page_id){//this function also does the same thing but for pages
      global $connection;
      $query="SELECT * ";
      $query.="FROM pages ";//we break query like this so that we can comment out part to check errors
      $query.="WHERE id={$page_id}";
      //this is just to be sure to provide extra sequrity
      $result_set=mysql_query($query);//query
      //if no rows are returned , fetch_array will return false
      confirm_query($result_set);
      if($page=mysql_fetch_array($result_set)) {
                   //fetching data
      return $page;
        }else return NULL;
    }

  function find_selected_page() {
      global $sel_subj;//global declared so that they can be used outside in html
      global $sel_page;
      global $sel_page_content;
      global $sel_subject;
      if(isset($_GET['subj'])){//here we ase receving values sent over get and storing them in values
        $sel_subj=$_GET['subj'];
        $sel_page="";
        $sel_subject=get_subject_by_id($sel_subj);//it makes query and returns data
      }//first we are checking if variables are set if not we are assingning them null
      elseif(isset($_GET['page'])){
        $sel_subj="";
        $sel_page=$_GET['page'];
        $sel_page_content=get_page_by_id($sel_page);

      }
      else {
          $sel_subj="";
          $sel_page="";
      }
  }
  function navigation($sel_subj,$sel_page){
    $output= "<ul class=\"subjects\">";
     $subject_set=get_all_subjects();//this is a function in header which makes sql query and returns it
    while($subject=mysql_fetch_array($subject_set)){//this is to print the table of subject
      $output .= "<li";
      if($subject['id']==$sel_subj) {
        $output .= " class=\"selected\"";
    }
      $output .= "><a href=\"edit_subject.php?subj=".urlencode($subject['id']).
      "\">{$subject ['menu_name']}</a></li>";//we are using get and sending id of subject table on click
      //this part is to fetch data from pages table that is related to subject table
      $page_set=get_pages_for_subjects($subject["id"]);//this function makes sql query for each id

      $output .= "<ul class=\"pages\">";// two \\ are used to escape the double quotes
      while($page=mysql_fetch_array($page_set)){//this is to print the table
        $output .= "<li ";
        if($page['id']==$sel_page) {//this part of the code provides styling when a link is clicked
          $output .= " class=\"selected\"";//if page id and sel_page are same text will become bold
      }
        $output .= "><a href=\"content.php?page=".urlencode($page['id']).
        "\">{$page ['menu_name']}</a></li>";//print each item of pages table
      }//in the second link we send the page id via get
        $output .= "</ul>";
      }
  $output .= "</ul>";
  return $output;
  }
  function mysql_prep($value) {
    $magic_quote_active=get_magic_quotes_gpc();//it return boolean value if settings are turned.
    $new_enough_php=function_exists("mysql_real_escape_string");//if PHP version is higher enough
    if($new_enough_php) {//PHP v4.3 or higher
      if($magic_quote_active) {$value=stripcslashes($value);}//this un strips the string ie removes backslash and replace them by  actual quotes
      $value=mysql_real_escape_string($value);//
    }
    else {//if magic quote is not active then we add slashes manually
      if(!magic_quote_active) {$value=addslashes($value);}
    }
    return $value;
  }

  function redirect_to($location=NULL) {
    if($location!=NULL) {//this function simply redirects to some page
    header("Location:{$location}");
    exit;
    }
  }

 ?>
