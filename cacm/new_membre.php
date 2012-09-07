<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>
 <?php
$jour=array("01","02","03","04","05","06","07","08","09","10","11","12",
            "13","14","15","16","17","18","19","20","21","22","23","24","25",
            "26","27","28","29","30","31");
$mois=array("01","02","03","04","05","06","07","08","09","10","11","12");
?> 
<?php
  function searchId(){
    $sqlnum = "SELECT count(id) as nb FROM membres;";
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
	    $code = addslashes($_POST['code']);
	    $nom = addslashes($_POST['nom']);
	    $genre = addslashes($_POST['genre']);
	    $datenaiss = addslashes($_POST['anneenaiss'])."-".addslashes($_POST['moisnaiss'])."-".addslashes($_POST['journaiss']);
	    $cin = addslashes($_POST['cin']);
	    $titreoccup = addslashes($_POST['titreoccup']);
	    $adresse = addslashes($_POST['adresse']);
	    $telephone = addslashes($_POST['telephone']);
	    $email = addslashes($_POST['email']);
	    $profession = addslashes($_POST['profession']);
	    $structure = addslashes($_POST['structure']);
	    $situation = addslashes($_POST['situation']);
	    $ethnie = addslashes($_POST['ethnie']);
	    $religion = addslashes($_POST['religion']);
	    $secteur = addslashes($_POST['secteur']);
	    $date_entree = addslashes($_POST['anneeentree'])."-".addslashes($_POST['moisentree'])."-".addslashes($_POST['jourentree']);
	    $pack = addslashes($_POST['pack']);
	    $montant = addslashes($_POST['montant']);
	    $modepaiement = addslashes($_POST['modepaiement']);
	    $tva = addslashes($_POST['tva']);
	    $presence = addslashes($_POST['presence']);
	    $codeselect = addslashes($_POST['codeselect']);
	    $groupement = addslashes($_POST['groupement']);
	    $typeclient = addslashes($_POST['typeclient']);
	    
	    $tmp_name = $_FILES['photo']['tmp_name'];
		  $name = $_FILES['photo']['name']; 
		  $type=explode(".",$name);		
		  $photo = $code.".".$type[1]; 
		  
		  $uploadpath='../Photos/'; 	    
	    if (!move_uploaded_file($tmp_name,$uploadpath.$photo))
	    $photo = ''; 
		
	    $query = "INSERT INTO membres (code, pack, groupement_id, nom_complet, genre, date_naiss, numero_cin, adresse, 
	                                    telephone, email, profession, structure, ethnie, sit_famille, religion, 
	                                    photo, presence, localite, date_entree, tva, lp_maison, 
	                                    montant_credit, mode_paiement, typeclient) 
			                  VALUES('$code', '$pack', '$groupement', '$nom', '$genre', '$datenaiss', '$cin', '$adresse', '$telephone', '$email', '$profession', '$structure', '$ethnie', '$situation', '$religion', '$photo', '$presence', '$secteur', '$date_entree', '$tva', '$titreoccup', '$montant', '$modepaiement', '$typeclient')";
	    
		
	    $result = mysql_query($query, $connection) or die("error: " . mysql_error());
	    
	    $idmembre = mysql_insert_id();
			
			
	    if ($result){
			    
	   
		   // redirect_to("show_membre.php?idmembre=$idmembre");
		   }
		}
