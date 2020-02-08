<?php
include 'inc.php';
$manager = new ProductManager($db);
if(isset($_GET['id'])){
	$p = $manager->get($_GET['id']);
}
?>
<center><h2>Passer une commande</h2></center>
<div class="col-md-4">
	<fieldset>
    <legend><small>Les commandes</small></legend>
	<form name="product-form" action="" method="POST" class="form-horizontal">
		<div class="form-group" style="display: none;">
			<label class="col-sm-4 control-label">Type</label>
			<div class="col-sm-8">
		      	<input value="commande" type="text" class="form-control" placeholder="Reference" required="" name="type" >
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Article</label>
			<div class="col-sm-8">
				<select name="product" class="form-control" id="listProduits" onchange="getProduct();">
					<option>- Choisir un produit -</option>
					<?php
						foreach ($manager->getList() as $value) {
							echo "<option value='".$value->getId()."' data-prixVente='".$value->getPrixVente()."' data-reference='".$value->getReference()."' >".$value->getLibelle()."</option>";
						}
					?>
				</select>
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Reference</label>
			<div class="col-sm-8">
		      	<input id="reference" type="text" class="form-control" placeholder="Reference" required="" name="reference" >
		    </div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-4 control-label">Quantite</label>
			<div class="col-sm-8">
		      	<input type="number" class="form-control" placeholder="Quantite" required="" name="quantite">
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Client</label>
			<div class="col-sm-8">
		      	<select class="form-control" name="client" onchange="if(this.value == 0){$('#newclient').show();}else{$('#newclient').hide();}" >
		      		<option>- Choisir un client -</option>
		      		<?php 
		      			foreach ($manager->getListClient() as $value) {
		      				echo "<option value='".$value['id']."' >".$value['nom']."</option>";
		      			}
		      		?>
		      		<option value="0">Ajouter un nouveau client</option>
		      	</select>
		      	<input id="newclient" type="text" class="form-control" placeholder="Client" name="newclient" >
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Personnel</label>
			<div class="col-sm-8">
		      	<select class="form-control" name="personnel" onchange="if(this.value == 0){$('#newpersonnel').show();}else{$('#newpersonnel').hide();}" >
		      		<option>- Choisir un personnel -</option>
		      		<?php 
		      			foreach ($manager->getListPersonnel() as $value) {
		      				echo "<option value='".$value['id']."' >".$value['nom']."</option>";
		      			}
		      		?>
		      		<option value="0">Ajouter un nouveau personnel</option>
		      	</select>
		      	<input id="newpersonnel" type="text" class="form-control" placeholder="Personnel" name="newpersonnel" >
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Prix de vente</label>
			<div class="col-sm-8">
		      	<input id="prixVente" type="number" class="form-control" placeholder="Prix de vente" required="" name="prixVente" value="<?php echo $p->getPrixVente(); ?>">
		    </div>
		</div>
		<div class="form-group">
    		<div class="col-sm-offset-2 col-sm-10">
      			<input class="btn btn-success" type="submit" value="Ajouter commande">
      			<input class="btn btn-danger" type="reset" value="Annuler">
    		</div>
  		</div>
	</form>
</fieldset>
</div>
<div class="col-md-4">
	<fieldset>
    <legend><small>Argent</small></legend>
	<form name="product-form" action="" method="POST" class="form-horizontal">
		<div class="form-group" style="display: none;">
			<label class="col-sm-4 control-label">Type</label>
			<div class="col-sm-8">
		      	<input value="argent" type="text" class="form-control" placeholder="Reference" required="" name="type" >
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Client</label>
			<div class="col-sm-8">
		      	<select class="form-control" name="client" onchange="if(this.value == 0){$('#newclient1').show();}else{$('#newclient1').hide();}" >
		      		<option>- Choisir un client -</option>
		      		<?php 
		      			foreach ($manager->getListClient() as $value) {
		      				echo "<option value='".$value['id']."' >".$value['nom']."</option>";
		      			}
		      		?>
		      		<option value="0">Ajouter un nouveau client</option>
		      	</select>
		      	<input id="newclient1" type="text" class="form-control" placeholder="Client" name="newclient" >
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Montant</label>
			<div class="col-sm-8">
		      	<input type="text" class="form-control" placeholder="Montant" required="" name="prixVente" >
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Remarque</label>
			<div class="col-sm-8">
		      	<textarea class="form-control" rows="4" cols="40" name="remarque_montant"></textarea>
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Personnel</label>
			<div class="col-sm-8">
		      	<select class="form-control" name="personnel" onchange="if(this.value == 0){$('#newpersonnel1').show();}else{$('#newpersonnel1').hide();}" >
		      		<option>- Choisir un personnel -</option>
		      		<?php 
		      			foreach ($manager->getListPersonnel() as $value) {
		      				echo "<option value='".$value['id']."' >".$value['nom']."</option>";
		      			}
		      		?>
		      		<option value="0">Ajouter un nouveau personnel</option>
		      	</select>
		      	<input id="newpersonnel1" type="text" class="form-control" placeholder="Personnel" name="newpersonnel" >
		    </div>
		</div>
		<div class="form-group">
    		<div class="col-sm-offset-2 col-sm-10">
      			<input class="btn btn-success" type="submit" value="Ajouter commande">
      			<input class="btn btn-danger" type="reset" value="Annuler">
    		</div>
  		</div>
	</form>
