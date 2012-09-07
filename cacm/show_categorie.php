<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
  $idcategorie = $_GET['idcategorie'];
  $query = "SELECT * FROM categories WHERE id = '{$idcategorie}'";
	$result_list = mysql_query($query);
	confirm_query($result_list);
	$row_list = mysql_fetch_array($result_list);
?>
<?php include("../includes/header.php");?>

  
    <?php include('../includes/menu.php'); ?>
    	
      
      <div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
				<h3> Detail Categorie </h3>
				</div>
				<div class="clear"></div> <!-- End .clear -->
				<div class="content-box-content">
			   <p>
            <b>Libelle : </b><?php echo $row_list['libelle']; ?>
         </p>
			   
			   <h3>TODO Liste des produits</h3>
			  </div>
		</div>
			
			<div class="clear"></div> <!-- End .clear -->

<?php include('../includes/footer.php')?>

