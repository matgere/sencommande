<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/form_functions.php"); ?>
<?php
  $idproduit = $_GET['idproduit'];
  $query = "SELECT code_article, categories.libelle as categorie, produits.libelle, Date_mes, 
	                 prix_achat, prix_vente, code_archive, 
	                 marge, seuil, packaging, colissage, unite 
	          FROM produits, categories WHERE 
	          categories.id = categorie_id AND produits.id = '{$idproduit}'";
	$result_list = mysql_query($query);
	confirm_query($result_list);
	$row_list = mysql_fetch_array($result_list);
?>
<?php include("../includes/header.php");?>
<script language="javascript" src="../javascripts/script_money.js"></script>
  
    <?php include('../includes/menu.php'); ?>
    	
      
      <div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
				<h3> Détail Produit </h3>
				</div>
				<div class="clear"></div> <!-- End .clear -->
				<div class="content-box-content">
			   <p>
            <b>Code Article : </b><?php echo $row_list['code_article']; ?>
         </p>
			   
			   <p>
            <b>Libelle : </b><?php echo $row_list['libelle']; ?>
         </p>
			   <p>
            <b>Categorie : </b><?php echo $row_list['categorie']; ?>
         </p>
			   <p>
            <b>Date de mise en Stock : </b><?php echo dateformat($row_list['Date_mes']); ?>
         </p>
			   <p>
            <b>Prix d'achat : </b><?php echo number_format($row_list['prix_achat'], 0, '.', ' ');?>
         </p>
			   <p>
            <b>Prix de vente : </b><?php echo number_format($row_list['prix_vente'], 0, '.', ' '); ?>
         </p>
			   <p>
            <b>Code Archive : </b><?php echo $row_list['code_archive']; ?>
         </p>
			   <p>
            <b>Marge : </b><?php echo $row_list['marge']; ?>
         </p>
			   <p>
            <b>Seuil : </b><?php echo $row_list['seuil']; ?>
         </p>
			   <p>
            <b>Packaging : </b><?php echo $row_list['packaging']; ?>
         </p>
			   <p>
            <b>Colissage : </b><?php echo $row_list['colissage']; ?>
         </p>
			   <p>
            <b>unite : </b><?php echo $row_list['unite']; ?>
         </p>
         <br /><br />
			    <h3>TODO Liste des commandes de ce mois</h3>
			  </div>
		</div>
			
			<div class="clear"></div> <!-- End .clear -->

<?php include('../includes/footer.php')?>

