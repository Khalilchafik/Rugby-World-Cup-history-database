<?php
include "init.php";
echo getDebutHTML("Accueil","../css/styles.css");
?>
<div class="main">
     <h1 class="page_titre"><mark>Choisissez la table que vous souhaitez </mark></h1>
    <div class="carte-container">
        <a href="../nation/nation_table.php" class="carte">
            <p class="titre">la table nation</p>
        </a>
        <a href="../edition/edition_table.php" class="carte">
            <p class="titre">la table édition</p>
        </a>
        <a href="../participe/participe_table.php" class="carte">
            <p class="titre">la table participation</p>
        </a>
        <a href="../organise/organise_table.php" class="carte">
            <p class="titre">la table organisation</p>
        </a>
    </div>
</div>
<?php
echo getfinHTML();
?>

