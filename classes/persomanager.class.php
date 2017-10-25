<?php
spl_autoload_register(function($class){
	require 'classes/'.$class.'.class.php';
});

class persoManager{

	private $_pdo;

	const MAX = 100;

	public function __construct($host, $db, $user, $pass=null){
		try{
			$this->_pdo = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', $user, '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}
		catch(exception $e){ die('Erreur '.$e->getMessage()); }
	}




	public function createPerso($sql, $nom, $type){
		$data = $nom.','.$type;
		self::prepareInsert($sql, $data);
	}

	public function getAllPersos($sql){
		$persos = array();
		$res = self::prepareSelect($sql);
		foreach ($res as $key => $perso) {
			$persos[] = new Perso($perso);	
		}
		return $persos; 
	}

	public function getPerso($sql, $val){
		$res = self::prepareSelect($sql, $val);
		$perso = new Perso($res[0]);
		return $perso;
	}

	private function prepareSelect($sql, $val=null){
		$q = $this->_pdo->prepare($sql);
		$q->execute(array($val));
		$res = $q->fetchAll();
		return $res;
	}

	private function prepareInsert($sql, $data){

		$q = $this->_pdo->prepare($sql);
		$data = explode(',', $data);
		foreach ($data as $key => $value) {
			$q->bindValue($key+1, $value);
		} $q->execute();
	}

	private function prepareUpdate($sql, $val=null, $id){

		$q = $this->_pdo->prepare($sql);
		$q->execute(array($val, $id));
	}

	private function prepareDelete($sql, $id){

		$q = $this->_pdo->prepare($sql);
		$q->execute(array($id));
	}


	public function setDegats(Perso $advr){
		$att = mt_rand(0,25);

		if (isset($_POST['att']) && $_POST['att'] == '1') {

			$degats = $advr->getDegats();

			if ($degats + $att >= self::MAX) {
				$newDegats = self::MAX;
				$id = $advr->getId();
				self::prepareUpdate('UPDATE persos SET degats = ? WHERE id = ?', $newDegats, $id);
				return $dead = 1;
			}			

			if (($degats + $att) <= self::MAX) {
			
				$newDegats = $degats + $att;
				$id = $advr->getId();
				self::prepareUpdate('UPDATE persos SET degats = ? WHERE id = ?', $newDegats, $id);
				return $hit = 1;
			}
			else return $dead = 1;
		}
	}


	public function hitBack(Perso $perso)
    {
		$att = mt_rand(0,25);

		if (isset($_POST['rev']) && $_POST['rev'] == '1') {

			$degats = $perso->getDegats();

			if ($degats + $att >= self::MAX) {
				$newDegats = self::MAX;
				$id = $perso->getId();
				self::prepareUpdate('UPDATE persos SET degats = ? WHERE id = ?', $newDegats, $id);
				return 'dead';
			}

			if (($degats + $att) <= self::MAX) {
			
				$newDegats = $degats + $att;
				$id = $perso->getId();
				self::prepareUpdate('UPDATE persos SET degats = ? WHERE id = ?', $newDegats, $id);
				return 'hit';
			}
		}
	}

	public function deadHero($StatePerso, Perso $perso) // pas encore utilisé
    {

		if ($StatePerso = 'dead') {
			
			$id = $perso->getId();
			self::prepareDelete('DELETE FROM persos WHERE id = ?',  $id);
		}
	}



	
}