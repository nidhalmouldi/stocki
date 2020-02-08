<?php
	include 'inc.php';
?>

<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="js/jquery.dataTables.js"></script>


<script type="text/javascript">
	$(document).ready( function () {

		 $('#tous_table').DataTable({
			"footerCallback": function ( row, data, start, end, display ) {
	            totalPrixVente = this.api()
	    				.column(2, {search:'applied'})
	    				.data()
	    				.reduce( function (a, b) {
	                    return parseFloat(a) + parseFloat(b);
	                	}, 0 );
	            $( this.api().column( 2 ).footer() ).html(totalPrixVente);
	            
	    	}
		});

    	$('#table_id').DataTable( {
	    	"footerCallback": function ( row, data, start, end, display ) {
	            totalPrixVente = this.api()
	    				.column(3, {search:'applied'})
	    				.data()
	    				.reduce( function (a, b) {
	                    return parseFloat(a) + parseFloat(b);
	                	}, 0 );
	            $( this.api().column( 3 ).footer() ).html(totalPrixVente);

	            totalQantite = this.api()
	    				.column(1, {search:'applied'})
	    				.data()
	    				.reduce( function (a, b) {
	                    return parseInt(a) + parseInt(b);
	                	}, 0 );
	            $( this.api().column( 1 ).footer() ).html(totalQantite);
	            
	    	}
	    } );
    	$('#table_argent').DataTable( {
	    	"footerCallback": function ( row, data, start, end, display ) {

	            totalMontant = this.api()
	    				.column(0, {search:'applied'})
	    				.data()
	    				.reduce( function (a, b) {
	                    return parseInt(a) + parseInt(b);
	                	}, 0 );
	            $( this.api().column( 0 ).footer() ).html(totalMontant);
	            
	    	}
	    });
    	$('#table_plantation').DataTable({
	    	"footerCallback": function ( row, data, start, end, display ) {

	            totalPlateaux = this.api()
	    				.column(2, {search:'applied'})
	    				.data()
	    				.reduce( function (a, b) {
	                    return parseInt(a) + parseInt(b);
	                	}, 0 );
	            $( this.api().column( 2 ).footer() ).html(totalPlateaux);

	            totalPrix = this.api()
	    				.column(3, {search:'applied'})
	    				.data()
	    				.reduce( function (a, b) {
	                    return parseFloat(a) + parseFloat(b);
	                	}, 0 );
	            $( this.api().column( 3 ).footer() ).html(totalPrix);
	            
	    	}
	    });
	   

	} );


	
</script>
<center>
<h2>Liste des commandes</h2>

<select id="type_cmd" onchange="
if (this.value == 1) {
    			$('#table_id_wrapper').show();
    			$('#table_argent_wrapper').hide();
    			$('#table_plantation_wrapper').hide();
    			$('#tous_table_wrapper').hide();
    		}else if (this.value == 2) {
    			$('#table_id_wrapper').hide();
    			$('#table_argent_wrapper').show();
    			$('#table_plantation_wrapper').hide();
    			$('#tous_table_wrapper').hide();
    		}else if (this.value == 3) {
    			$('#table_id_wrapper').hide();
    			$('#table_argent_wrapper').hide();
    			$('#table_plantation_wrapper').show();
    			$('#tous_table_wrapper').hide();
    		}
    		else if (this.value == 4) {
    			$('#table_id_wrapper').hide();
    			$('#table_argent_wrapper').hide();
    			$('#table_plantation_wrapper').hide();
    			$('#tous_table_wrapper').show();
    		}

" class="form-control col-sm-3">
	<option value="4">Tous</option>
	<option value="1">Les commandes</option>
	<option value="2">Les argents</option>
	<option value="3">Les plantations</option>
</select>

<table id="tous_table" class="table table-striped">
	<thead>
	<tr>
		<th>Article</th>
		<th>Quantité</th>
		<th>Prix total</th>
		<th>Remarque</th>
		<th>Nom de plante</th>
		<th>Type de plante</th>
		<th>Client</th>
		<th>Personnel</th>
		<th>Date d'opration</th>
	</tr>
	</thead>
	<tbody>
	<?php
		$manager = new ProductManager($db);
		foreach ($manager->getCmdList(NULL) as $value) {
			echo "<tr><td>" . $manager->get($value['productId'])->getLibelle() . "</td>";
			echo "<td>" . $value['quantite'] . "</td>";
			if($value['type'] == 'commande'){
				echo "<td>" . $value['prixVente'] * $value['quantite'] ."</td>";
			}else{
				echo "<td>" . $value['prixVente'] . "</td>";
			}
			echo "<td>" . $value['remarque'] . "</td>";
			echo "<td>" . $value['nom_plante'] . "</td>";
			echo "<td>" . $manager->getTypePlanteName($value['type_plante']) . "</td>";
			echo "<td>" . $manager->getClientName($value['client']) . "</td>";
			echo "<td>" . $manager->getPersonnelName($value['personnel']) . "</td>";
			echo "<td>" . $value['timedate'] . "</td></tr>";
			//echo "<td><a class='btn btn-info' href='add_product.php?id=""'>Modifier</a> <a class='btn btn-danger' href='delete.php?id=""'>Supprimer</a></td>";

		}
	?>
	</tbody>
	<tfoot>
		<tr>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
	</tfoot>