</fieldset>
</div>
<div class="col-md-4">
	<fieldset>
    <legend><small>Plantation</small></legend>
	<form name="product-form" action="" method="POST" class="form-horizontal">
		<div class="form-group" style="display: none;">
			<label class="col-sm-4 control-label">Type</label>
			<div class="col-sm-8">
		      	<input value="plantation" type="text" class="form-control" placeholder="Type" required="" name="type" >
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Client</label>
			<div class="col-sm-8">
		      	<select class="form-control" name="client" onchange="if(this.value == 0){$('#newclient2').show();}else{$('#newclient2').hide();}" >
		      		<option>- Choisir un client -</option>
		      		<?php 
		      			foreach ($manager->getListClient() as $value) {
		      				echo "<option value='".$value['id']."' >".$value['nom']."</option>";
		      			}
		      		?>
		      		<option value="0">Ajouter un nouveau client</option>
		      	</select>
		      	<input id="newclient2" type="text" class="form-control" placeholder="Client" name="newclient" >
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Type de plante</label>
			<div class="col-sm-8">
		      	<select class="form-control" name="type_plante" onchange="if(this.value == 1){$('#nb_plantes').val(198);} else if(this.value == 2){$('#nb_plantes').val(228);}" >
		      		<option>- Choisir un type -</option>
		      		<option value="1">Plantes intérieurs</option>
		      		<option value="2">Plantes extérieurs</option>
		      	</select>
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Nom de plante</label>
			<div class="col-sm-8">
		      	<input type="text" class="form-control" placeholder="Nom de plante" required="" name="nom_plante" >
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Prix unitaire</label>
			<div class="col-sm-8">
		      	<input id="prix_unitaire" type="text" class="form-control" placeholder="Prix unitaire" required="" name="prix_unitaire" onkeyup="calculeprix();" >
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Nb des plateaux</label>
			<div class="col-sm-8">
		      	<input id="nb_plateaux" type="text" class="form-control" placeholder="Nbre des plateaux" required="" name="quantite" onkeyup="calculeprix();">
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Nb des plantes</label>
			<div class="col-sm-8">
		      	<input id="nb_plantes" type="text" class="form-control" placeholder="Nbre des plantes" required="" name="nb_plantes" readonly="" onkeyup="calculeprix();" >
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Prix total</label>
			<div class="col-sm-8">
		      	<input id="prix_total" type="text" class="form-control" placeholder="Prix total" required="" name="prixVente" readonly="" >
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Personnel</label>
			<div class="col-sm-8">
		      	<select class="form-control" name="personnel" onchange="if(this.value == 0){$('#newpersonnel2').show();}else{$('#newpersonnel2').hide();}" >
		      		<option>- Choisir un personnel -</option>
		      		<?php 
		      			foreach ($manager->getListPersonnel() as $value) {
		      				echo "<option value='".$value['id']."' >".$value['nom']."</option>";
		      			}
		      		?>
		      		<option value="0">Ajouter un nouveau personnel</option>
		      	</select>
		      	<input id="newpersonnel2" type="text" class="form-control" placeholder="Personnel" name="newpersonnel" >
		    </div>
		</div>
		<div class="form-group">
    		<div class="col-sm-offset-2 col-sm-10">
      			<input class="btn btn-success" type="submit" value="Ajouter commande">
      			<input class="btn btn-danger" type="reset" value="Annuler">
    		</div>
  		</div>
	</form>
</fieldset>
</div>
</body>
</html>
<script type="text/javascript">
	//document.getElementById("other").style.display = "none";
	function calculeprix(){
		$("#prix_total").val($("#prix_unitaire").val() * $("#nb_plateaux").val() * $("#nb_plantes").val() );
	}
	function getProduct(p){
		var sel = document.getElementById('listProduits');
		var selected = sel.options[sel.selectedIndex];
		var prixVente = selected.getAttribute('data-prixVente');
		var reference = selected.getAttribute('data-reference');
		$("#prixVente").val(prixVente);
		$("#reference").val(reference);
	}
	$(document).ready( function () {
    	$('#newclient').hide();
    	$('#newpersonnel').hide();
    	$('#newclient1').hide();
    	$('#newpersonnel1').hide();
    	$('#newclient2').hide();
    	$('#newpersonnel2').hide();
	} );
</script>
<?php
	if(isset($_POST['type']))
	{
		if(isset($_POST['newclient']) && $_POST['newclient'] != ''){
			$client = $manager->addClient($_POST['newclient']);
		}else{
			$client = $_POST['client'];
		}
		if(isset($_POST['newpersonnel']) && $_POST['newpersonnel'] != ''){
			$personnel = $manager->addPersonnel($_POST['newpersonnel']);
		}else{
			$personnel = $_POST['personnel'];
		}
		if($_POST['type'] == 'commande'){
			if($manager->addCommande($_POST['type'], $_POST['product'], $_POST['quantite'], $_POST['prixVente'], $_POST['client'], $_POST['personnel'], NULL, NULL, NULL, NULL, NULL))
			{
				echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
			}else{
				echo "<script type='text/javascript'>alert('Veuillez vérifier les champs!');</script>";
			}
		}elseif ($_POST['type'] == 'argent') {
			if($manager->addCommande($_POST['type'], NULL, NULL, $_POST['prixVente'], $_POST['client'], $_POST['personnel'], NULL, $_POST['remarque_montant'], NULL, NULL, NULL))
			{
				echo "<script type='text/javascript'>alert('submitted successfully! ')</script>";
			}else{
				echo "<script type='text/javascript'>alert('Veuillez vérifier les champs!');</script>";
			}
		}elseif ($_POST['type'] == 'plantation') {
			if($manager->addCommande($_POST['type'], NULL, $_POST['quantite'], $_POST['prixVente'], $_POST['client'], $_POST['personnel'], NULL, NULL, $_POST['type_plante'], $_POST['nom_plante'], $_POST['prix_unitaire']))
			{
				echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
			}else{
				echo "<script type='text/javascript'>alert('Veuillez vérifier les champs!');</script>";
			}
		}
	}else{

	}
?>