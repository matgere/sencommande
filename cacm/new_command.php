<?php
include_once('jcart/jcart.php');

session_start();
?>
<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
$query = "SELECT produits.id as idproduit, produits.libelle as produit, prix_vente
	         FROM produits
	         WHERE code_archive = 'N'";
	$result_list = mysql_query($query);
	confirm_query($result_list);
	$row_list = mysql_fetch_array($result_list);
 ?>
<?php include("../includes/header.php");?>
    
		<link rel="stylesheet"  href="jcart/css/style.css" />
		<link rel="stylesheet"  href="jcart/css/jcart.css" />
		<script type="text/javascript" src="jcart/js/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="jcart/js/jcart.min.js"></script>
	
	 
    <?php include('../includes/menu.php'); ?>
    	
  
				<div class="column-box column-left">
				  <div class="content-box-header">
				  <h3> Liste des Produits </h3>
				  </div>
				  <div class="clear"></div> <!-- End .clear -->
				  <div class="content-box-content">
			       <form action="" method="POST" name="form">
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
                      <input type="text" class="text-input small-input" name="q" id="q" />
              </form>
                     <br />

                   <!--<div id="results"></div>
                   -->
      <table>
      <?php do {?>      
      <form method="post" action="" class="jcart">
					<fieldset>
						<input type="hidden" name="jcartToken" value="<?php echo $_SESSION['jcartToken'];?>" />
						<input type="hidden" name="my-item-id" value="<?php echo $row_list['idproduit'];?>" />
						<input type="hidden" name="my-item-name" value="<?php echo $row_list['produit'];?>" />
						<input type="hidden" name="my-item-price" value="<?php echo $row_list['prix_vente'];?>" />
						<input type="hidden" name="my-item-url" value="http://bing.com" />

						<tr>
							<td><strong><?php echo $row_list['produit'];?></strong></td>
							<td><?php echo $row_list['prix_vente'];?></td>
							<td><input type="text" name="my-item-qty" value="1" size="3" /></td>
						<td><input type="submit" name="my-add-button" value="Ajouter" class="button tip" /></td>
				    </tr>
					</fieldset>
				</form>
	      <?php } while($row_list = mysql_fetch_array($result_list));?>
	      </table>
			    </div>
			 </div>
			 
			 
				<div class="column-box column-right">
				  <div class="content-box-header">
				  <h3> Detail commande </h3>
				  </div>
				  <div class="clear"></div> <!-- End .clear -->
				  <div class="content-box-content">
			         <div id="jcart"><?php $jcart->display_cart();?></div>
			     
				      </div>
			    </div>
			
			<div class="clear"></div> <!-- End .clear -->


  <script>
      $(document).ready( function() {
  // détection de la saisie dans le champ de recherche
  $('#q, #categorie').keyup( function(){
    $field = $(this);
    $('#results').html(''); // on vide les resultats
    $('#ajax-loader').remove(); // on retire le loader
 
    // on commence à traiter à partir du 2ème caractère saisie
    if( $field.val().length > 0 )
    {
      // on envoie la valeur recherché en GET au fichier de traitement
      $.ajax({
  	type : 'GET', // envoi des données en GET ou POST
	url : 'ajax-search.php' , // url du fichier de traitement
	data : 'q='+$(this).val() , // données à envoyer en  GET ou POST
	beforeSend : function() { // traitements JS à faire AVANT l'envoi
		$field.after('<img src="../images/ajax-loader.gif" alt="loader" id="ajax-loader" />'); 
	},
	success : function(data){
		$('#ajax-loader').remove();
		$('#results').html(data);
	}
      });
    }		
  });
  
});
      
	</script>

   
<?php include('../includes/footer.php')?>

