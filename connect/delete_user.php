<?php session_start();?>
<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
   
    $id = $_GET['id'];
    if(intval($id) == 0){
      redirect_to("users.php");
    }
      $query_annul = "DELETE FROM users  WHERE id = '{$id}'";
      $result_annul = mysql_query($query_annul, $connection);
    if(mysql_affected_rows() == 1){
     redirect_to("users.php");
    }
?>
<?php mysql_close($connection); ?>
