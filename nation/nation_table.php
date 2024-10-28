<?php
session_start();
$_SESSION["session_table"] = "nation";
include "../php_fichiers/init.php";
echo getDebutHTML("la table nation","../css/alltables.css");
$donnes = getAllNations();
  ?>

<div class="container">
    <div class="text">
        <h1><mark> La table nation</mark></h1>
    </div>
    <div class="inserer_acceuil">
        <a href="insertion_nation.php" class="btn">
            <img src="../icons/ajouter.png"  width="25px" height="25px" alt="ajouter_icon">
            Insérer un nouvel enregistrement
        </a>
        <a href="../php_fichiers/acceuil.php" class="btn">
            <img src="../icons/page-daccueil.png"  width="25px" height="25px" alt="accueil_icon">
            Revenir à l'acceuil
        </a>
    </div>
    <table class="fl-table">
        <thead>
            <tr>
                <th>Nom de la nation</th>
                <th>titres</th>
                <th>continent</th>
                <th>participations</th>
                <th>classement</th>
                <th>Surnom</th>   
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach($donnes as $donne):?>
            <tr>
                <td><?php echo $donne['nat_nom']?></td>    
                <td><?php echo $donne['nat_titre']?></td>
                <td><?php echo $donne['nat_continent']?></td>
                <td><?php echo $donne['nat_participation']?></td>
                <td><?php echo $donne['nat_classement']?></td>
                <td><?php echo $donne['nat_surnom']?></td>
            <td  class='btn_container'> 
                <a href="nation_actions.php?do=Modifier&id=<?php echo $donne['nat_id']?> " class="btn_modifier">
                 <img src="../icons/bouton-modifier.png"  width="15px" height="15px" alt="modifier_icon">
                    Modifier
                </a>
                <a  href="nation_actions.php?do=Supprimer&id=<?php echo $donne['nat_id']?> " class="btn_supprimer">
                <img src="../icons/supprimer.png"  width="15px" height="15px" alt="supprimer_icon">
                    supprimer
                </a>
                <a href="nation_actions.php?do=detailler&id=<?php echo $donne['nat_id']?> " class="btn_detailler">
                <img src="../icons/chercher.png"  width="15px" height="15px" alt="detail_icon">
                    détailler
                </a>
            </td>
            </tr>
           <?php
            endforeach ?>
        </tbody>   
    </table>
    <div class="auteurs">
    <img src="../icons/copyright.png " width="40px" height="40px" alt="auteurs_icon">
    <p>Khalil CHAFIK</p>  
    </div>
</div>

<?php
echo getFinHTML();
?>