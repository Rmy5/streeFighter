<?php
spl_autoload_register(function($class){
	require 'classes/'.$class.'.class.php';
});

session_start();
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
	unset($_SESSION['S_F']);
	header('location: .');
}



$display = new displaySelect;
$pManager = new persoManager('localhost', 'streetfighter', 'root', '');
$persos = $pManager->getAllPersos('SELECT * FROM persos');
$display->validPerso(2, 'perso', $persos);
$display->validPerso(3, 'advr', $persos);
$display->validCreate(1);

?>
<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<title>S F</title>
	</head>
	<body>
		<main>
			<h1><em>Ready for Combat ?</em></h1><a href="?logout=1" id="log">Déconnexion</a><hr>

			<?php
//                Taitement du combat (si deux persos on été choisis)**********

				if (isset($_SESSION['S_F']['persoId']) && isset($_SESSION['S_F']['advrId'])) { 
					// var_dump($_SESSION);
					$perso = $pManager->getPerso('SELECT * FROM persos WHERE id = ?', $_SESSION['S_F']['persoId']);
					$advr = $pManager->getPerso('SELECT * FROM persos WHERE id = ?', $_SESSION['S_F']['advrId']);	
					$stateAdvr = $pManager->setDegats($advr);
					// echo $stateAdvr;
					$statePerso = $pManager->hitBack($perso);
					// echo $statePerso;
					// $pManager->deadHero($statePerso, $perso);
					// $pManager->deadHero($stateAdvr, $advr);

					// $perso->getImage('perso');
					// $advr->getImage('advr');

				?>
<!--               Affichage conditionnel html du combat (si deux persos sont en session)*****************-->

					<div id="glbWrap">
						<div id="wrapper">
							<div id="wrap1" class="wrap"><span id="plyr1"><?=$perso->getNom()?></span>
								<div class="jauge" id="jauge1" style="width: <?=$perso->getDegats()?>%;"></div>
							</div>

							<div id="wrap2" class="wrap"><span id="plyr2"><?=$advr->getNom()?></span>
								<div class="jauge" id="jauge2" style="width: <?=$advr->getDegats()?>%;"></div>
							</div>
						</div>

						<div id="perso" class="perso" style="background-image: url(images/<?=$perso->getType()?>.png) ;"></div>
						<div id="chat"></div>
						<div id="advr" class="perso" style="background-image: url(images/<?=$advr->getType()?>.png) ;"></div>


						 <form action="" method="POST">
							<button type="submit" name="att" value="1" id="att" class="attB">A l'attaque !</button>
							<button type="submit" name="rev" value="1" id="rep" class="attB">A l'attaque !</button>
						</form><hr>
					</div>

				<?php
				 var_dump($perso);
				 var_dump($advr);   }


//                Affichage du choix de l'adversaire*****************************

				if (isset($_SESSION['S_F']['persoId']) && !isset($_SESSION['S_F']['advrId'])) {
					$id = ($_SESSION['S_F']['persoId'] - 1);
					unset($persos[$id]);
					$display->displayForm(3,'Choisissez votre adversaire', 'displayObjects', $persos);

					var_dump($_SESSION);
				}

//                  Affichage conditionnel des menus de création de persos et de choix du persos****************

				if (!isset($_SESSION['S_F']['persoId'])) {


					$display->displayForm(1,'Créez des persos', 'displayImages');


					echo '<br><br>';


					$display->displayForm(2,'Choisissez votre perso', 'displayObjects', $persos);

					// var_dump($_POST);
					// var_dump($persos);
					// var_dump($_SESSION);
				}



					

			?>


		</main>
	</body>
</html>











