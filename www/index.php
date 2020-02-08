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
<style type="text/css">
	body {
	  background: url(img/bg.jpg) no-repeat center center fixed;
	  -webkit-background-size: cover;
	  -moz-background-size: cover;
	  -o-background-size: cover;
	  background-size: cover;

  font-family: Montserrat;
  overflow: scroll;
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.bg-opacity{
	background-color: rgba(255, 255, 255, 0.5);
	width: 100%;
	height: 100%;
}

ul a:hover,
a.box:hover {
  -webkit-transform: scale(1.05);
}

ul a {
  list-style: none;
}

@media (max-width:765px){
	.metro {
	  width: 630px;
	  height: 300px;
	}
}

@media (min-width:765px){
	.metro {
		width: 80%;
	    height: 70%;
	    margin-right: auto;
	    margin-left: auto;
	    margin-top: 10%;
	}
}

.metro a {
  -webkit-transform: perspective(600px);
  -webkit-transform-style: preserve-3d;
  -webkit-transform-origin-x: 50%;
  -webkit-transform-origin-y: 50%;
  -ms-transform: perspective(600px);
  -ms-transform-style: preserve-3d;
  -ms-transform-origin-x: 50%;
  -ms-transform-origin-y: 50%;
  transform: perspective(600px);
  transform-style: preserve-3d;
  transform-origin-x: 50%;
  transform-origin-y: 50%;
  cursor: default;
  position: relative;
  text-align: center;
  margin: 0 20px 20px 0;
  width: 23.8%;
  height: 40%;
  color: #ffffff;
  float: left;
  -webkit-transition: .2s -webkit-transform, 1s opacity;
  -ms-transition: .2s -ms-transform, 1s opacity;
  transition: .2s transform, 1s opacity;
  cursor: pointer;
}

.metro a i {
  font-size: 54px;
  margin: 35px 0 0;
}

.metro a span {
  color: rgba(255, 255, 255, 0.8);
  text-transform: uppercase;
  position: absolute;
  left: 15px;
  bottom: 15px;
  font-size: 14px;
}

.metro a:first-child {
  background: #00c6ff;
  width: 60%;
}

.metro a:nth-child(2) {
  background: #f39c12;
  width: 30%;
}

.metro a:nth-child(3) {
  background: #49e035;
  width: 40%
}

.metro a:nth-child(4) {
  background: #627A4E;
}

.metro a:nth-child(5) {
  background: #779944;
  text-align: left;
}

.metro a:nth-child(6) {
  background: #82A93F;
}

.metro a:nth-child(7) {
  background: #404660;
}

.metro a:nth-child(8) {
  background: #404660;
}

.metro a:nth-child(9) {
  background: #404660;
  width: 310px;
}

.metro a:nth-child(10) {
  background: #576954;
  margin: 0;
  text-align: left;
}

.metro a:last-child {
  background: #8AB63A;
  margin: 0;
  text-align: left;
}

.metro a:nth-child(3):active,
.metro a:first-child:active {
  -webkit-transform: scale(0.9);
  -ms-transform: scale(0.9);
  transform: scale(0.9);
}

.metro a:nth-child(11):active,
.metro a:nth-child(2):active {
  -webkit-transform: perspective(700px) rotate3d(1, 0, 0, -10deg);
  -ms-transform: perspective(700px) rotate3d(1, 0, 0, -10deg);
  transform: perspective(700px) rotate3d(1, 0, 0, -10deg);
}

.metro a:nth-child(3):active {
  -webkit-transform: perspective(800px) rotate3d(0, 1, 0, 10deg);
  -ms-transform: perspective(600px) rotate3d(0, 1, 0, 10deg);
  transform: perspective(600px) rotate3d(0, 1, 0, 10deg);
}

.metro a:nth-child(4):active {
  -webkit-transform: perspective(600px) rotate3d(0, 1, 0, -10deg);
  -ms-transform: perspective(600px) rotate3d(0, 1, 0, -10deg);
  transform: perspective(600px) rotate3d(0, 1, 0, -10deg);
}

.metro a:nth-child(6):active {
  -webkit-transform: perspective(600px) rotate3d(1, 0, 0, 10deg);
  -ms-transform: perspective(600px) rotate3d(1, 0, 0, 10deg);
  transform: perspective(600px) rotate3d(1, 0, 0, 10deg);
}


/* POPUP */

.box {
  display: table;
  top: 0;
  visibility: hidden;
  -webkit-transform: perspective(1200px) rotateY(180deg) scale(0.1);
  -ms-transform: perspective(1200px) rotateY(180deg) scale(0.1);
  transform: perspective(1200px) rotateY(180deg) scale(0.1);
  top: 0;
  left: 0;
  z-index: -1;
  position: fixed;
  width: 100%;
  height: 100%;
  opacity: 0;
  transition: 1s all;
}

.box p {
  display: table-cell;
  vertical-align: middle;
  font-size: 64px;
  color: #ffffff;
  text-align: center;
  margin: 0;
  opacity: 0;
  transition: .2s;
  -webkit-transition-delay: 0.2s;
  -ms-transition-delay: 0.2s;
  transition-delay: 0.2s;
}

.box p i {
  font-size: 128px;
  margin: 0 0 20px;
  display: block;
}

.box .close {
  display: block;
  cursor: pointer;
  border: 3px solid rgba(255, 255, 255, 1);
  border-radius: 50%;
  position: absolute;
  top: 50px;
  right: 50px;
  width: 50px;
  height: 50px;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg) transform: rotate(45deg);
  transition: .2s;
  -webkit-transition-delay: 0.2s;
  -ms-transition-delay: 0.2s;
  transition-delay: 0.2s;
  opacity: 0;
}

