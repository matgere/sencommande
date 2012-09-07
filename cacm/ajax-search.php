<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/form_functions.php"); ?>
<?php

$cat = $_GET['categorie'];
$lib = $_GET['q'];

   if(isset($cat) || (isset($lib))) {
    $query = 'SELECT produits.id as idproduit, libelle, prix_vente
	             FROM produits
               WHERE categorie_id = \'' . safe( $cat ) . '%\' 
               AND libelle LIKE \'' . safe( $lib ) . '%\' ';
    } 
#  else if(isset($_GET['q'])) {
#    $query = 'SELECT produits.id as idproduit, libelle, prix_vente
#	             FROM produits
#               WHERE libelle LIKE \'' . safe( $_GET['q'] ) . '%\' ';
#    }
#  else if(isset($_GET['categorie'])) {
#    $query = 'SELECT produits.id as idproduit, libelle, prix_vente
#	             FROM produits
#               WHERE categorie_id = \'' . safe( $_GET['categorie'] ) . '%\' ';
#    } 
   
  $result_set = mysql_query($query, $connection);
  confirm_query($result_set);
  $row_list = mysql_fetch_array($result_set);
  $row_count = mysql_num_rows($result_set);
  
  if( mysql_num_rows( $result_set ) == 0 )
{
?>
    <h3 style="text-align:center; margin:10px 0;">Pas de r&eacute;sultats pour cette recherche</h3>
<?php
}
else {
  ?>
  
	      <?php do {?>
      <form method="post" action="" class="jcart">
					<fieldset>
						<input type="hidden" name="jcartToken" value="<?php echo $_SESSION['jcartToken'];?>" />
						<input type="hidden" name="my-item-id" value="<?php echo $row_list['idproduit'];?>" />
						<input type="hidden" name="my-item-name" value="<?php echo $row_list['libelle'];?>" />
						<input type="hidden" name="my-item-price" value="<?php echo $row_list['prix_vente'];?>" />
						<input type="hidden" name="my-item-url" value="http://bing.com" />

						<ul>
							<li><strong><?php echo $row_list['libelle'];?></strong></li>
							<li>Prix: <?php echo $row_list['prix_vente'];?></li>
							<li>
								<label>Qté: <input type="text" name="my-item-qty" value="1" size="3" /></label>
							</li>
						</ul>
						<input type="submit" name="my-add-button" value="Ajouter" class="button" />
					</fieldset>
				</form>
	      <?php } while($row_list = mysql_fetch_array($result_set));?>
  <?php } ?>
  
  
  
<?php
  function safe($var)
{
	$var = mysql_real_escape_string($var);
	$var = addcslashes($var, '%_');
	$var = trim($var);
	$var = htmlspecialchars($var);
	return $var;
}
?>



<?php
/**
*
    @author Matar GUEYE Afrisystems 2011
    Version 1.0.0
*
*/
?>
