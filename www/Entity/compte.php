<?php
/**
* 
*/
class Compte
{
	private $nom_societe;
	private $telephone;
	private $addresse;
	private $email;

	public function getNomSociete(){
		return $this->nom_societe;
	}
	public function getTelehone(){
		return $this->telephone;
	}
	public function getAddresse(){
		return $this->addresse;
	}
	public function getEmail(){
		return $this->email;
	}

	public function setNomSociete($nom_societe){
		$this->nom_societe = $nom_societe;
	}

	public function setTelehone($telephone){
		$this->telephone = $telephone;
	}
	public function setAddresse($addresse){
		$this->addresse = $addresse;
	}
	public function setEmail($email){
		$this->email = $email;
	}

	public function hydrate(array $donnees)
	{
	  foreach ($donnees as $key => $value)
	  {
	    // On récupère le nom du setter correspondant à l'attribut.
	    $method = 'set'.ucfirst($key);
	        
	    // Si le setter correspondant existe.
	    if (method_exists($this, $method))
	    {
	      // On appelle le setter.
	      $this->$method($value);
	    }
	  }
	}
}
?>