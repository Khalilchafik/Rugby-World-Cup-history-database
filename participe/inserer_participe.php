<?php
include_once "../php_fichiers/init.php";
echo getDebutHTML("inserer_participe","../css/styles.css");
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	if (isset($_POST['participation_submit'])){
		$participation = array();
		$participation['nat_id'] = $_POST['nat_id'] ;
		$participation['edt_id'] = $_POST['edt_id'] ;
		$participation['matches_joues'] = $_POST['matches_joues'] ;
		if ($_POST['resultat'] == 'Champion' ){
			$check_champ = check_champion( $_POST['edt_id']);
			if ($check_champ == 0){
				$participation["resultat"] = $_POST["resultat"];
				insererParticipation($participation);
				?>
		<div class="container_inserer">
			<div class="container_erreur_succes">
				<span class="succes">
           	<img src="../icons/succes.png"  width="25px" height="25px" alt="succes_icon">
		Participation ajoutée avec succès!
				</span>
				<a href="participe_table.php" class="btn_table">
                <img src="../icons/tableau-de-donnees.png"  width="25px" height="25px" alt="tableau_icon">
                Revenir au tableau
            </a>
			</div>
			</div>
		<?php
			}else{?>
			<div class="container_inserer">
			<div class="container_erreur_succes">
				<span class="erreur">
           	<img src="../icons/erreur.png"  width="25px" height="25px" alt="erreur_icon">
             Attention!! Champion dèja existant.
				</span>
				<a href="participe_table.php" class="btn_table">
                <img src="../icons/tableau-de-donnees.png"  width="25px" height="25px" alt="tableau_icon">
                Revenir au tableau
            </a>
			</div>
			</div>
                <?php
			}
		}else{
			$participation["resultat"] = $_POST["resultat"];
			insererParticipation($participation);
			?>
		<div class="container_inserer">
			<div class="container_erreur_succes">
				<span class="succes">
           	<img src="../icons/succes.png"  width="25px" height="25px" alt="succes_icon">
		Participation ajoutée avec succès!
				</span>
				<a href="participe_table.php" class="btn_table">
                <img src="../icons/tableau-de-donnees.png"  width="25px" height="25px" alt="tableau_icon">
                Revenir au tableau
            </a>
			</div>
			</div>
		<?php
		}
	}
}
echo getFinHTML();
?>