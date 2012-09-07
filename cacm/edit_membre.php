<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>
 <?php
$jour=array("01","02","03","04","05","06","07","08","09","10","11","12",
            "13","14","15","16","17","18","19","20","21","22","23","24","25",
            "26","27","28","29","30","31");
$mois=array("01","02","03","04","05","06","07","08","09","10","11","12");
?> 

<?php
	include_once("../includes/form_functions.php");
	
  $idmembre = $_GET['idmembre'];
  $query = "SELECT code, pack, nom_complet, date_naiss, numero_cin, membres.adresse as adresse_membre, telephone,
	                 telephone, email, profession, structure, secteur, ethnie, sit_famille, religion, 
	                 presence, code_select, localite, date_entree, tva, 
	                 lp_maison, montant_credit, mode_paiement, typeclient, photo, groupement_id
	          FROM membres WHERE membres.id = '{$idmembre}'";
	$result_list = mysql_query($query);
	confirm_query($result_list);
	$row_list = mysql_fetch_array($result_list);
	
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
		
	    $query = "UPDATE membres SET code = '$code', pack = '$pack', groupement_id = '$groupement', 
	                         nom_complet = '$nom', genre = '$genre', date_naiss = '$datenaiss', 
	                         numero_cin = '$cin', adresse = '$adresse', telephone = '$telephone', 
	                         email = '$email', profession = '$profession', structure = '$structure', 
	                         ethnie = '$ethnie', sit_famille = '$situation', religion = '$religion', 
	                         photo = '$photo', presence = '$presence', localite = '$secteur', 
	                         date_entree = '$date_entree', tva = '$tva', lp_maison = '$titreoccup', 
	                         montant_credit = '$montant', mode_paiement = '$modepaiement', typeclient = '$typeclient' 
	               WHERE membres.id = '$idmembre'";
	    
		
	    $result = mysql_query($query, $connection) or die("error: " . mysql_error());
	    
	    //$idmembre = mysql_insert_id();
			
			
	    if ($result){
		   redirect_to("show_membre.php?idmembre=$idmembre");
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
				<h3> Fiche de modification d'un membre </h3>
				</div>
				<div class="clear"></div> <!-- End .clear -->
				<div class="content-box-content">
			      
			      <form action="edit_membre.php?idmembre=<?php echo $idmembre;?>" name="form" id="form" method="post" enctype="multipart/form-data">
                 <div class="line">
                 	<div class="unit size1of2">
                    <h3>Identification</h3>
                      <label for ="typeclient">Type:</label>
                      <select name="typeclient">
                      <option value="M">Membre</option>
                      <option value="C">Client Simple</option>
                      </select><br />
                      
                      <label for ="nom">ID Membre :</label>
                      <input class="text-input small-input" type="text" name="code" id="code" value="<?php echo $row_list['code'];?>"/><br />
                      
                      <label for ="nom">Nom Complet :</label>
                      <input class="text-input medium-input" type="text" name="nom" id="nom" size="40" autocomplete="off" value="<?php echo $row_list['nom_complet'];?>"/><br />
                      
                      <label for ="genre">Genre:</label>
                      <select name="genre">
                      <option value="M" <?php if($row_list['genre']=="M") { ?>selected<?php }?>>Homme</option>
                      <option value="F" <?php if($row_list['genre']=="F") { ?>selected<?php }?>>Femme</option>
                      </select><br />
                      <?php $date = $row_list['date_naiss'];
                       $date_format = preg_split('[-]',$date);
                       ?>
                      <label for ="nom">Date de Naissance :</label>
                      <select name="journaiss">
                        <option value="<?php echo $date_format[2]?>"><?php echo $date_format[2]?></option>
                        <option value="">jour</option>
                        <?php
                        $i = 0;
                        while($i < 31) {?>
                         <option value="<?php echo $jour[$i];?>"><?php echo $jour[$i];?></option>
                      <?php $i++; } ?>
                      </select>
                      <select name="moisnaiss">
                        <option value="<?php echo $date_format[1]?>"><?php echo $date_format[1]?></option>
                        <option>mois</option>
                         <?php
                        $j = 0;
                        while($j < 12) {?>
                         <option value="<?php echo $mois[$j];?>"><?php echo $mois[$j];?></option>
                      <?php $j++; } ?>
                      </select>
                      <select name="anneenaiss">
                        <option value="<?php echo $date_format[0]?>"><?php echo $date_format[0]?></option>
                        <option value="">année</option>
                         <?php
                        $y = 1900;
                        while($y <= Date('Y')) {?>
                         <option value="<?php echo $y;?>"><?php echo $y;?></option>
                      <?php $y++; } ?>
                      </select>
                      <br />
                      
                      <label for ="nom">Numéro CIN :</label>
                      <input class="text-input medium-input" type="text" name="cin" id="cin" size="40" autocomplete="off" value="<?php echo $row_list['numero_cin'];?>"/><br />
                      
                      <label for ="nom">Titre d'occupation :</label>
                      <select name="titreoccup"> 
                      <option value="L" <?php if($row_list['titreoccup']=="L") { ?>selected<?php }?>>Locataire</option>
                      <option value="P" <?php if($row_list['titreoccup']=="P") { ?>selected<?php }?>>Propriétaire</option>
                      </select><br />
                      
                      <label for ="nom">Adresse :</label>
                      <input class="text-input medium-input" type="text" name="adresse" id="adresse" size="40" autocomplete="off" value="<?php echo $row_list['adresse_membre'];?>"/><br />
                      
                      <label for ="nom">Telephone :</label>
                      <input class="text-input medium-input" type="text" name="telephone" id="telephone" size="40" autocomplete="off" value="<?php echo $row_list['telephone'];?>"/><br />
                      
                      <label for ="nom">Email :</label>
                      <input class="text-input medium-input" type="text" name="email" id="email" size="40" autocomplete="off" value="<?php echo $row_list['email'];?>"/><br />
                      
                      <label for ="nom">Profession :</label>
                      <input class="text-input medium-input" type="text" name="profession" id="profession" size="40" autocomplete="off" value="<?php echo $row_list['profession'];?>"/><br />
                      
                      <label for ="nom">Structure :</label>
                      <input  class="text-input medium-input" type="text" name="structure" id="structure" size="40" autocomplete="off" value="<?php echo $row_list['structure'];?>"/><br />
                      
                      <label for ="nom">Situation de famille :</label>
                      <select name="situation">
                      <option value="C" <?php if($row_list['sit_famille']=="C") { ?>selected<?php }?>>Célibataire</option>
                      <option value="M" <?php if($row_list['sit_famille']=="M") { ?>selected<?php }?>>Marié(e)</option>
                      </select>
                	   <br />
                       
                      <label for ="nom">Photo :</label>
                      <input class="text-input medium-input" type="file" name="photo" id="photo" size="40" autocomplete="off" value="<?php echo $row_list['photo'];?>"/><br />
                    
                     </div>
                    
                 	<div class="unit size1of2">
                    <h3>Divers</h3>
                      <label for ="nom">Ethnie :</label>
                      <input class="text-input medium-input" type="text" name="ethnie" id="ethnie" size="40" autocomplete="off" value="<?php echo $row_list['ethnie'];?>"/><br />
                      
                      <label for ="nom">Religion :</label>
                      <input class="text-input medium-input" type="text" name="religion" id="religion" size="40" autocomplete="off" value="<?php echo $row_list['religion'];?>"/><br />
                      
                      <label for ="nom">Secteur :</label>
                      <input class="text-input medium-input" type="text" name="secteur" id="secteur" size="40" autocomplete="off" value="<?php echo $row_list['secteur'];?>"/><br />
                       
                       <?php $dateentree = $row_list['date_entree'];
                       $date_entree = preg_split('[-]',$date);
                       ?>
                      <label for ="nom">Date Entrée :</label>
                        
                      <select name="jourentree">
                        <option value="<?php echo $date_entree[2]?>"><?php echo $date_entree[2]?></option>
                        <option value="">jour</option>
                        <?php
                        $i = 0;
                        while($i < 31) {?>
                         <option value="<?php echo $jour[$i];?>"><?php echo $jour[$i];?></option>
                      <?php $i++; } ?>
                      </select>
                      <select name="moisentree">
                        <option value="<?php echo $date_entree[1]?>"><?php echo $date_entree[1]?></option>
                        <option>mois</option>
                         <?php
                        $j = 0;
                        while($j < 12) {?>
                         <option value="<?php echo $mois[$j];?>"><?php echo $mois[$j];?></option>

                      <?php $j++; } ?>
                      </select>
                      <select name="anneeentree">
                        <option value="<?php echo $date_entree[0]?>"><?php echo $date_entree[0]?></option>
                        <option value="">année</option>
                         <?php
                        $y = 2011;
                        while($y <= Date('Y')) {?>
                         <option value="<?php echo $y;?>"><?php echo $y;?></option>
                      <?php $y++; } ?>
                      </select>
                      <br />
                      
                       <label for="code">Pack :</label>
                      <select name="pack" onchange="select_pack(document.form.pack.value);">
                      <option value="1" <?php if($row_list['pack'] == '1') { ?>selected<?php }?>>Takkale</option>
                      <option value="2" <?php if($row_list['pack'] == '2') { ?>selected<?php }?>>Soutoura</option>
                      <option value="3" <?php if($row_list['pack'] == '3') { ?>selected<?php }?>>Tawfex</option>
                      <option value="4" <?php if($row_list['pack'] == '4') { ?>selected<?php }?>>Teranga</option>
                      </select><br />
                      
                      <label for ="nom">Montant Crédit :</label>
                      <input class="text-input medium-input" type="text" name="montant" id="montant" size="40" autocomplete="off" value="<?php echo $row_list['montant_credit'];?>"/>
                      <br />
                      
                      <label for ="nom">Mode de Paiement :</label>
                       <select name="modepaiement">
                          <option value="E" <?php if($row_list['mode_paiement'] == 'E') { ?>selected<?php }?>>Espèce</option>
                          <option value="C" <?php if($row_list['mode_paiement'] == 'C') { ?>selected<?php }?>>Chèque</option>
                          <option value="V" <?php if($row_list['mode_paiement'] == 'V') { ?>selected<?php }?>>Virement</option>
                      </select><br />
                      
                      <label for ="nom">TVA :</label>
                      
                      <select name="tva">
                      <option value="O" <?php if($row_list['pack'] == 'O') { ?>selected<?php }?>>Oui</option>
                      <option value="N" <?php if($row_list['pack'] == 'N') { ?>selected<?php }?>>Non</option>
                      </select><br />
                      
                      <label for ="nom">Présence :</label>
                      <select name="presence">
                      <option value="O" <?php if($row_list['pack'] == 'O') { ?>selected<?php }?>>Oui</option>
                      <option value="N" <?php if($row_list['pack'] == 'N') { ?>selected<?php }?>>Non</option>
                      </select><br />
                      
                     <label for ="nom">Code Select :</label>
                      <select name="codeselect">
                      <option value="0" <?php if($row_list['pack'] == '0') { ?>selected<?php }?>>Oui</option>
                      <option value="1" <?php if($row_list['pack'] == '1') { ?>selected<?php }?>>Non</option>
                      </select><br />
                    
                      <label for ="nom">Groupement :</label>
                      <select name="groupement">
					            
					             <?php
                         $query = "SELECT * FROM groupements";
                         $result= mysql_query($query) or die("error: " . mysql_error());;
                         confirm_query($result);
                         $row= mysql_fetch_array($result);
                        ?>
                        <option value="0">Selectionnez</option>
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