.box .close:active {
  top: 51px;
}

.box .close::before {
  content: "";
  display: block;
  position: absolute;
  background-color: rgba(255, 255, 255, 1);
  width: 80%;
  height: 6%;
  left: 10%;
  top: 47%;
}

.box .close::after {
  content: "";
  display: block;
  position: absolute;
  background-color: rgba(255, 255, 255, 1);
  width: 6%;
  height: 80%;
  left: 47%;
  top: 10%;
}

.box.open {
  left: 0;
  top: 0;
  visibility: visible;
  opacity: 1;
  z-index: 999;
  -webkit-transform: perspective(1200px) rotateY(0deg) scale(1);
  -ms-transform: perspective(1200px) rotateY(0deg) scale(1);
  transform: perspective(1200px) rotateY(0deg) scale(1);
  width: 100%;
  height: 100%;
}

.box.open .close,
.box.open p {
  opacity: 1;
}
</style>
<!DOCTYPE html>
<html>
	<head meta charset="utf-8">
		<link rel="icon" href="img/GSD.ico">
		<link rel="stylesheet" href="https://fonts">
	</head>
	<body>
	<!--
		<div class="col-sm-12">
			<center>
				<img src="img/GSD.ico" width="100px" style="margin: 5%">
			</center>
		</div>
		<div class="col-sm-4">
			<a href="product_list.php" class="btn btn-primary btn-lg custom-flat btn-padding" >Mon Stock</a>
		</div>
		<div class="col-sm-4">
			<a href="commande_list.php" class="btn btn-primary btn-lg custom-flat btn-padding">Les Ventes</a>
		</div>
		<div class="col-sm-4">
			<a href="commande_list.php" class="btn btn-primary btn-lg custom-flat btn-padding">Fournisseurs et Clients</a>
		</div>
		-->
		<div>
			<ul class="metro">
			  <a href="product_list.php" class="mon_stock"><li><i class="fa fa-gamepad"></i><span>Mon Stock</span></li></a>
			  <a href="commande_list.php" class="ventes"><li><i class="fa fa-cogs"></i><span>Les Ventes</span></li></a>
			  <a href="commande_list.php" class="four_client"><li><i class="fa fa-envelope-o"></i><span>Fournisseurs et Clients</span></li></a>
			</ul>
		</div>
	</body>
</html>
	
	
	