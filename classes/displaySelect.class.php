<?php
spl_autoload_register(function($class){
	require 'classes/'.$class.'.class.php';
});

class displaySelect{


	private $_err;
	private $_dir = 'images/pics';
	private $_imageList;





	public function displayForm($formNumber, $legend, $displayMethod, $src=null){
		
			echo '<form action="" method="POST" name="form'.$formNumber.'">
				<fieldset>
					<legend>'.$legend.' :</legend>
						Nom : <input type="text" name="nom'.$formNumber.'" maxlength="15" id="input'.$formNumber.'"><span class="msg">';
						echo $this->displayErr($formNumber);
						echo '</span>
						<input type="submit" name="sub'.$formNumber.'" value="OK" class="sub">';
						echo '<span class="msg2"></span>';
						$this->{$displayMethod}($formNumber, $src);
				echo '</fieldset></form>';	
	}



	public function displayImages($formNumber){

		$this->_imageList = scandir($this->_dir);
		unset($this->_imageList[0], $this->_imageList[1]);
		$this->_imageList = array_values($this->_imageList);
		
		
		echo'<div class="pics" id="pic1">'; 
			foreach ($this->_imageList as $key => $image) {
				echo '<input type="radio" name="radio'.$formNumber.'" id="p'.$key.'" value="'.$key.'"><label class="pic" for="p'.$key.'" style="background-image: url(images/pics/'.$key.'.png)" ></label>';	
			}
		echo '</div>';
	}

	public function displayObjects($formNumber, array $src){

		echo'<div id="picS">'; 
			foreach ($src as $key => $p) {
				$id = $p->getId();
				echo '<input type="radio" name="radio'.$formNumber.'" id="s'.$id.'" value="'.$id.'"><label class="pic" for="s'.$id.'" style="background-image: url(images/pics/'.$p->getType().'.png)"><h5 class="name2">'.$p->getNom().'</h5></label>';	
			}
		echo '</div>';
	}


	public function displayErr($formNumber){
		if (isset($this->_err[$formNumber])) {
			return $this->_err[$formNumber];
		}
	}




	public function validCreate($formNumber){
		$pManager = new persoManager('localhost', 'streetfighter', 'root');

		if (isset($_POST['sub'.$formNumber])){
			if (isset($_POST['nom'.$formNumber]) && $_POST['nom'.$formNumber] != '' && isset($_POST['radio'.$formNumber])) {
					$nom = htmlentities($_POST['nom'.$formNumber]);
					$type = htmlentities($_POST['radio'.$formNumber]);
					$pManager->createPerso('INSERT INTO persos(nom, type) VALUES (?, ?)', $nom, $type);
			}
			else $this->_err[$formNumber] = 'Choisissez un nom de perso et une image';
		}
	}

	public function validPerso($formNumber, $cleSession, $persos){

		if (isset($_POST['sub'.$formNumber])) {

			if (isset($_POST['radio'.$formNumber])) {
				$radio = (int)htmlentities($_POST['radio'.$formNumber]);
				$_SESSION['S_F'][$cleSession.'Id'] = ($radio);
			}

			if (isset($_POST['nom'.$formNumber]) && !is_null($_POST['nom'.$formNumber]) && !isset($_SESSION['S_F']['persoId'])) {
				$nom = htmlentities($_POST['nom'.$formNumber]);
				foreach ($persos as $key => $p) {
					if ($p->getNom() == $nom) {
						$_SESSION['S_F'][$cleSession.'Id'] = $p->getId();
						break;
					}
					
				}
				if (!isset($_SESSION['S_F'][$cleSession.'Id'])) $this->_err[2] = 'Aucun perso trouvé avec ce nom';
			}	
		}
	}





	// public function startImage(int $p){

	// 	if (isset($_SESSION['S_F']['plyr'.$p])) {
	// 		echo '<div class="spWrap"><h5 class="name">'.$_SESSION['S_F']['nom'.$p].'</h5><div class="startPic" style="background-image: url(images/pics/'.$_SESSION['S_F']['plyr'.$p].'.png)"></div></div>';
	// 		echo '<style>.name{display:inline-block;margin:auto;}<style>';
	// 	}
	// }




	


}












