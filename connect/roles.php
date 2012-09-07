<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/form_functions.php"); ?>
<?php
   
  $result_set = mysql_query("SELECT id, libelle FROM roles", $connection);
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
                      <span class="unit size3of4">Gestion des rôles</span>
                      <span class="unit size1of4 LastUnit admin-links">
                      </span>
                   </h3>
                   <p class="list-heading line">
                      <span class="unit size1of4">Rôle</span>
                   </p>
                      <ul class="records-list">
                          <?php do { ?>
                            <li class="odd line">
                              <span class="unit size1of4"><h4><?php echo $row['libelle']; ?></h4>
                              </span>
                              <span class="unit size1of4 lastUnit admin-links">
                                <span><a href="show_role.php?id=<?php echo urlencode($row['id']);?>">Afficher les D&eacute;tails</a></span>
                              </span>
                            </li>
                                <?php } while ($row = mysql_fetch_array($result_set)); ?>
                        </ul>
                  </div>
                </div>
         </div>
        </section>
<?php include("../includes/footer.php");?>
