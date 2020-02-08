<?php
/**
* 
*/
class ProductManager
{
	private $db;
	function __construct($db)
	{
		$this->db = $db;
	}

	public function updateProductQuantite($productId, $qte){
		$p = $this->get($productId);
		if($qte > $p->getQuantiteRestante()){
			return FALSE;
		}else{
	    	$q = $this->db->prepare('UPDATE product SET quantiteRestante = :quantiteRestante WHERE id = :id');

	    	$q->bindValue(':id', $productId);
		    $q->bindValue(':quantiteRestante', $p->getQuantiteRestante() - $qte);
    		$q->execute();
    		return TRUE;
    	}
	}

	public function addCommande($type, $productId, $qte, $prixVente, $client, $personnel, $montant, $remarque, $type_plante, $nom_plante, $prix_unitaire){
			$q = $this->db->prepare("INSERT INTO commande (type, productId, quantite, prixVente, client, personnel, remarque, type_plante, nom_plante, prix_unitaire, timedate) VALUES (:type, :productId, :quantite, :prixVente, :client, :personnel, :remarque, :type_plante, :nom_plante, :prix_unitaire, :timedate)");
			var_dump($remarque);
		    $q->bindValue(':type', $type);
		    $q->bindValue(':productId', $productId);
		    $q->bindValue(':quantite', $qte);
		    $q->bindValue(':prixVente', $prixVente);
		    $q->bindValue(':client', $client);
		    $q->bindValue(':personnel', $personnel);
		    $q->bindValue(':remarque', $remarque);
		    $q->bindValue(':type_plante', $type_plante);
		    $q->bindValue(':nom_plante', $nom_plante);
		    $q->bindValue(':prix_unitaire', $prix_unitaire);
		    $q->bindValue(':timedate', date("Y-m-d H:i"));
			if(isset($productId)){
				if($this->updateProductQuantite($productId, $qte)){
					$q->execute();
					return TRUE;
				}else{
					return FALSE;
				}
			}else{
				$q->execute();
				return TRUE;
			}


			
	}

	public function addFournisseur($nom)
	{
			$q = $this->db->prepare("INSERT INTO fournisseur (Nom) VALUES (:nom)");
		    $q->bindValue(':nom', $nom);
			$q->execute();
			return $this->db->lastInsertRowID();
	}
	public function addClient($nom)
	{
			$q = $this->db->prepare("INSERT INTO client (Nom) VALUES (:nom)");
		    $q->bindValue(':nom', $nom);
			$q->execute();
			return $this->db->lastInsertRowID();
	}
	public function addPersonnel($nom)
	{
			$q = $this->db->prepare("INSERT INTO personnel (Nom) VALUES (:nom)");
		    $q->bindValue(':nom', $nom);
			$q->execute();
			return $this->db->lastInsertRowID();
	}

	public function add(Product $p)
	{
		if($p->getPrixAchat() > $p->getPrixVente()){
			return FALSE;
		}else{
			$q = $this->db->prepare("INSERT INTO product (reference, libelle, quantite, fournisseurId, prixAchat, prixVente, quantiteRestante) VALUES (:reference, :libelle, :quantite, :fournisseurId, :prixAchat, :prixVente, :quantiteRestante)");
		    $q->bindValue(':libelle', $p->getLibelle());
		    $q->bindValue(':reference', $p->getReference());
		    $q->bindValue(':quantite', $p->getQuantite());
		    $q->bindValue(':fournisseurId', $p->getFournisseurId());
		    $q->bindValue(':prixAchat', $p->getPrixAchat());
		    $q->bindValue(':prixVente', $p->getPrixVente());
		    $q->bindValue(':quantiteRestante', $p->getQuantite());

			$q->execute();
			return TRUE;
		}
	    
	}

	public function delete(Product $p)
	{
	    $this->db->exec('DELETE FROM product WHERE id = ' . $p->getId());
	}

	public function get($id)
	{
	    $id = (int) $id;
	    $q = $this->db->query('SELECT id, reference, libelle, quantite, fournisseurId, prixAchat, prixVente, quantiteRestante FROM product WHERE id = '.$id);
	    $donnees = $q->fetchArray(SQLITE3_ASSOC);
	    if(count($donnees) > 0){
	    	$p = new Product();
	    	$p->setId($donnees['Id']);
	    	$p->setLibelle($donnees['Libelle']);
	    	$p->setReference($donnees['reference']);
	    	$p->setQuantite($donnees['quantite']);
	    	$p->setQuantiteRestante($donnees['quantiteRestante']);
	    	$p->setFournisseurId($donnees['fournisseurId']);
	    	$p->setPrixAchat($donnees['prixAchat']);
	    	$p->setPrixVente($donnees['prixVente']);
    		return $p;
	    }else{
	    	return FALSE;
	    }
	    	
	}

	public function getTypePlanteName($value)
	{
	    if($value == 1){
	    	return 'Plantes intérieurs';
	    }elseif ($value == 2) {
	    	return 'Plantes extérieurs';
	    }
	}

	public function getFournisseurName($id)
	{
	    $id = (int) $id;
	    $q = $this->db->query('SELECT id, Nom FROM fournisseur WHERE id = '.$id);
	    $donnees = $q->fetchArray(SQLITE3_ASSOC);
    	return $donnees['Nom'];
	}

