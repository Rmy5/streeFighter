<?php


class Perso{
	
	private $_id;
	private $_nom;
	private $_type;
	private $_degats;

	

	public function __construct(array $donnees){

		$this->hydrate($donnees);
	}

	public function hydrate(array $donnees){

		foreach ($donnees as $key => $val) {
			$method = 'set'.ucfirst($key);

			if (method_exists($this, $method)) {
				$this->{$method}($val);
			}
		}
	}
	public function getid(){

		return $this->_id;
	}

	public function setId($id){

		$id = (string)$id;
		$this->_id = $id;
	}

	public function getNom(){

		return $this->_nom;
	}

	public function setNom($nom){

		$nom = (string)$nom;
		$this->_nom = $nom;
	}

	public function getType(){

		return $this->_type;
	}

	public function setType($type){

		$type = (int)$type;
		$this->_type = $type;
	}

	public function getDegats(){

		return $this->_degats;
	}

	public function setDegats($degats){

		$degats = (int)$degats;
		$this->_degats = $degats;
	}

	
}


















