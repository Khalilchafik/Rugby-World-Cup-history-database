<?php
include "..\php_fichiers/init.php";
echo getDebutHTML("inserer_nation","../css/styles.css");
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST['nation_submit'])){
		$nation = array();
		$nation['nat_nom'] = $_POST['nat_nom'];
		$nation['nat_titre'] = $_POST['nat_titre'];
		$nation['nat_continent'] = $_POST['nat_continent'];
		$nation['nat_participation'] = $_POST['nat_participation'];
		$nation['nat_classement'] = $_POST['nat_classement'];
		$nation['nat_surnom'] = $_POST['nat_surnom'];
		insererNation($nation);?>
		<div class="container_inserer">
			<div class="container_erreur_succes">
				<span class="succes">
           	<img src="../icons/succes.png"  width="25px" height="25px" alt="succes_icon">
		Nation ajoutée avec succès!
				</span>
				<a href="nation_table.php" class="btn_table">
                <img src="../icons/tableau-de-donnees.png"  width="25px" height="25px" alt="table_icon">
                Revenir au tableau
            </a>
			</div>
			</div>
		<?php
	}
}
echo getFinHTML();
?>