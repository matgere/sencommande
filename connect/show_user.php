<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/form_functions.php"); ?>
<?php
  $id = $_GET['id'];
  $query = "SELECT users.id, Nom_complet, fonction, email, username, hashed_password
            FROM roles, users 
            WHERE users.id = '{$id}'";
	$result_set = mysql_query($query);
	confirm_query($result_set);
	$row = mysql_fetch_array($result_set);
?>
<?php include("../includes/header.php");?>
 <?php include('../includes/menu.php')?>
  
        <section id="page">
            <div class="container_12">
              <div class="grid_12">
                <div id="menu-cadre">
                <h3 class="line">
                    <span class="unit size1of2">Detail de l'utilisateur</span>
                    <span class="unit size1of2 LastUnit admin-links">
                    <?php if($_SESSION['user_profil'] == "administrateur") {?>
                      <a href="roles.php">liste des roles</a> | 
                      <a href="edit_user.php?id=<?php echo urlencode($row['id']);?>">Modifier</a> | 
                      <a href="register.php">Nouvel Utilisateur</a>
                    <?php }?>
                    </span>
                  </h3>
                    <p>
                      <b>Nom Complet:</b> <?php echo $row['Nom_complet']?>
                    </p> 
                    
                    <p>
                      <b>Fonction:</b> <?php echo $row['fonction']?>
                    </p> 
                    
                    <p>
                      <b>Couriel:</b> <?php echo $row['email']?>
                    </p> 
                    
                    <p>
                      <b>Login:</b> <?php echo $row['username']?>
                    </p> 
                    <p>
                      <b>Mot de Passe:</b> <?php echo $row['hashed_password']?>
                    </p> 
                </div>
             </div>
      </div>  
        </section>
      
<?php include("../includes/footer.php");?>
