<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
	include_once("../includes/form_functions.php");
	$idproduit = $_GET['idproduit'];
	
	$query = "SELECT produits.id as idproduit, code_article, categories.id as idcategorie, categories.libelle as categorie, 
                 produits.libelle as produit, Date_mes, prix_achat,
	               prix_vente, code_archive, 
	               marge, seuil, packaging, colissage, unite 
	         FROM produits, categories 
	         WHERE categories.id = categorie_id 
	         AND produits.id ='{$idproduit}'";
	$result_list = mysql_query($query);
	confirm_query($result_list);
	$row_list = mysql_fetch_array($result_list);
	
	// START FORM PROCESSING
	if (isset($_POST['submit'])) { // Form has been submitted
	    $code_article = addslashes($_POST['code-article']);
	    $libelle = addslashes($_POST['libelle']);
	    $categorie = addslashes($_POST['categorie']);
	    $datemes = addslashes($_POST['datemes']);
	    $prix_achat = addslashes($_POST['prix-achat']);
	    $prix_vente = addslashes($_POST['prix-vente']);
	    $code_archive = addslashes($_POST['code-archive']);
	    $marge = addslashes($_POST['marge']);
	    $seuil = addslashes($_POST['seuil']);
	    $packaging = addslashes($_POST['packaging']);
	    $colissage = addslashes($_POST['colissage']);
	    $unite = addslashes($_POST['unite']);
	    
	    $query = "UPDATE produits 
	              SET code_article = '$code_article', categorie_id = '$categorie', libelle ='$libelle', 
	              Date_mes ='$datemes', prix_achat = '$prix_achat', prix_vente = '$prix_vente', 
	              code_archive = '$code_archive',  marge = '$marge', seuil = '$seuil', 
	              packaging = '$packaging', colissage = '$colissage', unite = '$unite' 
	              WHERE produits.id = '{$idproduit}'";
	    
	    $result = mysql_query($query, $connection) or die("error: " . mysql_error());
			
	    if ($result){
			  
		   redirect_to("show_produit.php?idproduit=$idproduit");
		   }
		}
?>
<?php include("../includes/header.php");?>

  
    <?php include('../includes/menu.php'); ?>
    	
  <script type="text/javascript">
    function calcul(){
    var prixachat = document.getElementById('prix-achat').value;
    var marge = document.getElementById('marge').value;
    
    if((prixachat !='') && (prixvente !='')){
   var prixvente = parseInt(prixachat) + (parseInt(prixachat) * marge);
   document.getElementById('prix-vente').value = prixvente;
        
      }
    }
    </script>
      
      <div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
				<h3> Modification d'un produit </h3>
				</div>
				<div class="clear"></div> <!-- End .clear -->
				<div class="content-box-content">
			      
			      <form action="edit_produit.php?idproduit=<?php echo $idproduit;?>" name="form" id="form" method="post" >
                 
                      <label for ="code">Code Article :</label>
                      <input class="text-input small-input" type="text" name="code-article" id="code-article" size="40" autocomplete="off" value="<?php echo $row_list['code_article'];?>" /><br />
                      
                      <label for ="libelle">Libellé :</label>
                      <input class="text-input small-input" type="text" name="libelle" id="libelle" size="40" autocomplete="off" value="<?php echo $row_list['produit'];?>" /><br />
                      
                      <label for ="categorie">Catégorie :</label>
                      <select name="categorie">
                        <option value="<?php echo $row_list['idcategorie'];?>"><?php echo $row_list['categorie'];?></option>
                        <?php
                         $query_cat = "SELECT * FROM categories";
                         $result_cat = mysql_query($query_cat) or die("error: " . mysql_error());;
                         confirm_query($result_cat);
                         $row_cat = mysql_fetch_array($result_cat);
                        ?>
                        <?php do { ?>
                        <option value="<?php echo $row_cat['id'];?>"><?php echo $row_cat['libelle'];?></option>
                        <?php } while($row_cat = mysql_fetch_array($result_cat));?>
                      </select>
                      
                      <label for ="nom">Date de mise en stock :</label>
                      <input class="text-input small-input" type="text" name="datemes" id="datemes" size="40" autocomplete="off" value="<?php echo $row_list['Date_mes'];?>" /><br />
                      
                      <label for ="nom">Prix d'achat :</label>
                      <input class="text-input small-input" type="text" name="prix-achat" id="prix-achat" size="40" autocomplete="off" value="<?php echo $row_list['prix_achat'];?>"/><br />
                      
                      <label for ="nom">Marge :</label>
                      <input class="text-input small-input" type="text" name="marge" id="marge" size="40" autocomplete="off" value="<?php echo $row_list['marge'];?>"/><br />
                      
                      <label for ="nom">Prix de vente :</label>
                      <input class="text-input small-input" type="text" name="prix-vente" id="prix-vente" size="40" autocomplete="off" value="<?php echo $row_list['prix_vente'];?>" onfocus = "calcul();" /><br />
                      
                      <label for ="nom">Seuil :</label>
                      <input class="text-input small-input" type="text" name="seuil" id="seuil" size="40" autocomplete="off" value="<?php echo $row_list['seuil'];?>"/><br />
                      
                      <label for ="nom">Packaging :</label>
                      <input class="text-input small-input" type="text" name="packaging" id="packaging" size="40" autocomplete="off" value="<?php echo $row_list['packaging'];?>"/><br />
                      
                      <label for ="nom">Colissage :</label>
                      <input class="text-input small-input" type="text" name="colissage" id="colissage" size="40" autocomplete="off" value="<?php echo $row_list['colissage'];?>"/><br />     
                      
                      <label for ="unite">Unité de vente :</label>
                      <input class="text-input small-input" type="text" name="unite" id="unite" size="40" autocomplete="off" value="<?php echo $row_list['unite'];?>"/><br />   
                      
                      <label for ="unite">Code Archive :</label>
                      <select name="code-archive">
                        <option value="O">Oui</option>
                        <option value="N" selected>Non</option>
                      </select>
                      <br />                          
              
                   <br />
                  <input class="button" type="submit" name="submit" value="Modifier Produit">
                  <a href="show_produit.php?idproduit=<?php echo $idproduit;?>">
                    <input class="button" type="button" name="reset" value="Quitter sans enregistrer"></a>
                  </form>
                  
			  </div>
		</div>
			
			<div class="clear"></div> <!-- End .clear -->

<?php include('../includes/footer.php')?>

