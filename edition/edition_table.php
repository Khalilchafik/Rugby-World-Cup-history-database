<?php
session_start();
$_SESSION["session_table"] = "edition";
include "../php_fichiers/init.php";
echo getDebutHTML("la table Edition","../css/alltables.css");
$donnes = getAllEditions();
  ?>

<div class="container">
    <div class="text">
        <h1 > <mark> La table Edition </mark> </h1>
    </div>
    <div class="inserer_acceuil">
        <a href="insertion_edition.php" class="btn">
            <img src="../icons/ajouter.png"  width="25px" height="25px" alt="ajouter_icon">
            Insérer un nouvel enregistrement
        </a>
        <a href="../php_fichiers/acceuil.php" class="btn">
            <img src="../icons/page-daccueil.png"  width="25px" height="25px" alt="accueil_icon">
            Revenir à l'accueil
        </a>
    </div>
    <table class="fl-table">
        <thead>
            <tr>
                <th>Année</th>
                <th>Champion</th>
                <th>participants</th>
                <th>Budget </th>
                <th>Edition MVP</th>
                <th>spectateurs</th>   
                <th>matches</th>
                <th>Actions </th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach($donnes as $donne):?>
            <tr>
                <td><?php echo $donne['edt_annee']?></td>    
                <td><?php echo $donne['edt_champion']?></td>
                <td><?php echo $donne['edt_nbr_participants']?></td>
                <td><?php echo $donne['edt_budget']?></td>
                <td><?php echo $donne['edt_mvp']?></td>
                <td><?php echo $donne['edt_spectateurs']?></td>
                <td><?php echo $donne['edt_matches']?></td>
                <td  class='btn_container'>
                    <a href="edition_actions.php?do=Modifier&id=<?php echo $donne['edt_id']?>" class="btn_modifier">
                        <img src="../icons/bouton-modifier.png"  width="15px" height="15px" alt="modifier_icon">
                    Modifier
                    </a>
                    <a href="edition_actions.php?do=Supprimer&id=<?php echo $donne['edt_id']?>" class="btn_supprimer">
                        <img src="../icons/supprimer.png"  width="15px" height="15px" alt="supprimer_icon">
                    supprimer
                    </a>
                    <a href="edition_actions.php?do=detailler&id=<?php echo $donne['edt_id']?>" class="btn_detailler">
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