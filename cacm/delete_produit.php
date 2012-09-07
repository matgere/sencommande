<?php session_start();?>
<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
   
    $idproduit = $_GET['idproduit'];
    if(intval($idproduit) == 0){
      redirect_to("produits.php");
    }
      $query_del = "DELETE FROM produits  WHERE id = '{$idproduit}'";
      $result_del = mysql_query($query_del, $connection);
    if(mysql_affected_rows() == 1){
     redirect_to("produits.php");
    }
?>
<?php mysql_close($connection); ?>
