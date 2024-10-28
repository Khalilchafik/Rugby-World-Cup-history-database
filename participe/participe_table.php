<?php
session_start();
$_SESSION["session_table"] = "participe";
include "../php_fichiers/init.php";
echo getDebutHTML("la table Participe","../css/alltables.css");
$donnes = getInnerfromParticipation();
  ?>
<div class="container">
    <div class="text">
        <h1><mark>La table Participe<mark> </h1>
    </div>
    <div class="inserer_acceuil">
        <a href="insertion_participe.php" class="btn">
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
                <th>nation </th>   
                <th>edition</th>   
                <th>matches joués</th>   
                <th>résultat</th> 
                <th>Actions</th> 
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach($donnes as $donne):?>
            <tr>
                <td><?php echo $donne['nat_nom']?></td>
                <td><?php echo $donne['edt_annee']?></td>
                <td><?php echo $donne['matches_joues']?></td>
                <td><?php echo $donne['resultat']?></td>
                <td  class='btn_container'>
                    <a href="participe_actions.php?do=modifier&id=<?php echo $donne['nat_id']."_".$donne['edt_id']?> " class="btn_modifier">
                    <img src="../icons/bouton-modifier.png"  width="15px" height="15px" alt="modifier_icon">
                    Modifier
                    </a>
                    <a href="participe_actions.php?do=supprimer&id=<?php echo $donne['nat_id']."_".$donne['edt_id']?>  "class="btn_supprimer" >
                    <img src="../icons/supprimer.png"  width="15px" height="15px" alt="supprimer_icon">
                    supprimer
                    </a>
                    <a href="participe_actions.php?do=detailler&id=<?php echo $donne['nat_id']."_".$donne['edt_id']?>  "class="btn_detailler" >
                    <img src="../icons/chercher.png"  width="15px" height="15px" alt="detail_icon">
                    detailler
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