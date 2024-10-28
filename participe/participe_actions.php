<?php
include "../php_fichiers/init.php";
echo getDebutHTML("participe_actions","../css/styles.css");
$do = isset( $_GET['do'] ) ? $_GET['do'] :'';
if( $do == ''){
    header('location:participe_table.php');
    exit();
}
elseif( $do == 'modifier'){
    if( isset( $_GET['id'] )){
        $id = $_GET['id'];
        $fullId = explode('_', $_GET['id']);
    $result_edition = getEditionById($fullId[1]);
    $result_nation = getNationById($fullId[0]);
    $id= $_GET['id'];
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_update"])) {
        $participe = array();
        $participe["nat_id"] = $fullId[0];
		$participe['edt_id'] = $fullId[1];
		$participe['matches_joues'] = $_POST['matches_joues'];
		if ($_POST['resultat'] == 'Champion' ){
			$check_champ = check_champion( $fullId[1]);
			if ($check_champ == 0){
				$participe["resultat"] = $_POST["resultat"];
				updateParticipation($participe);
				header('location:participe_table.php');
				exit();
			}else{?>
            <div class="container_erreur_succes">
              <span class="erreur"> <img src="../icons/erreur.png"  width="25px" height="25px" alt="erreur_icon">
              Attention!! Champion dèja existant.
              </span>
            </div>
                <?php
			}
		}else{
			$participe["resultat"] = $_POST["resultat"];
			updateParticipation($participe);
			header('location:participe_table.php');
			exit();
		}
    }
    ?>
<div class="container">
    <div class="text">
        Modifier une participation
    </div>
    <form action="?do=modifier&id=<?php echo $id?>" method="post">
        <div class="input">
            <label for="Nation">Nation</label>
            <select name="nat_id" disabled> 
                <?php
                    echo '<option value="'.$result_nation['nat_id'].'">'.$result_nation['nat_nom'].'</option>';
                ?>
            </select>
        </div>
        <div class="input">
            <label for="Edition">Edition</label>
            <select name="edt_id" disabled>
                <?php
                    echo '<option value="'.$result_edition['edt_id'].'">'.$result_edition['edt_annee'].'</option>';
                ?>
            </select>
        </div>
        <div class="input">
            <label for="matches_joues">Matches joués</label>
            <input type="number" name="matches_joues" required>
        </div>
        <div class="input">
            <label for="résultat">résultat</label>
            <select name="resultat" required>
                <!-- une contrainte check sur le résultat -->
                <option value="" readonly>Choisissez un résultat</option>
                <option value="premier tour">Premier tour</option>
                <option value="Quart de finale">Quart de finale</option>
                <option value="Demi-finaliste">Demi-finaliste</option>
                <option value="finaliste">Finaliste</option>
                <option value="Champion">Champion</option>
            </select>
        </div>
        <br>
        <div class="submit_button">
            <div class="input">
                <input type="submit" name="submit_update" value="modifier">
            </div>
            <div>
            <a href="participe_table.php" class="btn_table">
                <img src="../icons/tableau-de-donnees.png"  width="25px" height="25px" alt="tableau">
                Revenir au tableau
            </a>
            </div>
            </div>
    </form>
</div>
    <?php }
    else{
        header('location:participe_table.php');
        exit();
    }
}elseif ($do == 'supprimer'){
    if( isset( $_GET['id'] )){
        $fullId = explode('_', $_GET['id']);
        deleteParticipation($fullId[0],$fullId[1]);
        header("location:participe_table");
        exit();
    }
}elseif ( $do == "detailler"){
    $id = $_GET['id'];
    $fullId = explode('_', $_GET['id']);
    $participation = participe_detail( $fullId[0],$fullId[1]);
    ?>
         <div class="container2">
     <a href="participe_table.php" class="btn_table">
                <img src="../icons/tableau-de-donnees.png"  width="25px" height="25px" alt="tableau">
                Revenir au tableau
            </a>
        <?php echo intoBalise("h1","<mark> Le détail de la participation</mark>"); ?>
    <table class="fl-table">
        <thead>
            <tr>
                <th>Nation ID</th>
                <th>Nation</th>
                <th>Edition ID</th>
                <th>Edition</th>
                <th>Matches joués </th>
                <th> résultat </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $participation[0]["nat_id"]?></td>
                <td><?php echo $participation[0]["nat_nom"]?></td>
                <td><?php echo $participation[0]["edt_id"]?></td>
                <td><?php echo $participation[0]["edt_annee"]?></td>
                <td><?php echo $participation[0]["matches_joues"]?></td>
                <td><?php echo $participation[0]["resultat"]?></td>
            </tr>
        </tbody>
    </table>
    <?php
        echo intoBalise("h1","<mark> le détail de l'édition</mark>");
        $participe_edition = getEditionById($fullId[1]);
        ?>
        <table class="fl-table">
        <thead>
            <tr>
                <th>Edition ID</th>
                <th>Annee</th>
                <th>Champion</th>
                <th>nbr_prtcp</th>
                <th>budget</th>
                <th>MVP</th>   
                <th>spectateurs</th>
                <th>matches </th>
            </tr> 
        </thead>
            <tbody>
                <tr>
                <td><?php echo $participe_edition['edt_id']?></td>    
                    <td><?php echo $participe_edition['edt_annee']?></td>    
                    <td><?php echo $participe_edition['edt_champion']?></td>
                    <td><?php echo $participe_edition['edt_nbr_participants']?></td>
                    <td><?php
                    if ($participe_edition['edt_budget'] == null){
                        echo "non communiqué";
                    }else{
                     echo ($participe_edition['edt_budget']);
                    }?></td>
                    <td><?php echo $participe_edition['edt_mvp']?></td>
                    <td><?php
                     if ($participe_edition['edt_spectateurs'] == null){
                        echo "non communiqué";
                    }else{
                     echo ($participe_edition['edt_spectateurs']);
                    }?></td>
                    <td><?php echo $participe_edition['edt_matches']?></td>
                </tr>
        </tbody>   
        </table>
        <?php
        echo intoBalise("h1","<mark> les informations de la nation</mark>");
        $participe_nation = getNationById($fullId[0]);
        ?>
         <table class="fl-table" >
        <thead>
            <tr>
                <th>Nation ID </th>
                <th>Nom de la nation</th>
                <th>titres</th>
                <th>continent</th>
                <th>participations</th>
                <th>classement</th>
                <th>Surnom</th>   
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $participe_nation['nat_id']?></td>    
                <td><?php echo $participe_nation['nat_nom']?></td>    
                <td><?php echo $participe_nation['nat_titre']?></td>
                <td><?php echo $participe_nation['nat_continent']?></td>
                <td><?php echo $participe_nation['nat_participation']?></td>
                <td><?php echo $participe_nation['nat_classement']?></td>
                <td><?php echo $participe_nation['nat_surnom']?></td>
                </tr>
        </tbody>   
    </table>
</div>
<?php
}
echo getFinHTML();
?>
