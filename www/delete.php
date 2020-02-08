<?php
	require_once 'Manager/ProductManager.php';
	require_once 'Entity/Product.php';

	include 'db_connection.php';

	$db = new MyBD();
	$manager = new ProductManager($db);
	if(isset($_GET['id'])){
		$p = $manager->get($_GET['id']);
		$manager->delete($p);
	}
	header('Location: '. 'product_list.php');
?>