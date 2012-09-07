<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/form_functions.php"); ?>
<?php
   
  $result_set = mysql_query("SELECT users.id as id, role_id, libelle, Nom_complet, fonction, email, username, hashed_password
            FROM roles, users 
            WHERE 
            roles.id = role_id ", $connection);
	confirm_query($result_set);
  $row = mysql_fetch_array($result_set);
?>


<?php include("../includes/header.php");?>
<link href="../stylesheets/afr-tables.css" rel="stylesheet" >

  <?php include('../includes/menu.php')?>
  
        <section id="page">
            <div class="container_12">
              <div class="grid_12">
                <div id="menu-cadre">
                  <h3 class="line">
                    <span class="unit size3of4">Gestion des utilisateurs</span>
                    <span class="unit size1of4 LastUnit admin-links">
                    <?php if($_SESSION['user_profil'] == "administrateur") {?>
                    <a href="register.php">Ajouter utilisateur</a></span>
                    <?php }?>
                    </h3>
                   <p class="list-heading line">
                      <span class="unit size1of4">Nom Complet</span>
                      <span class="unit size1of4">Login</span>
                      <span class="unit size1of4">Mot de Passe</span>
                   </p>
                      <ul class="records-list">
                          <?php do { ?>
                            <li class="odd line">
                              <span class="unit size1of4"><h4><?php echo $row['Nom_complet']; ?></h4></span>
                              <span class="unit size1of4"><h4><?php echo $row['username']; ?></h4></span>
                              <span class="unit size1of4"><h4><?php echo $row['hashed_password']; ?></h4></span>
                              <span class="unit size1of4 lastUnit admin-links">
                                <span><a href="show_user.php?id=<?php echo urlencode($row['id']);?>">Afficher les D&eacute;tails</a>
                                </span> <?php if($_SESSION['user_profil'] == "administrateur") {?>| 
                                <span><a href="edit_user.php?id=<?php echo urlencode($row['id']);?>">Modifier</a>
                                </span> | 
                                <span><a href="delete_user.php?id=<?php echo urlencode($row['id']);?>" onclick="return confirm('Etes vous sur de vouloir supprimer ce dossier')">Supprimer</a>
                                </span><?php }?>
                              </span>
                            </li>
                                <?php } while ($row = mysql_fetch_array($result_set)); ?>
                        </ul>
                  </div>
              </div>
            </div>
        </section>
       
	
<?php include('../includes/footer.php')?>
