<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
	include_once("../includes/form_functions.php");
	
	// START FORM PROCESSING
	if (isset($_POST['submit'])) { // Form has been submitted
	    $nom = addslashes($_POST['nom']);
	    $sigle = addslashes($_POST['sigle']);
	    $adresse = addslashes($_POST['adresse']);
	    $contact = addslashes($_POST['contact']);
	    $tel = addslashes($_POST['tel']);
	    $email = addslashes($_POST['email']);
	    $rc = addslashes($_POST['rc']);
	    $ninea = addslashes($_POST['ninea']);
	    
	    
	    $query = "INSERT INTO groupements (nom, enseigne, adresse, contact, tel_c, email_c, ninea, rc) 
			                  VALUES('$nom', '$sigle', '$adresse', '$contact', '$tel', '$email', '$ninea', '$rc' )";
	    
	    $result = mysql_query($query, $connection) or die("error: " . mysql_error());
	    
	    $idgroupement = mysql_insert_id();
			
			
	    if ($result){
			  
		    redirect_to("show_groupement.php?idgroupement=$idgroupement");
		   }
		}
?>
<?php include("../includes/header.php");?>

  
    <?php include('../includes/menu.php'); ?>
    	
      
      <div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
				<h3> Formulaire de saisie d'un groupement </h3>
				</div>
				<div class="clear"></div> <!-- End .clear -->
				<div class="content-box-content">
			      
			      <form action="new_groupement.php" name="form" id="form" method="post" >
                 
                      <label for ="nom">Groupement :</label>
                      <input type="text" class="text-input small-input" name="nom" id="nom" size="40" autocomplete="off"/><br />
                      
                      <label for ="nom">Sigle :</label>
                      <input type="text" class="text-input small-input" name="sigle" id="sigle" size="40" autocomplete="off"/><br />
                      
                      <label for ="nom">Adresse :</label>
                      <input type="text" class="text-input small-input" name="adresse" id="adresse" size="40" autocomplete="off"/><br />
                      
                      <label for ="nom">Contact :</label>
                      <input type="text" class="text-input small-input" name="contact" id="contact" size="40" autocomplete="off"/><br />
                      
                      <label for ="nom">Téléphone Contact :</label>
                      <input type="text" class="text-input small-input" name="tel" id="tel" size="40" autocomplete="off"/><br />
                      
                      <label for ="nom">Email Contact :</label>
                      <input type="text"  class="text-input small-input" name="email" id="email" size="40" autocomplete="off"/><br />
                      
                      <label for ="nom">RC :</label>
                      <input type="text" class="text-input small-input" name="rc" id="rc" size="40" autocomplete="off"/><br />
                      
                      <label for ="nom">NINEA :</label>
                      <input type="text" class="text-input small-input" name="ninea" id="ninea" size="40" autocomplete="off"/><br />
                     
              
                   <br />
                  <input class="button" type="submit" name="submit" value="Créer Groupement">
                  <a href="show_groupement.php?idgroupement=<?php echo $idgroupement;?>">
                    <input class="button" type="button" name="reset" value="Quitter sans enregistrer"></a>
                  </form>
                  
			  </div>
		</div>
			
			<div class="clear"></div> <!-- End .clear -->

<?php include('../includes/footer.php')?>

