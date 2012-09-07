<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
  function searchId(){
    $sqlnum = "SELECT count(id) as nb FROM produits;";
    $resnum = mysql_query($sqlnum);
    $resultnum = mysql_fetch_array($resnum);
    $nbrowt = mysql_num_rows($resnum);
    if($nbrowt > 0)
    $num = $resultnum['nb'] + 1;
    else
    $num = 1;
    if($num > 0 && $num < 999)
    $numero = "010" . $num;
    else
    $numero = "100" . $num;
  
  return $numero;
  }
?>
<?php
	include_once("../includes/form_functions.php");
	
	// START FORM PROCESSING
	if (isset($_POST['submit'])) { // Form has been submitted
	    $code_article = addslashes($_POST['code_article']);
	    $libelle = addslashes($_POST['libelle']);
	    $categorie = addslashes($_POST['categorie']);
	    $datemes = dateformat($_POST['datemes']);
	    $prix_achat = addslashes($_POST['prix-achat']);
	    $prix_vente = addslashes($_POST['prix-vente']);
	    $code_archive = addslashes($_POST['code-archive']);
	    $marge = addslashes($_POST['marge']);
	    $seuil = addslashes($_POST['seuil']);
	    $packaging = addslashes($_POST['packaging']);
	    $colissage = addslashes($_POST['colissage']);
	    $unite = addslashes($_POST['unite']);
	    
	    $query = "INSERT INTO produits (code_article, categorie_id, libelle, Date_mes, 
	                                    prix_achat, prix_vente, code_archive, 
	                                    marge, seuil, packaging, colissage, unite) 
			                  VALUES('$code_article', '$categorie', '$libelle', '$datemes', '$prix_achat', '$prix_vente', '$code_archive', '$marge', '$seuil', '$packaging', '$colissage', '$unite')";
	    
	    $result = mysql_query($query, $connection) or die("error: " . mysql_error());
	    
	    $idproduit = mysql_insert_id();
			
			
	    if ($result){
			  
		   // redirect_to("show_produit.php?idproduit=$idproduit");
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
				<h3> Formulaire de saisie des produits </h3>
				</div>
				<div class="clear"></div> <!-- End .clear -->
				<div class="content-box-content">
			      
			      <form action="new_produit.php" name="form" id="form" method="post" >
                 
                      <label for ="code">Code Article :</label>
                      <input class="text-input small-input" type="text" name="code-article" id="code-article" size="40" autocomplete="off" value="<?php echo searchId();?>" /><br />
                      
                      <label for ="nom">Libellé :</label>
                      <input class="text-input small-input" type="text" name="libelle" id="libelle" size="40" autocomplete="off"/><br />
                      
                      <label for ="nom">Catégorie :</label>
                      <select name="categorie">
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
                      
                      <label for ="nom">Date de mise en stock :</label>
                      <input class="text-input small-input" type="text" name="datemes" id="datemes" size="40" autocomplete="off"/><br />
                      
                      <label for ="nom">Prix d'achat :</label>
                      <input class="text-input small-input" type="text" name="prix-achat" id="prix-achat" size="40" autocomplete="off"/><br />
                      
                      <label for ="nom">Marge :</label>
                      <input class="text-input small-input" type="text" name="marge" id="marge" size="40" autocomplete="off"/><br />
                      
                      <label for ="nom">Prix de vente :</label>
                      <input class="text-input small-input" type="text" name="prix-vente" id="prix-vente" size="40" autocomplete="off" onfocus = "calcul();"/><br />
                      
                      <label for ="nom">Seuil :</label>
                      <input class="text-input little-input" type="text" name="seuil" id="seuil" size="40" autocomplete="off"/><br />
                      
                      <label for ="nom">Packaging :</label>
                      <input class="text-input little-input" type="text" name="packaging" id="packaging" size="40" autocomplete="off"/><br />
                      
                      <label for ="nom">Colissage :</label>
                      <input class="text-input little-input" type="text" name="colissage" id="colissage" size="40" autocomplete="off"/><br />     
                      
                      <label for ="unite">Unité de vente :</label>
                      <input class="text-input little-input" type="text" name="unite" id="unite" size="40" autocomplete="off"/><br />                    
              
                   <br />
                  <input class="button" type="submit" name="submit" value="Créer Produit">
                  <a href="show_produit.php?idproduit=<?php echo $idproduit;?>">
                    <input class="button" type="button" name="reset" value="Quitter sans enregistrer"></a>
                  </form>
                  
			  </div>
		</div>
			
			<div class="clear"></div> <!-- End .clear -->


      <script>
      $(function() {
		$( "#datemes" ).datepicker({ dateFormat: 'dd-mm-yy' });
		});
		</script>
<?php include('../includes/footer.php')?>

