<?php include_once('jcart/jcart.php');?>
<?php include("../includes/header.php");?>
<script type="text/javascript" src="jcart/js/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="jcart/js/jcart.min.js"></script>

		<link rel="stylesheet" href="style.css" />

		<link rel="stylesheet" href="jcart/css/jcart.css" />
  
    <?php include('../includes/menu.php'); ?>

      
      <div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
				<h3> Tableau de bord </h3>
				</div>
				<div class="clear"></div> <!-- End .clear -->
				<div class="content-box-content">
			 <div id="content">
				<div id="jcart"><?php $jcart->display_cart();?></div>

				<p><a href="new_command.php">&larr; +Commandes</a></p>

				<?php
					//echo '<pre>';
					//var_dump($_SESSION['jcart']);
					//echo '</pre>';
				?>
			</div>

			  </div>
		</div>
			
			<div class="clear"></div> <!-- End .clear -->

<?php include('../includes/footer.php')?>