	public function getListFournisseur()
	{
	    $q = $this->db->query('SELECT id, Nom FROM fournisseur');
	    $f = array();
	    while($donnees = $q->fetchArray(SQLITE3_ASSOC)){
	    	$f[] = array('id' => $donnees['Id'], 'nom' => $donnees['Nom']);
	    };
	    return $f;
	}
	public function getClientName($id)
	{
	    $id = (int) $id;
	    $q = $this->db->query('SELECT id, Nom FROM client WHERE id = '.$id);
	    $donnees = $q->fetchArray(SQLITE3_ASSOC);
    	return $donnees['Nom'];
	}

	public function getListClient()
	{
	    $q = $this->db->query('SELECT id, Nom FROM client');
	    $f = array();
	    while($donnees = $q->fetchArray(SQLITE3_ASSOC)){
	    	$f[] = array('id' => $donnees['Id'], 'nom' => $donnees['Nom']);
	    };
	    return $f;
	}
	public function getPersonnelName($id)
	{
	    $id = (int) $id;
	    $q = $this->db->query('SELECT id, Nom,  FROM personnel WHERE id = '.$id);
	    $donnees = $q->fetchArray(SQLITE3_ASSOC);
    	return $donnees['Nom'];
	}

	public function getListPersonnel()
	{
	    $q = $this->db->query('SELECT id, nom, telephone FROM personnel');
	    $f = array();
	    while($donnees = $q->fetchArray(SQLITE3_ASSOC)){
	    	$f[] = ['id' => $donnees['id'], 'nom' => $donnees['nom'], 'telephone' => $donnees['telephone']];
	    };
	    return $f;
	}

	public function getList()
	{
	    $q = $this->db->query('SELECT id, reference, libelle, quantite, fournisseurId, prixAchat, prixVente, quantiteRestante FROM product');
	    while($donnees = $q->fetchArray(SQLITE3_ASSOC)){
	    	$p = new Product();
	    	$p->setId($donnees['Id']);
	    	$p->setLibelle($donnees['Libelle']);
	    	$p->setReference($donnees['reference']);
	    	$p->setQuantite($donnees['quantite']);
	    	$p->setQuantiteRestante($donnees['quantiteRestante']);
	    	$p->setFournisseurId($donnees['fournisseurId']);
	    	$p->setPrixAchat($donnees['prixAchat']);
	    	$p->setPrixVente($donnees['prixVente']);
	    	$products[] = $p;
	    };
	    if(isset($products)){
	    	return $products;
	    }else{
	    	return array();
	    }
	    
	}

	public function getCmdList($type)
	{
	    $q = $this->db->query('SELECT id, type, productId, quantite, prixVente, client, personnel, montant, remarque, type_plante, nom_plante, prix_unitaire, timedate FROM commande');
	    $cmds = array();
	    while($donnees = $q->fetchArray(SQLITE3_ASSOC)){
	    	if(isset($type)){
		    	if($donnees['type'] == $type){
		    		$cmd = array();
			    	$cmd['id'] = $donnees['id'];
			    	$cmd['type'] = $donnees['type'];
			    	$cmd['productId'] = $donnees['productId'];
			    	$cmd['quantite'] = $donnees['quantite'];
			    	$cmd['prixVente'] = $donnees['prixVente'];
			    	$cmd['client'] = $donnees['client'];
			    	$cmd['personnel'] = $donnees['personnel'];
			    	$cmd['montant'] = $donnees['montant'];
			    	$cmd['remarque'] = $donnees['remarque'];
			    	$cmd['type_plante'] = $donnees['type_plante'];
			    	$cmd['nom_plante'] = $donnees['nom_plante'];
			    	$cmd['prix_unitaire'] = $donnees['prix_unitaire'];
			    	$cmd['timedate'] = $donnees['timedate'];

			    	$cmds[] = $cmd;
		    	}
	    	}else{
	    		$cmd = array();
			    	$cmd['id'] = $donnees['id'];
			    	$cmd['type'] = $donnees['type'];
			    	$cmd['productId'] = $donnees['productId'];
			    	$cmd['quantite'] = $donnees['quantite'];
			    	$cmd['prixVente'] = $donnees['prixVente'];
			    	$cmd['client'] = $donnees['client'];
			    	$cmd['personnel'] = $donnees['personnel'];
			    	$cmd['montant'] = $donnees['montant'];
			    	$cmd['remarque'] = $donnees['remarque'];
			    	$cmd['type_plante'] = $donnees['type_plante'];
			    	$cmd['nom_plante'] = $donnees['nom_plante'];
			    	$cmd['prix_unitaire'] = $donnees['prix_unitaire'];
			    	$cmd['timedate'] = $donnees['timedate'];

			    	$cmds[] = $cmd;
	    	}

	    };
	    return $cmds;
	}

	public function update(Product $p)
	{
		if($p->getPrixAchat() > $p->getPrixVente()){
			return FALSE;
		}else{
	    	$q = $this->db->prepare('UPDATE product SET reference = :reference, libelle = :libelle, quantite = :quantite, fournisseurId = :fournisseurId, prixAchat = :prixAchat, prixVente = :prixVente WHERE id = :id');

	    	$q->bindValue(':id', $p->getId());
    		$q->bindValue(':libelle', $p->getLibelle());
		    $q->bindValue(':reference', $p->getReference());
		    $q->bindValue(':quantite', $p->getQuantite());
		    $q->bindValue(':fournisseurId', $p->getFournisseurId());
		    $q->bindValue(':prixAchat', $p->getPrixAchat());
		    $q->bindValue('prixVente', $p->getPrixVente());
    		$q->execute();
    		return TRUE;
    	}
	}

}
?>