<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
$query = "SELECT id, code, nom_complet, telephone, email
	         FROM membres";
	$result_list = mysql_query($query);
	confirm_query($result_list);
	$row_list = mysql_fetch_array($result_list);
?>
<?php include("../includes/header.php");?>

  
    <?php include('../includes/menu.php'); ?>
    	
      
      <div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
				<h3> Liste des membres </h3>
				</div>
				<div class="clear"></div> <!-- End .clear -->
				<div class="content-box-content">
			       <table>
				    <thead>
				      <tr>
                        <th>CODE</th>
				        <th>NOM</th>
				        <th>TELEPHONE</th>
				        <th>EMAIL</th>
				        <th></th>
				      </tr>
				      <?php do {?>
				      <tr>
                        <td><?php echo $row_list['code'];?></td>
				        <td><?php echo $row_list['nom_complet'];?></td>
				        <td><?php echo $row_list['telephone'];?></td>
				        <td><?php echo $row_list['email'];?></td>
				        <td>
				        <a href="show_membre.php?idmembre=<?php echo $row_list['id'];?>">
				          <img src="../images/detail.png" title="afficher les details" alt="afficher les details"/>
				        </a> 
				        <a href="edit_membre.php?idmembre=<?php echo $row_list['id'];?>">
				          <img src="../images/edit.png" title="Modifier" alt="Modifier"/>
				        </a> 
				        <a href="delete_membre.php?idmembre=<?php echo $row_list['id'];?>">
				          <img src="../images/delete.png" title="Supprimer" alt="Supprimer"/>
				        </a> 
				        <a href="new_user.php?idmembre=<?php echo $row_list['id'];?>">
				          <img src="../images/key.png" title="Attribuer un compte" alt="Attribuer un compte"/>
				        </a>
				        </td>
				      </tr>
				      <?php } while($row_list = mysql_fetch_array($result_list));?>
				    </thead>
				    
				    </table>
			  </div>
		</div>
			
			<div class="clear"></div> <!-- End .clear -->

<?php include('../includes/footer.php')?>

