<?php
include '../php_fichiers/init.php';
echo getDebutHTML("nation","../css/styles.css");
?>
<div class="container">
    <div class="text">
        Ajouter une nouvelle nation
    </div>
    <form action="inserer_nation.php" method="POST">
        <div class="input">
            <label for="Nom">Nom</label>
            <input type="text" name="nat_nom"  required>
        </div>
        <div class="input">
            <label for="Titre">Titre</label>
            <input type="number" name="nat_titre" required>
        </div>
        <div class="input">
            <label for="continent">Continent</label>
            <select name="nat_continent" required>
                <!-- une contrainte check sur les continents -->
                <option value="" readonly>séléctionnez le continent</option>
                <option value="Afrique">Afrique</option>
                <option value="Asie">Asie</option>
                <option value="Europe">Europe</option>
                <option value="Amérique du Nord">Amérique du Nord</option>
                <option value="Amérique du Sud">Amérique du Sud</option>
                <option value="Océanie">Océanie</option>
            </select>
        </div>
        <div class="input">
            <label for="participation">Participation</label>
            <input type="number" name="nat_participation" required>
        </div>
        <div class="input">
            <label for="classement">Classement</label>
            <input type="number" name="nat_classement" required>
        </div>
        <div class="input">
            <label for="surnom">Surnom</label>
            <input type="text" name="nat_surnom" required>
        </div>
        <br>
        <div class="submit_button">
            <div class="input">
                <input type="submit" name="nation_submit" value="insérer">
            </div>
            <div>
            <a href="nation_table.php" class="btn_table">
                <img src="../icons/tableau-de-donnees.png"  width="25px" height="25px" alt="table_icon">
                Revenir au tableau
            </a>
            </div>    
        </div>
    </form>
</div>
<?php 
echo getFinHTML();
?>