?>
<?php include("../includes/header.php");?>

  
    <?php include('../includes/menu.php'); ?>
    	
   <script type="text/javascript">
    function select_pack(choix){
      if(choix=='1'){
        document.form.montant.value = '50 000';
        }
      else if(choix=='2'){
        document.form.montant.value = '100 000';
      } 
      else if(choix=='3'){
        document.form.montant.value = '150 000';
      } 
      else if(choix=='4'){
        document.form.montant.value = '';
      } 
    }
    </script>
   
      <div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
				<h3> Formulaire de saisie d'un membre </h3>
				</div>
				<div class="clear"></div> <!-- End .clear -->
				<div class="content-box-content">
			      
			      <form action="new_membre.php" name="form" id="form" method="post" enctype="multipart/form-data">
                 <div class="line">
                 	<div class="unit size1of2">
                    <h3>Identification</h3>
                      
                      <label for ="typeclient">Type:</label>
                      <select name="typeclient">
                      <option value="M">Membre</option>
                      <option value="C">Client Simple</option>
                      </select><br />
                      
                      <label for ="nom">ID Membre :</label>
                      <input class="text-input small-input" type="text" name="code" id="code" value="<?php echo searchId();?>"/><br />
                      
                      <label for ="nom">Nom Complet :</label>
                      <input class="text-input medium-input" type="text" name="nom" id="nom" size="40" autocomplete="off"/><br />
                      
                      <label for ="nom">Genre:</label>
                      <select name="genre">
                      <option value="M">Homme</option>
                      <option value="F">Femme</option>
                      </select><br />
                      
                      <label for ="nom">Date de Naissance :</label>
                      <select name="journaiss">
                        <option value="">jour</option>
                        <?php
                        $i = 0;
                        while($i < 31) {?>
                         <option value="<?php echo $jour[$i];?>"><?php echo $jour[$i];?></option>
                      <?php $i++; } ?>
                      </select>
                      <select name="moisnaiss">
                        <option>mois</option>
                         <?php
                        $j = 0;
                        while($j < 12) {?>
                         <option value="<?php echo $mois[$j];?>"><?php echo $mois[$j];?></option>
                      <?php $j++; } ?>
                      </select>
                      <select name="anneenaiss">
                        <option value="">année</option>
                         <?php
                        $y = 1900;
                        while($y <= Date('Y')) {?>
                         <option value="<?php echo $y;?>"><?php echo $y;?></option>
                      <?php $y++; } ?>
                      </select>
                      <br />
                      
                      <label for ="nom">Numéro CIN :</label>
                      <input class="text-input medium-input" type="text" name="cin" id="cin" size="40" autocomplete="off"/><br />
                      
                      <label for ="nom">Titre d'occupation :</label>
                      <select name="titreoccup"> 
                      <option value="L">Locataire</option>
                      <option value="P">Propriétaire</option>
                      </select><br />
                      
                      <label for ="nom">Adresse :</label>
                      <input class="text-input medium-input" type="text" name="adresse" id="adresse" size="40" autocomplete="off"/><br />
                      
                      <label for ="nom">Telephone :</label>
                      <input class="text-input medium-input" type="text" name="telephone" id="telephone" size="40" autocomplete="off"/><br />
                      
                      <label for ="nom">Email :</label>
                      <input class="text-input medium-input" type="text" name="email" id="email" size="40" autocomplete="off"/><br />
                      
                      <label for ="nom">Profession :</label>
                      <input class="text-input medium-input" type="text" name="profession" id="profession" size="40" autocomplete="off"/><br />
                      
                      <label for ="nom">Structure :</label>
                      <input  class="text-input medium-input" type="text" name="structure" id="structure" size="40" autocomplete="off"/><br />
                      
                      <label for ="nom">Situation de famille :</label>
                      <select name="situation">
                      <option value="C">Célibataire</option>
                      <option value="M">Marié</option>
                      </select>
                	   <br />
                       
                      <label for ="nom">Photo :</label>
                      <input class="text-input medium-input" type="file" name="photo" id="photo" size="40" autocomplete="off"/><br />
                    
                     </div>
                    
                 	<div class="unit size1of2">
                    <h3>Divers</h3>
                      <label for ="nom">Ethnie :</label>
                      <input class="text-input medium-input" type="text" name="ethnie" id="ethnie" size="40" autocomplete="off"/><br />
                      
                      <label for ="nom">Religion :</label>
                      <input class="text-input medium-input" type="text" name="religion" id="religion" size="40" autocomplete="off"/><br />
                      
                      <label for ="nom">Secteur :</label>
                      <input class="text-input medium-input" type="text" name="secteur" id="secteur" size="40" autocomplete="off"/><br />
                      
                      <label for ="nom">Date Entrée :</label>
                        
                      <select name="jourentree">
                        <option value="">jour</option>
                        <?php
                        $i = 0;
                        while($i < 31) {?>
                         <option value="<?php echo $jour[$i];?>"><?php echo $jour[$i];?></option>
                      <?php $i++; } ?>
                      </select>
                      <select name="moisentree">
                        <option>mois</option>
                         <?php
                        $j = 0;
                        while($j < 12) {?>
                         <option value="<?php echo $mois[$j];?>"><?php echo $mois[$j];?></option>

                      <?php $j++; } ?>
                      </select>
                      <select name="anneeentree">
                        <option value="">année</option>
                         <?php
                        $y = 2011;
                        while($y <= Date('Y')) {?>
                         <option value="<?php echo $y;?>"><?php echo $y;?></option>
                      <?php $y++; } ?>
                      </select>
                      <br />
                      
                       <label for ="code">Pack :</label>
                      <select name="pack" onchange="select_pack(document.form.pack.value);">
                      <option value="1">Takkale</option>
                      <option value="2">Soutoura</option>
                      <option value="3">Tawfex</option>
                      <option value="4">Teranga</option>
                      </select><br />
                      
                      <label for ="nom">Montant Crédit :</label>
                      <input class="text-input medium-input" type="text" name="montant" id="montant" value="50 000" size="40" autocomplete="off"/>
                      <br />
                      
                      <label for ="nom">Mode de Paiement :</label>
                       <select name="modepaiement">
                          <option value="E">Espèce</option>
                          <option value="C">Chèque</option>
                          <option value="V">Virement</option>
                      </select><br />
                      
                      <label for ="nom">TVA :</label>
                      
                      <select name="tva">
                      <option value="O">Oui</option>
                      <option value="N">Non</option>
                      </select><br />
                      
                      <label for ="nom">Présence :</label>
                      <select name="presence">
                      <option value="O">Oui</option>
                      <option value="N">Non</option>
                      </select><br />
                      
                     <!-- <label for ="nom">Code Select :</label>
                      <select name="codeselect">
                      <option value="0">Oui</option>
                      <option value="1">Non</option>
                      </select><br />
                    -->
                      <label for ="nom">Groupement :</label>
                      <select name="groupement">
					  <?php
                         $query = "SELECT * FROM groupements";
                         $result= mysql_query($query) or die("error: " . mysql_error());;
                         confirm_query($result);
                         $row= mysql_fetch_array($result);
                        ?>
                        <option value="">Selectionnez</option>
                        <?php do { ?>
                        <option value="<?php echo $row['id'];?>"><?php echo $row['enseigne'];?></option>
                        <?php } while($row = mysql_fetch_array($result));?>
                        </select><br />
                    </div>
                   </div>
              
                   <br />
                  <input class="button" type="submit" name="submit" value="Créer Membre">
                  <a href="show_membre.php?idmembre=<?php echo $idmembre;?>">
                    <input class="button" type="button" name="reset" value="Quitter sans enregistrer"></a>
                  </form>
                  
			  </div>
		</div>
			
			<div class="clear"></div> <!-- End .clear -->
<?php include('../includes/footer.php')?>

