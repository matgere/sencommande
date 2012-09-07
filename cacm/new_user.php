<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
	include_once("../includes/form_functions.php");
	$id = $_GET['idmembre'];
	$query = "SELECT code FROM membres WHERE id = '{$id}' ";
	$result_set = mysql_query($query);
	confirm_query($result_set);
	$row = mysql_fetch_array($result_set);
	$code = $row['code'];
	
	// START FORM PROCESSING
	if (isset($_POST['submit'])) { // Form has been submitted
	    $groupe = addslashes($_POST['groupe']);
	    $membre = addslashes($_POST['membre']);
	    $username = addslashes($_POST['username']);
	    $password = addslashes($_POST['password']);
	    
	    $sql = "SELECT id FROM membres WHERE code = '{$membre}'";
	    $res_sql = mysql_query($sql, $connection) or die("error: " . mysql_error());
	    $resultnum = mysql_fetch_array($res_sql);
	    $idmembre = $resultnum['id'];
	    
	    $query = "INSERT INTO users_membres (membre_id, username, hashed_password, groupe) 
			                  VALUES('$idmembre', '$username', '$password', '$groupe')";
	    
	    $result = mysql_query($query, $connection) or die("error: " . mysql_error());
	    
	    $iduser = mysql_insert_id();
			
			
	    if ($result){
			  
		   // redirect_to("show_produit.php?idproduit=$idproduit");
		   }
		}
?>
<?php include("../includes/header.php");?>
  
  <script type="text/javascript">
    function selectUser(choix){
      if(choix=='A'){
        document.form.membre.style.display = 'none';
        document.getElementById('group').style.display = 'none';
        }
      else if(choix=='M'){
        document.form.membre.style.display = 'block';
        document.getElementById('group').style.display = 'block';
        document.form.nom.style.display = 'none';
      } 
    }
  </script>
  
    <?php include('../includes/menu.php'); ?>
    	
      
      <div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
				<h3> Formulaire de saisie des utilisateurs </h3>
				</div>
				<div class="clear"></div> <!-- End .clear -->
				<div class="content-box-content">
			      
			      <form action="new_user.php" name="form" id="form" method="post" >
                      
                      <label for="group">Groupe :</label>
                      <select name="groupe">
                      <option value="M">Membre</option>
                      <option value="C">Client simple</option>
                      </select><br />
                      
                      <label for="id" id="group">ID:</label>
                      <input class="text-input small-input" type="text" name="membre" id="membre" autocomplete="off" value="<?php echo $code;?>" />
                      <br />
                      
                      <label for ="login">Login:</label>
                      <input class="text-input small-input" type="text" name="username" id="username" autocomplete="off"/>
                      <br />
                      
                      <label for ="password">Mot de passe :</label>
                      <input class="text-input small-input" type="password" name="password" id="password" autocomplete="off"/>
                      <br />   
              
                      
                   <br />
                  <input class="button" type="submit" name="submit" value="Valider">
                  <a href="#">
                    <input class="button" type="button" name="reset" value="Quitter sans enregistrer"></a>
                  </form>
                  
			  </div>
		</div>
			
			<div class="clear"></div> <!-- End .clear -->

<?php include('../includes/footer.php')?>

