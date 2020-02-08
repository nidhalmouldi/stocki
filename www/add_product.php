<?php
include 'inc.php';
$manager = new ProductManager($db);
if(isset($_GET['id'])){
	$p = $manager->get($_GET['id']);
}
?>
<div class="col-md-6 col-md-offset-3">
	<center><h2>Creation Produit</h2></center>
	<form name="product" action="" method="POST" class="form-horizontal">
		<div class="form-group">
			<label class="col-sm-3 control-label">Reference</label>
			<div class="col-sm-9">
		      	<input type="text" class="form-control" required="" name="reference" placeholder="Reference" value="<?php echo $p->getReference(); ?>">
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Libelle</label>
			<div class="col-sm-9">
		      	<input type="text" class="form-control" placeholder="Libelle" required="" name="libelle" value="<?php echo $p->getLibelle(); ?>">
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Quantite</label>
			<div class="col-sm-9">
		      	<input type="number" class="form-control" placeholder="Quantite" required="" name="quantite" value="<?php echo $p->getQuantite(); ?>">
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Fournisseur</label>
			<div class="col-sm-9">
		      	<select id="fournisseur_select" class="form-control" name="fournisseur" onchange="if(this.value == 0){$('#newfournisseur').show();}else{$('#newfournisseur').hide();}" >
		      		<option>- Choisir un fournisseur -</option>
		      		<?php 
		      			foreach ($manager->getListFournisseur() as $value) {
		      				$selected = ($value['id'] == $p->getFournisseurId()) ? ' selected="selected" ' : '';
		      				echo "<option ".$selected." value='".$value['id']."' >".$value['nom']."</option>";
		      			}
		      		?>
		      		<option value="0">Ajouter un nouveau fournisseur</option>
		      	</select>
		      	<input id="newfournisseur" type="text" class="form-control" placeholder="fournisseur" name="newfournisseur" >
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Prix d'achat</label>
			<div class="col-sm-9">
		      	<input type="number" class="form-control" placeholder="Prix d'achat" required="" name="prixAchat" value="<?php echo $p->getPrixAchat(); ?>">
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Prix de vente</label>
			<div class="col-sm-9">
		      	<input type="number" class="form-control" placeholder="Prix de vente" required="" name="prixVente" value="<?php echo $p->getPrixVente(); ?>">
		    </div>
		</div>
		<div class="form-group">
    		<div class="col-sm-offset-2 col-sm-10">
      			<input class="btn btn-success" type="submit" value="Ajouter article">
      			<input class="btn btn-danger" type="reset" value="Annuler">
    		</div>
  		</div>
	</form>
	</div>
	</body>
</html>
<script type="text/javascript">
	//document.getElementById("other").style.display = "none";
	$(document).ready( function () {
    	$('#newfournisseur').hide();
	} );
</script>
	
<?php
	if(isset($_POST['libelle']))
	{
		if(isset($_POST['newfournisseur']) && $_POST['newfournisseur'] != ''){
			$id_F = $manager->addFournisseur($_POST['newfournisseur']);
			$p->setFournisseurId($id_F);
		}else{
			$p->setFournisseurId($_POST['fournisseur']);
		}
		$p->setLibelle($_POST['libelle']) ;
		$p->setReference($_POST['reference']);
		$p->setQuantite($_POST['quantite']);
		$p->setPrixAchat($_POST['prixAchat']);
		$p->setPrixVente($_POST['prixVente']);
		
		if(isset($_GET['id'])){
			if($manager->update($p))
			{
				header('Location: '. 'product_list.php');
			}else{
				echo "<script type='text/javascript'>alert('Veuillez vérifier les champs!');</script>";
			}
		}else{
			if($manager->add($p))
			{
				echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
			}else{
				echo "<script type='text/javascript'>alert('Veuillez vérifier les champs!');</script>";
			}
		}
		
	}
?>