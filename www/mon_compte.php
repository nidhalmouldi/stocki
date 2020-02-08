<?php
include 'inc.php';
require_once 'Manager/CompteManager.php';
require_once 'Entity/Compte.php';

$compteManager = new CompteManager($db);
$s = $compteManager->getSetting();
if(isset($_POST['submit_compte'])){
	
	$s->setNomSociete($_POST['nom_societe']);
	$s->setTelehone($_POST['telephone']);
	$s->setAddresse($_POST['addresse']);
	$s->setEmail($_POST['email']);
	if($compteManager->setSetting($s))
	{
		echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
	}else{
		echo "<script type='text/javascript'>alert('Veuillez vérifier les champs!');</script>";
	}
}
if(isset($_POST['submit_personnel'])){
	if($compteManager->addPersonnel($_POST['nom'], $_POST['telephone']))
	{
		echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
	}else{
		echo "<script type='text/javascript'>alert('Veuillez vérifier les champs!');</script>";
	}
}
?>
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="js/jquery.dataTables.js"></script>
<script type="text/javascript">
	$(document).ready( function () {
		$('#table_id').DataTable();
	});
</script>
<center><h2>Mon compte</h2></center>
<div class="col-md-6" style="margin-top: 5%">
	<form name="compte-form" action="" method="POST" class="form-horizontal">
		<div class="form-group">
			<label class="col-sm-4 control-label">Nom Société</label>
			<div class="col-sm-8">
		      	<input value="<?php echo $s->getNomSociete(); ?>" type="text" class="form-control" placeholder="Nom Société" name="nom_societe" >
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Téléphone</label>
			<div class="col-sm-8">
		      	<input value="<?php echo $s->getTelehone(); ?>" type="number" maxlength="8" max="99999999" class="form-control" placeholder="Téléphone" name="telephone" />
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Addresse</label>
			<div class="col-sm-8">
				<textarea type="textarea" class="form-control" placeholder="Addresse" name="addresse" ><?php echo $s->getAddresse(); ?></textarea>
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Email</label>
			<div class="col-sm-8">
		      	<input value="<?php echo $s->getEmail(); ?>" type="Email" class="form-control" placeholder="Email" name="email" />
		    </div>
		</div>
		<div class="form-group">
    		<div class="col-sm-offset-4 col-sm-6">
      			<input class="btn btn-success" type="submit" name="submit_compte" value="Enregistrer">
      			<input class="btn btn-danger" type="reset" value="Annuler">
    		</div>
  		</div>
	</form>
</div>
<div class="col-md-4 col-md-offset-1">
	<fieldset>
    <legend><small>Mes personnels</small></legend>
    <table class="table" id="table_id">
    	<thead>
    		<td>Nom</td>
    		<td>Téléphone</td>
    		<td></td>
    	</thead>
    	<tbody>
	<?php
		$manager = new ProductManager($db);
			foreach ($manager->getListPersonnel() as $value) {
				echo "<td>" . $value['nom'] . "</td>";
				echo "<td>" . $value['telephone'] . "</td>";
				echo "<td>
				<a class='btn btn-info' href='add_product.php?id=".$value['id']."'><span class='glyphicon glyphicon-pencil'></span></a> 
				<a class='btn btn-danger' href='delete.php?id=".$value['id']."'><span class='glyphicon glyphicon-remove'></span></a>
				</td></tr>";
			}
	?>
	</tbody>
    </table>	

</fieldset>
<input class="btn btn-success" type="submit" name="submit" value="Ajouter un nouveau personnel" data-toggle="modal" data-target="#myModal"/>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="" method="POST">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ajouter un nouveau personnel</h4>
      </div>
      <div class="modal-body">
      	<div class="form-horizontal">
        <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Nom</label>
		    <div class="col-sm-10">
		      <input type="text" name="nom" class="form-control" placeholder="Nom">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-2 control-label">Téléphone</label>
		    <div class="col-sm-10">
		      <input type="number" name="telephone" class="form-control" placeholder="Téléphone">
		    </div>
		  </div>
		  </div>
      </div>
      <div class="modal-footer">
        <input type="button" class="btn btn-default" data-dismiss="modal" value="Fermer" />
        <input class="btn btn-success" type="submit" name="submit_personnel" value="Enregister" />
      </div>
      </form>
      </div>
      </div>
    </div>

<script src="lib/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>