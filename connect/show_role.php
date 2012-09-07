<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/form_functions.php"); ?>
<?php
  $id = $_GET['id'];
  $query = "SELECT id, libelle
            FROM roles 
            WHERE id = '{$id}'";
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
                    <span class="unit size1of2">Detail Role</span>
                    <span class="unit size1of2 LastUnit admin-links">
                      <a href="roles.php">liste des roles</a> | 
                      <a href="register.php">Nouvel Utilisateur</a>
                    </span>
                  </h3>
                    <p>
                      <b>Role:</b> <?php echo $row['libelle']?>
                    </p> 
                    
                    <p>
                      <h3>liste des utilisateurs</h3>
                    </p>
                      <?php
                        $query_list = "SELECT users.id, Nom_complet, fonction, email, username, 
			                                 hashed_password
                                      FROM users, roles 
                                      WHERE
                                      roles.id = role_id 
                                      AND roles.id = '{$id}' ";
	                      $result_list = mysql_query($query_list, $connection);
	                      confirm_query($result_list);
	                      $row_list = mysql_fetch_array($result_list);
                      ?>
                      <p class="list-heading line">
                        <span class="unit size1of5">Nom Complet</span>
                        <span class="unit size1of5">Login</span>
                        <span class="unit size1of5">Mot de Passe</span>
                      </p>
                      <ul class="records-list">
                          <?php do { ?>
                            <li class="odd line">
                              <span class="unit size1of5">
                              <h4><?php  echo $row_list['Nom_complet']; ?></h4>
                              </span>
                              <span class="unit size1of5"><h4><?php echo $row_list['username']; ?></h4></span>
                              <span class="unit size1of5"><h4><?php echo $row_list['hashed_password']; ?></h4></span>
                              <span class="unit size1of5 lastUnit admin-links">
                                <span><a href="show_user.php?id=<?php echo urlencode($row_list['id']);?>">D&eacute;tails</a></span> |
                                <span><a href="edit_user.php?id=<?php echo urlencode($row_list['id']);?>">Modifier</a></span> |
                                <span><a href="delete_user.php?id=<?php echo urlencode($row_list['id']);?>" onclick="return confirm('Etes vous sur de vouloir annuler cet utilisateur')">Supprimer</a></span>
                              </span>
                            </li>
                                <?php } while ($row_list = mysql_fetch_array($result_list)); ?>
                        </ul>
                </div>
             </div> 
            </div> 
        </section>
<?php include("../includes/footer.php");?>
