<?php include 'inc.php'; ?>

<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/product_list.js" ></script>

<center>
	<h2>Liste des produits</h2>
</center>
<div class="col-md-10 col-md-offset-1" style="margin-bottom: 10px;">
	<a class="btn btn-success" href="add_product.php">Ajouter produit</a>
</div>
<div class="col-md-11 col-md-offset-1">
<table id="table_id" class="table" style="margin-top: 10px;">
	<thead>
		<tr>
			<th>Libelle</th>
			<th>Quantite</th>
			<th>Quantite restante</th>
			<th>Fournisseur</th>
			<th>Prix d'achat</th>
			<th>Prix de vente</th>
			<th>Prix d'achat total</th>
			<th>Prix de vente total</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php
		$manager = new ProductManager($db);
			foreach ($manager->getList() as $value) {
				echo "<td>" . $value->getLibelle() . "</td>";
				echo "<td>" . $value->getQuantite() . "</td>";
				echo "<td>" . $value->getQuantiteRestante() . "</td>";
				echo "<td>" . $manager->getFournisseurName($value->getFournisseurId()) . "</td>";
				echo "<td>" . $value->getPrixAchat(). "</td>";
				echo "<td>" . $value->getPrixVente(). "</td>";
				echo "<td>" . $value->getPrixAchat() * $value->getQuantite() . "</td>";
				echo "<td>" . $value->getPrixVente() * ($value->getQuantite() - $value->getQuantiteRestante()). "</td>";
				echo "<td>
				<a class='btn btn-info' href='add_product.php?id=".$value->getId()."'><span class='glyphicon glyphicon-pencil'></span></a> 
				<a class='btn btn-danger' href='delete.php?id=".$value->getId()."'><span class='glyphicon glyphicon-remove'></span></a>
				</td></tr>";
			}
	?>
	</tbody>
	<tfoot>
		<tr>
			<td></td><td></td><td></td><td></td><td></td>
			<td></td>
			<td></td>
			<td></td><td></td>
		</tr>
	</tfoot>
</table>
</div>
</body>
</html>