<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
$query = "SELECT enseigne, contact, tel_c, email_c
	         FROM groupements";
	$result_list = mysql_query($query);
	confirm_query($result_list);
	$row_list = mysql_fetch_array($result_list);
?>
<?php include("../includes/header.php");?>

  
    <?php include('../includes/menu.php'); ?>
    	
      
      <div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
				<h3> Liste des groupements </h3>
				</div>
				<div class="clear"></div> <!-- End .clear -->
				<div class="content-box-content">
			       <table>
				    <thead>
				      <tr>
				        <th>ENSEIGNE</th>
				        <th>CONTACT</th>
				        <th>TELEPHONE</th>
				        <th>EMAIL</th>
				        <th></th>
				      </tr>
				      <?php do {?>
				      <tr>
				        <td><?php echo $row_list['enseigne'];?></td>
				        <td><?php echo $row_list['contact'];?></td>
				        <td><?php echo $row_list['tel_c'];?></td>
				        <td><?php echo $row_list['email_c'];?></td>
				        <td><a href="show_groupement.php?idgroup=<?php echo $row_list['idgroup'];?>">Détail</a></td>
				      </tr>
				      <?php } while($row_list = mysql_fetch_array($result_list));?>
				    </thead>
				    
				    </table>
			  </div>
		</div>
			
			<div class="clear"></div> <!-- End .clear -->

<?php include('../includes/footer.php')?>

