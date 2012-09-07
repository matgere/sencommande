<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
	include_once("../includes/form_functions.php");
	
	// START FORM PROCESSING
	if (isset($_POST['submit'])) { // Form has been submitted
	    $libelle = addslashes($_POST['libelle']);
	    
	    
	    $query = "INSERT INTO categories (libelle) 
			                  VALUES('$libelle')";
	    
	    $result = mysql_query($query, $connection) or die("error: " . mysql_error());
	    
	    $idcategorie = mysql_insert_id();
			
			
	    if ($result){
			  // message
		    
		   }
		}
?>
<?php include("../includes/header.php");?>

  
    <?php include('../includes/menu.php'); ?>
    	
      
      <div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
				<h3> Formulaire de saisie des categories </h3>
				</div>
				<div class="clear"></div> <!-- End .clear -->
				<div class="content-box-content">
			      
			      <form action="new_categorie.php" name="form" id="form" method="post" >
                 
                      <label for ="nom">Libelle :</label>
                      <input type="text" name="libelle" id="libelle" size="40" autocomplete="off"/><br />
                     
              
                   <br />
                  <input type="submit" name="submit" value="Créer Categorie">
                  <a href="show_categorie.php?idcategorie=<?php echo $idcategorie;?>">
                    <input type="button" name="reset" value="Quitter sans enregistrer"></a>
                  </form>
                  
			  </div>
		</div>
			
			<div class="clear"></div> <!-- End .clear -->

<?php include('../includes/footer.php')?>

