<?php
session_start();
include_once("fonctions-panier.php");

$erreur = false;

$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
if($action !== null)
{
   if(!in_array($action,array('ajout', 'suppression', 'refresh')))
   $erreur=true;

   //récuperation des variables en POST ou GET
   $l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
   $p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
   $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;

   //Suppression des espaces verticaux
   $l = preg_replace('#\v#', '',$l);
   //On verifie que $p soit un float
   $p = floatval($p);

   //On traite $q qui peut etre un entier simple ou un tableau d'entier
    
   if (is_array($q)){
      $QteArticle = array();
      $i=0;
      foreach ($q as $contenu){
         $QteArticle[$i++] = intval($contenu);
      }
   }
   else
   $q = intval($q);
    
}

if (!$erreur){
   switch($action){
      Case "ajout":
         ajouterArticle($l,$q,$p);
         break;

      Case "suppression":
         supprimerArticle($l);
         break;

      Case "refresh" :
         for ($i = 0 ; $i < count($QteArticle) ; $i++)
         {
            modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i],round($QteArticle[$i]));
         }
         break;

      Default:
         break;
   }
}
?>
<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
$query = "SELECT produits.id as idproduit, produits.libelle as produit, prix_vente
	         FROM produits";
	$result_list = mysql_query($query);
	confirm_query($result_list);
	$row_list = mysql_fetch_array($result_list);
 ?>
<?php include("../includes/header.php");?>

 
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.1.min.js"></script>
	<script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
	
	 
    <?php include('../includes/menu.php'); ?>
    	
  
				<div class="column-box column-left">
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
                      <input type="text" class="text-input small-input" name="q" id="q" />
              </form>
                     <br />
                     
                   <div id="results"></div>
             
			    </div>
			 </div>
			 
			 
				<div class="column-box column-right">
				  <div class="content-box-header">
				  <h3> Detail commande </h3>
				  </div>
				  <div class="clear"></div> <!-- End .clear -->
				  <div class="content-box-content">
			        <table>
			<thead>
				<tr>
					<th field="name" width=140>Libelle</th>
					<th field="quantity" width=60 align="right">Quantite</th>
					<th field="price" width=60 align="right">Prix</th>
				</tr>
			</thead>
			<?php
	if (creationPanier())
	{
	   $nbArticles=count($_SESSION['panier']['libelleProduit']);
	   if ($nbArticles <= 0)
	   echo "<tr><td>Votre panier est vide </ td></tr>";
	   else
	   {
	      for ($i=0 ;$i < $nbArticles ; $i++)
	      {
	         echo "<tr>";
	         echo "<td>".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."</ td>";
	         echo "<td><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."\"/></td>";
	         echo "<td>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])."</td>";
	         echo "<td><a href=\"".htmlspecialchars("panier.php?action=suppression&l=".rawurlencode($_SESSION['panier']['libelleProduit'][$i]))."\">XX</a></td>";
	         echo "</tr>";
	      }

	      echo "<tr><td colspan=\"2\"> </td>";
	      echo "<td colspan=\"2\">";
	      echo "Total : ".MontantGlobal();
	      echo "</td></tr>";

	      echo "<tr><td colspan=\"4\">";
	      echo "<input type=\"submit\" value=\"Rafraichir\"/>";
	      echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";

	      echo "</td></tr>";
	   }
	}
	?>
</table>
				      </div>
			    </div>
			
			<div class="clear"></div> <!-- End .clear -->


  <script>
      $(document).ready( function() {
  // détection de la saisie dans le champ de recherche
  $('#q').keyup( function(){
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

    <script>
      $(document).ready( function() {
  // détection de la saisie dans le champ de recherche
  $('#categorie').change( function(){
    $field = $(this);
    $('#results').html(''); // on vide les resultats
    $('#ajax-loader').remove(); // on retire le loader
 
    // on commence à traiter à partir du 2ème caractère saisie
    
      // on envoie la valeur recherché en GET au fichier de traitement
      $.ajax({
  	type : 'GET', // envoi des données en GET ou POST
	url : 'ajax-search.php' , // url du fichier de traitement
	data : 'categorie='+$(this).val() , // données à envoyer en  GET ou POST

	success : function(data){
		$('#results').html(data);
	}
      });
  });
  
});
   </script>
   
<?php include('../includes/footer.php')?>