</table>

<table id="table_id" class="table table-striped">
	<thead>
	<tr>
		<th>Article</th>
		<th>Quantité</th>
		
		<th>Prix de vente</th>
		<th>Prix Total</th>
		<th>Client</th>
		<th>Personnel</th>
		<th>Date d'opration</th>
	</tr>
	</thead>
	<tbody>
	<?php
		$manager = new ProductManager($db);
		foreach ($manager->getCmdList('commande') as $value) {
			echo "<tr><td>" . $manager->get($value['productId'])->getLibelle() . "</td>";
			echo "<td>" . $value['quantite'] . "</td>";
			
			echo "<td>" . $value['prixVente'] . "</td>";
			echo "<td>" . $value['prixVente'] * $value['quantite'] . "</td>";
			echo "<td>" . $manager->getClientName($value['client']) . "</td>";
			echo "<td>" . $manager->getPersonnelName($value['personnel']) . "</td>";
			echo "<td>" . $value['timedate'] . "</td></tr>";
			//echo "<td><a class='btn btn-info' href='add_product.php?id=""'>Modifier</a> <a class='btn btn-danger' href='delete.php?id=""'>Supprimer</a></td>";

		}
	?>
	</tbody>
	<tfoot>
		<tr>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
	</tfoot>
</table>
<table id="table_argent" class="table table-striped">
	<thead>
	<tr>
		<th>Montant</th>
		<th>Remarque</th>
		<th>Client</th>
		<th>Personnel</th>
		<th>Date d'opration</th>
	</tr>
	</thead>
	<tbody>
	<?php
		$manager = new ProductManager($db);
		foreach ($manager->getCmdList('argent') as $value) {
			echo "<tr><td>" . $value['prixVente'] . "</td>";
			echo "<td>" . $value['remarque'] . "</td>";
			echo "<td>" . $manager->getClientName($value['client']) . "</td>";
			echo "<td>" . $manager->getPersonnelName($value['personnel']) . "</td>";
			echo "<td>" . $value['timedate'] . "</td></tr>";
			//echo "<td><a class='btn btn-info' href='add_product.php?id=""'>Modifier</a> <a class='btn btn-danger' href='delete.php?id=""'>Supprimer</a></td>";

		}
	?>
	</tbody>
	<tfoot>
		<tr>
			<td></td><td></td><td></td><td></td><td></td>
		</tr>
	</tfoot>
</table>
<table id="table_plantation" class="table table-striped">
	<thead>
	<tr>
		<th>Nom de plante</th>
		<th>Type de plante</th>
		
		<th>Nbre des plateaux</th>
		<th>Prix total</th>
		<th>Client</th>
		<th>Personnel</th>
		<th>Date d'opration</th>
	</tr>
	</thead>
	<tbody>
	<?php
		$manager = new ProductManager($db);
		foreach ($manager->getCmdList('plantation') as $value) {
			echo "<tr><td>" . $value['nom_plante'] . "</td>";
			echo "<td>" . $manager->getTypePlanteName($value['type_plante']) . "</td>";
			
			echo "<td>" . $value['quantite'] . "</td>";
			echo "<td>" . $value['prixVente'] . "</td>";
			echo "<td>" . $manager->getClientName($value['client']) . "</td>";
			echo "<td>" . $manager->getPersonnelName($value['personnel']) . "</td>";
			echo "<td>" . $value['timedate'] . "</td></tr>";
			//echo "<td><a class='btn btn-info' href='add_product.php?id=""'>Modifier</a> <a class='btn btn-danger' href='delete.php?id=""'>Supprimer</a></td>";

		}
	?>
	</tbody>
	<tfoot>
		<tr>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
	</tfoot>
</table>
</center>
</body>
</html>
<style type="text/css">
	#table_id_wrapper, #table_argent_wrapper, #table_plantation_wrapper {
		width: 90%;
		display: none;
	}
	#tous_table_wrapper {
		width: 90%;
	}
	#type_cmd{
		width: 20%;
		margin: 2%
	}
</style>