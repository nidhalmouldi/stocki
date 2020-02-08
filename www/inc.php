<?php
	require_once 'Manager/ProductManager.php';
	require_once 'Entity/Product.php';

	include 'db_connection.php';

	$db = new MyBD();
	$p = new Product();
?>
<link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css" >
<link rel="stylesheet" href="lib/bootstrap/css/bootstrap.css" >

<script src="js/jquery.min.js" type="text/javascript"></script>
<style>
	ul {
	    list-style-type: none;
	    margin: 0;
	    padding: 0;
	    overflow: hidden;
	    background-color: #5665fb;
	}

	li {
	    float: left;
	}

	li a {
	    display: block;
	    color: white;
	    text-align: center;
	    padding: 16px;
	    text-decoration: none;
	}

	li a:hover {
	    background-color: #3d4aca;
	}
</style>
<!DOCTYPE html>
<html>
	<head meta charset="utf-8">
		<link rel="icon" href="img/GSD.ico">
	</head>
	<body style="background-color: #dfdfdf;">
	<ul>

	  	<li><a href="product_list.php">List des produits</a></li>
	  	<li><a href="add_product.php">Ajouter produit</a></li>
	  	<li><a href="add_cmd.php">Passer une commande</a></li>
	  	<li><a href="commande_list.php">List des commandes</a></li>
	  	<li><a href="mon_compte.php">Mon compte</a></li>
	  	<a href="index.php"><img src="img/GSD.ico" width="45px" style="float: right; margin-right: 20px;"></a>
	</ul>