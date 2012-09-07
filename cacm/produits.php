<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
$query = "SELECT produits.id as idproduit, code_article, categories.libelle as categorie, 
                 produits.libelle as produit, Date_mes, 
	               prix_vente, code_archive, 
	               marge, seuil, packaging, colissage, unite 
	         FROM produits, categories WHERE 
	              categories.id = categorie_id";
	$result_list = mysql_query($query);
	confirm_query($result_list);
	$row_list = mysql_fetch_array($result_list);
?>
<?php include("../includes/header.php");?>

  
    <?php include('../includes/menu.php'); ?>
    	
      
      <div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
				<h3> Liste des Produits </h3>
				</div>
				<div class="clear"></div> <!-- End .clear -->
				<div class="content-box-content">
			      <form action="#" method="POST" name="form">
			          <span class="search_label">Categorie :</span>
                      <select name="categorie" id="categorie">
                        <?php
                         $query_cat = "SELECT * FROM categories";
                         $result_cat = mysql_query($query_cat) or die("error: " . mysql_error());;
                         confirm_query($result_cat);
                         $row_cat = mysql_fetch_array($result_cat);
                        ?>
                        <option value="">Selectionnez</option>
                        <?php do { ?>
                        <option value="<?php echo $row_cat['id'];?>"><?php echo $row_cat['libelle'];?></option>
                        <?php } while($row_cat = mysql_fetch_array($result_cat));?>
                      </select>
                      <span class="search_label">Produit :</span>
                      <input type="text" class="text-input little-input" name="q" id="q" />
              </form>
			      <hr>
			       <table>
				    <thead>
				      <tr>
				        <th>Catégorie</th>
				        <th>Article</th>
				        <th>Prix de vente</th>
				        <th>Unité</th>
				        <th></th>
				      </tr>
				      <?php do {?>
				      <tr>
				        <td><?php echo $row_list['categorie'];?></td>
				        <td><?php echo $row_list['produit'];?></td>
				        <td><?php echo $row_list['prix_vente'];?></td>
				        <td><?php echo $row_list['unite'];?></td>
				        <?php if($_SESSION['groupe'] == 'A') {?>
				        <td>
				        <a href="show_produit.php?idproduit=<?php echo $row_list['idproduit'];?>">
				          <img src="../images/detail.png" title="afficher les details" alt="afficher les details"/>
				        </a> 
				        <a href="edit_produit.php?idproduit=<?php echo $row_list['idproduit'];?>">
				          <img src="../images/edit.png" title="Modifier" alt="Modifier"/>
				        </a> 
				        <a href="delete_produit.php?idproduit=<?php echo $row_list['idproduit'];?>"  onclick="return confirm('Etes vous sûr de vouloir supprimer cet enregistrement')">
				          <img src="../images/delete.png" title="Supprimer" alt="Supprimer"/>
				        </a> 
				        </td>
				        <?php }?>
				      </tr>
				      <?php } while($row_list = mysql_fetch_array($result_list));?>
				    </thead>
				    
				    </table>
			  </div>
		</div>
			
			<div class="clear"></div> <!-- End .clear -->

<?php include('../includes/footer.php')?>

