<?php
session_start();
?>
<?php 
   if(!isset($_SESSION['user_name'])){
          //Redirection vers l'authentification
          header("Location:../index.php");
         exit();
 }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<link rel="stylesheet" href="../stylesheets/reset.css" />
<link rel="stylesheet" href="../stylesheets/style.css"/>
<link rel="stylesheet" href="../stylesheets/invalid.css"/>
<link rel="stylesheet" href="../stylesheets/grids.css"/>
<link  href="../stylesheets/custom-theme/jquery-ui-1.8.15.custom.css" rel="Stylesheet" />	

<script type="text/javascript" src="../javascripts/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="../javascripts/jquery-ui-1.8.15.custom.min.js"></script>
<script type="text/javascript" src="../javascripts/facebox.js"></script>
<script type="text/javascript" src="../javascripts/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="../javascripts/jquery.wysiwyg.js"></script>
<title>Sacc - Cacm - Commandes en ligne</title>
</head>
<body>


