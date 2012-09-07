<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/form_functions.php"); ?>
<?php
  $idmembre = $_GET['idmembre'];
  $query = "SELECT code, nom_complet, date_naiss, numero_cin, membres.adresse as adresse_membre, 
	                 telephone, email, profession, structure, ethnie, sit_famille, religion, 
	                 presence, code_select, localite, date_entree, tva, 
	                 lp_maison, montant_credit, mode_paiement, typeclient, photo
	          FROM membres, groupements WHERE membres.id = '{$idmembre}'";
	$result_list = mysql_query($query);
	confirm_query($result_list);
	$row_list = mysql_fetch_array($result_list);
?>
<?php include("../includes/header.php");?>
<script language="javascript" src="../javascripts/script_money.js"></script>
  
    <?php include('../includes/menu.php'); ?>
    	
      
      <div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
				<h3> Détail du membre <?php echo $row_list['nom_complet'];?> </h3>
				</div>
				<div class="clear"></div> <!-- End .clear -->
				<div class="content-box-content">
       <div class="line">
       	<div class="unit size1of3">
          <span class="identity">Identification</span>
			   <p>
            <b>ID Membre : </b><span class="show-membre"><span class="show-membre"><?php echo $row_list['code']; ?></span>
         </p>
			   
			   <p>
            <b>Nom Complet : </b><span class="show-membre"><?php echo $row_list['nom_complet']; ?></span>
         </p>
			   <p>
            <b>Date Naissance : </b><span class="show-membre"><?php echo dateformat($row_list['date_naiss']); ?></span>
         </p>
			   <p>
            <b>Numero d'identification : </b><span class="show-membre"><?php echo $row_list['numero_cin']; ?></span>
         </p>
			   <p>
            <b>Adresse : </b><span class="show-membre"><?php echo $row_list['adresse_membre'];?></span>
         </p>
			   <p>
            <b>Téléphone : </b><span class="show-membre"><?php echo $row_list['telephone']; ?></span>
         </p>
			   <p>
            <b>Email : </b><span class="show-membre"><?php echo $row_list['email']; ?></span>
         </p>
			   <p>
            <b>Profession : </b><span class="show-membre"><?php echo $row_list['profession']; ?></span>
         </p>
			   <p>
            <b>Structure : </b><span class="show-membre"><?php echo $row_list['structure']; ?></span>
         </p>
			   <p>
            <b>Ethnie : </b><span class="show-membre"><?php echo $row_list['ethnie']; ?></span>
         </p>
			   <p>
            <b>Situation de famille : </b><span class="show-membre">
            <?php if($row_list['sit_famille']=='C') echo "Célibataire"; else echo "Marié(e)" ?></span>
         </p>
         </div>
         <div class="unit size1of3 ">
          <span class="identity">Divers</span>
			   <p>
            <b>réligion : </b><span class="show-membre"><?php echo $row_list['religion']; ?></span>
         </p>
			   <p>
            <b>présence : </b><span class="show-membre">
            <?php if($row_list['presence']=='O') echo "Oui"; else echo "Non"; ?></span>
         </p>
			   <p>
            <b>code_select : </b><span class="show-membre">
            <?php if($row_list['code_select']=='1') echo "Actif"; else echo "Non Actif"; ?></span>
         </p>
			   <p>
            <b>localité : </b><span class="show-membre"><?php echo $row_list['localite']; ?></span>
         </p>
			   <p>
            <b>date entrée : </b><span class="show-membre"><?php echo $row_list['date_entree']; ?></span>
         </p>
			   <p>
            <b>TVA : </b><span class="show-membre">
            <?php if($row_list['tva']=='O') echo "Oui"; else echo "Non"; ?></span>
         </p>
			   <p>
            <b>lp_maison : </b><span class="show-membre">
            <?php if($row_list['lp_maison']=='L') echo "Locataire"; else echo "Propriétaire"; ?></span>
         </p>
			   <p>
            <b>Montant Crédit : </b><span class="show-membre"><?php echo $row_list['montant_credit']; ?></span>
         </p>
			   <p>
            <b>Mode Paiement : </b><span class="show-membre">
            <?php if($row_list['mode_paiement']=='E') echo "Espèce"; else if($row_list['mode_paiement']=='V')echo "Virement"; if($row_list['mode_paiement']=='C') echo "Chèque"?></span>
         </p>
			   <p>
            <b>Type Client : </b><span class="show-membre">
            <?php if($row_list['lp_maison']=='M') echo "Membre"; else echo "Client Simple"; ?></span>
         </p>
         </div>
         <div class="unit size1of3 ">
         
         <?php if(!empty($row_list['photo'])) {?>
          <img src="../Photos/<?php echo $row_list['photo']; ?> "/>
        <?php }
        else {?>
         <img src="../Photos/avatar.png"/>
         <?php }?>
         </div>
        </div>
         
			  </div>
		</div>
			
			<div class="clear"></div> <!-- End .clear -->

<?php include('../includes/footer.php')?>

