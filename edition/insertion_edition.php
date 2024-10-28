<?php
include "../php_fichiers/init.php";
echo getDebutHTML("edition","../css/styles.css");
$result_nation = getAllNations();
?>
<div class="container">
    <div class="text">
        Ajouter une nouvelle édition
    </div>
    <form action="inserer_edition.php" method="post">
        <div class="input">
            <label for="annee">Année</label>
            <input type="number" name="edt_annee" required>
        </div>
        <div class="input">
            <label for="Nation">Champion</label>
            <select name="edt_champion" required>
                <option value="" readonly>Selectionnez le champion de l'édition</option>
                <?php
                foreach ($result_nation as $nation) {
                    echo '<option value="'.$nation['nat_nom'].'">'.$nation['nat_nom'].'</option>';
                }
                ?>
            </select>
        </div>
        <div class="input">
            <label for="nbr_participants">Nombre de participants</label>
            <input type="number" name="edt_nbr_participants"  required>
        </div>
        <div class="input">
            <label for="budget">Budget</label>
            <input type="number" name="edt_budget" required placeholder="le budget en livres sterling">
        </div>
        <div class="input">
            <label for="mvp">MVP</label>
            <input type="text" name="edt_mvp" required>
        </div>
        <div class="input">
            <label for="spectateurs">Spectateurs</label>
            <input type="number" name="edt_spectateurs" required>
        </div>
        <div class="input">
            <label for="matches">Matches</label>
            <input type="number" name="edt_matches"  required> 
        </div>
        <br>
        <div class="submit_button">
            <div class="input">
                <input type="submit" name="edition_submit" value="insérer">
            </div>
            <div>
            <a href="edition_table.php" class="btn_table">
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