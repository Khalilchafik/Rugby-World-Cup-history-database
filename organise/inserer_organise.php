<?php
include "../php_fichiers/init.php";
echo getDebutHTML("insere_nation","../css/styles.css");
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	if (isset($_POST['organisation_submit'])){
		$organisation = array();
		$organisation['nat_id'] = $_POST['nat_id'] ;
		$organisation['edt_id'] = $_POST['edt_id'] ;
		insererOrganisation($organisation);
		?>
		<div class="container_inserer">
			<div class="container_erreur_succes">
				<span class="succes">
           	<img src="../icons/succes.png"  width="25px" height="25px" alt="">
		Organistion ajoutée avec succès!
				</span>
				<a href="organise_table.php" class="btn_table">
                <img src="../icons/tableau-de-donnees.png"  width="25px" height="25px" alt="tableau_icon">
                Revenir au tableau
            </a>
			</div>
			</div>
		<?php
	}
} 
echo getFinHTML();
?>