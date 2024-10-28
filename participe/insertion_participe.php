<?php
include "../php_fichiers/init.php";
echo getDebutHTML("participe","../css/styles.css");
$result_nation = getAllNations();
$result_edition = getAllEditions();
?>
<div class="container">
    <div class="text">
        Ajouter une nouvelle Participation
    </div>
    <form action="inserer_participe.php" method="post">
        <div class="input">
            <label for="Nation">Nation</label>
            <select name="nat_id" required>
                <option value="">choisissez une nation</option>
                <?php
                foreach ($result_nation as $nation) {
                    echo '<option value="'.$nation['nat_id'].'">'.$nation['nat_nom'].'</option>';
                }
                ?>
            </select>
        </div>
        <div class="input">
            <label for="Edition">Edition</label>
            <select name="edt_id" required>
                <option value="" readonly>choisissez une édition</option>
                <?php
                foreach ($result_edition as $edition) {
                    echo '<option value="'.$edition['edt_id'].'">'.$edition['edt_annee'].'</option>';
                }
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
                <input type="submit" name="participation_submit" value="insérer">
            </div>
            <div>
            <a href="participe_table.php" class="btn_table">
                <img src="../icons/tableau-de-donnees.png"  width="25px" height="25px" alt="tableau_icon">
                Revenir au tableau
            </a>
            </div>
            </div>
    </form>
</div>
<?php 
echo getFinHTML();
?>