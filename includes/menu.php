<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>
 <?php 
  $query = 'SELECT * FROM categories';
   
  $result_set = mysql_query($query, $connection);
  confirm_query($result_set);
  $row_list = mysql_fetch_array($result_set);
  ?>
 <?php
  if($_SESSION['pack']==1) {
    $pack = "Takkale";
    $cons_min = "20 000";
    $cons_max = "50 000";
    }
  else if($_SESSION['pack']==2) {
    $pack = "Soutoura";
    $cons_min = "50 000";
    $cons_max = "100 000";
    }
  else if($_SESSION['pack']==3) {
    $pack = "Tawfex";
    $cons_min = "100 000";
    $cons_max = "150 000";
    }
  else if($_SESSION['pack']==4){
    $pack = "Teranga";
    $cons_min = ">= 200 000";
    $cons_min = "Illimite";
    }
 ?>
  <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
		
		  <div id="sidebar">
		      <div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
			
			<h1 id="sidebar-title">Sacc - Cacm</h1>
		  
			<!-- Sidebar Profile links -->
			<div id="profile-links">
				Bonjour, 
				<?php if($_SESSION['groupe'] == 'M') {?>
				<a href="#"><?php echo $_SESSION['user_name'];?></a>, <br />
				Pack <?php echo $pack;?> <br />
                Cons Min: <?php echo $cons_min;?> <br />
                Cons Max: <?php echo $cons_max;?>
        <?php }
        else {
          echo $_SESSION['user_name'];
        ?><br />
        Administrateur
        <?php }?>
        <br />
                <a href="../cacm/logout.php" title="Se déconnecter">Se déconnecter</a>
			</div>        
			
			<ul id="main-nav">  <!-- Accordion Menu -->
				
				<li>
					<a href="#" class="nav-top-item no-submenu"> <!-- Add the class "no-submenu" to menu items with no sub menu -->
						Tableau de bord
					</a>       
				</li>
				<?php if($_SESSION['groupe'] == 'A') {?>
				<li>
					<a href="#" class="nav-top-item">

						Gestion des membres
					</a>
					<ul>
						<li><a href="../cacm/new_membre.php">Ajouter un membre</a></li>
						<li><a href="../cacm/membres.php">Liste des membres</a></li>
					</ul>
				</li>
				<?php } ?>
				<li> 
					<a href="#" class="nav-top-item"> <!-- Add the class "current" to current menu item -->
					Gestion des produits
					</a>
					<ul>
					<?php if($_SESSION['groupe'] == 'A') {?>
						<li><a href="../cacm/new_produit.php">Ajouter un produit</a></li>
					<?php }?>
					<?php do { ?>
					<li><a href="../cacm/produits.php?idcat=<?php echo $row_list['id']; ?>"><?php echo $row_list['libelle']; ?></a></li>
					<?php } while($row_list = mysql_fetch_array($result_set));?>
						<li><a href="../cacm/search_produit.php">Rechercher un produit </a></li>
					</ul> 
				</li>
				
				<li>
					<a href="#" class="nav-top-item">
						Gestion des commandes
					</a>
					<ul>
						<li><a href="../cacm/commandes.php">Liste des commandes</a></li>
						<li><a href="../cacm/search_commande.php">Commandes archivées </a></li>
					</ul>
				</li>
				
				<li>
					<a href="#" class="nav-top-item">
						Accés au Compte
					</a>
					<ul>
						<li><a href="#">Nouveau Message</a></li>
						<li><a href="#">Boite de reception </a></li>
						<li><a href="#">Messages envoyés</a></li>
						<li><a href="#">Profil</a></li>
					</ul>
				</li>      
				
			</ul> <!-- End #main-nav -->
			</div>
		</div> <!-- End #sidebar -->
		
		<div id="main-content">
    	<!-- Page Head -->
    	<?php if($_SESSION['groupe'] == 'A') { ?>
			<h2>Espace de l'administrateur de la CACM</h2>
			<?php }
			else { ?>
			<h2>Espace membre de la CACM</h2>
			<?php } ?>
			
			<ul class="shortcut-buttons-set">
				
				<li><a class="shortcut-button" href="../cacm/produits.php"><span>
					<img src="../images/article.png" alt="icon" /><br />
				 Produits
				</span></a></li>
				<?php if($_SESSION['groupe'] == 'A') {?>
				<li><a class="shortcut-button" href="../cacm/new_produit.php"><span>
					<img src="../images/products.png" alt="icon" /><br />
				Nouveau Produit
				</span></a></li>
				<?php }?>
				<li><a class="shortcut-button" href="../cacm/new_command.php"><span>
					<img src="../images/icons/panier.png" alt="icon" /><br />
				Commander
				</span></a></li>
				<li><a class="shortcut-button" href="../cacm/commandes.php"><span>
					<img src="../images/icons/paper_content_pencil_48.png" alt="icon" /><br />
				Mes Commandes
				</span></a></li>
				<?php if($_SESSION['groupe'] == 'A') {?>
				<li><a class="shortcut-button" href="../cacm/new_membre.php"><span>
					<img src="../images/people.png" alt="icon" /><br />
				Ajouter Membre
				</span></a></li>
         <?php }?>  
         <?php if($_SESSION['groupe'] == 'A') {?>     
				<li><a class="shortcut-button" href="../cacm/new_groupement.php"><span>
					<img src="../images/members.png" alt="icon" /><br />
				 Groupement
				</span></a></li>
        <?php }?>       
				
			
				
			</ul><!-- End .shortcut-buttons-set -->
			
			<div class="clear"></div> <!-- End .clear -->
