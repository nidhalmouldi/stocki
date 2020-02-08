<?php
/**
* 
*/
class Product
{
	private $id;
	private $reference;
	private $libelle;
	private $quantite;
	private $fournisseurId;
	private $prixAchat;
	private $prixVente;
	private $quantiteRestante;

	public function getId(){
		return $this->id;
	}
	public function getReference(){
		return $this->reference;
	}
	public function getLibelle(){
		return $this->libelle;
	}
	public function getQuantite(){
		return $this->quantite;
	}
	public function getQuantiteRestante(){
		return $this->quantiteRestante;
	}
	public function getFournisseurId(){
		return $this->fournisseurId;
	}
	public function getPrixAchat(){
		return $this->prixAchat;
	}
	public function getPrixVente(){
		return $this->prixVente;
	}

	public function setId($id)
	{
	    $id = (int) $id;
	    if ($id > 0)
	    {
	      $this->id = $id;
	    }
	}

	public function setReference($reference){
		$this->reference = $reference;
	}

	public function setLibelle($libelle){
		$this->libelle = $libelle;
	}
	public function setQuantite($quantite){
		$quantite = (int) $quantite;
		$this->quantite = $quantite;
	}
	public function setQuantiteRestante($quantiteRestante){
		$quantiteRestante = (int) $quantiteRestante;
		$this->quantiteRestante = $quantiteRestante;
	}
	public function setFournisseurId($fournisseurId){
		$this->fournisseurId = $fournisseurId;
	}
	public function setPrixAchat($prixAchat){
		$this->prixAchat = $prixAchat;
	}
	public function setPrixVente($prixVente){
		$this->prixVente = $prixVente;
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