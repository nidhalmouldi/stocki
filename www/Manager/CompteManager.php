<?php
/**
* 
*/
class CompteManager
{
	private $db;
	function __construct($db)
	{
		$this->db = $db;
	}

	public function getSetting()
	{
	    $q = $this->db->query('SELECT nom_societe, telephone, email, addresse FROM setting WHERE id = 1');
	    $donnees = $q->fetchArray(SQLITE3_ASSOC);
	    if(count($donnees) > 0){
	    	$s = new Compte();
	    	$s->setNomSociete($donnees['nom_societe']);
	    	$s->setTelehone($donnees['telephone']);
	    	$s->setAddresse($donnees['addresse']);
	    	$s->setEmail($donnees['email']);
    		return $s;
	    }else{
	    	return FALSE;
	    }
	    	
	}

	public function setSetting($s){
		$q = $this->db->prepare('UPDATE setting SET nom_societe = :nom_societe, telephone = :telephone, addresse = :addresse, email = :email WHERE id = :id');

	    	$q->bindValue(':id', 1);
    		$q->bindValue(':nom_societe', $s->getNomSociete());
		    $q->bindValue(':telephone', $s->getTelehone());
		    $q->bindValue(':addresse', $s->getAddresse());
		    $q->bindValue(':email', $s->getEmail());
    		$q->execute();
    		return TRUE;
	}

	public function addPersonnel($nom, $telephone)
	{
			$q = $this->db->prepare("INSERT INTO personnel (nom, telephone) VALUES (:nom, :telephone)");
		    $q->bindValue(':nom', $nom);
		    $q->bindValue(':telephone', $telephone);
			$q->execute();
			return TRUE;
	}

}
?>