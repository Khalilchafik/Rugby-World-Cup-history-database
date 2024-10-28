<?php
include "../php_fichiers/init.php";
echo getDebutHTML("organise","../css/styles.css");
$result_nation = getAllNations();
$result_edition = getAllEditions();
?>
<div class="container">
    <div class="text">
        Ajouter une nouvelle Organisation
    </div>
    <form action="inserer_organise.php" method="post">
        <label>La nation</label>
        <div class="input">
            <select name="nat_id" required>
                <option value='' readonly>choisir une nation</option>
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
                <option value='' readonly>choisir une année</option>
                <?php
                foreach ($result_edition as $edition) {
                    echo '<option value="'.$edition['edt_id'].'">'.$edition['edt_annee'].'</option>';
                }
                ?>
            </select>
        </div>
        <br>
        <div class="submit_button">
            <div class="input">
                <input type="submit" name="organisation_submit" value="insérer">
            </div>
            <div>
            <a href="organise_table.php" class="btn_table">
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