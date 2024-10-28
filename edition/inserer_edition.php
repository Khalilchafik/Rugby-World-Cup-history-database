<?php
include "../php_fichiers/init.php";
echo getDebutHTML("inserer_edition","../css/styles.css");
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	if (isset($_POST['edition_submit'])){
		$edition = array();
		$edition['edt_annee'] = $_POST['edt_annee'];
		$edition['edt_champion'] = $_POST['edt_champion'];
	    $edition['edt_nbr_participants'] = $_POST['edt_nbr_participants'];
		$edition['edt_budget'] = $_POST['edt_budget'];
		$edition['edt_mvp'] = $_POST['edt_mvp'];
		$edition['edt_spectateurs'] = $_POST['edt_spectateurs'];
		$edition['edt_matches'] = $_POST['edt_matches'];
		insererEdition($edition);
		?>
		<div class="container_inserer">
			<div class="container_erreur_succes">
				<span class="succes">
           	<img src="../icons/succes.png"  width="25px" height="25px" alt="succes_icon">
		Edition ajoutée avec succès!
				</span>
				<a href="edition_table.php" class="btn_table">
                <img src="../icons/tableau-de-donnees.png"  width="25px" height="25px" alt="tableau_icon">
                Revenir au tableau
            </a>
			</div>
			</div>
		<?php
	}
}
?>