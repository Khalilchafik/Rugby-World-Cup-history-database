<?php
include "../php_fichiers/init.php";
echo getDebutHTML("organise_actions","../css/styles.css");
$do = isset( $_GET['do'] ) ? $_GET['do'] :'';
if( $do == ''){
    header('location:organise_table.php');
    exit();
}
elseif( $do == 'modifier'){
    if( isset( $_GET['id'] )){
        $id = $_GET['id'];
        $fullId = explode('_', $_GET['id']);
        $organise_courante = getOrganiseById($fullId[0],$fullId[1]);
    $result_edition = getEditionById($fullId[1]);
    $all_nations = getAllNations();
    $id= $_GET['id'];
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_update"])) {
        $organise = array();
        if ($_POST["nat_id"] == $fullId[0]){?>
                <div class="container_erreur_succes">
                  <span class="erreur"> <img src="../icons/erreur.png"  width="25px" height="25px" alt="erreur_icon">
                  Erreur ! le pays saisie est dèja organisateur  
                  </span>
                </div>
         <?php
        }else{
        $organise["nat_id"] = $_POST["nat_id"];
        $organise["edt_id"] = $fullId[1];
        $organise["old_nat_id"] = $fullId[0];
		updateOrganisation($organise);
        header('location:organise_table.php');
        exit();
    }
}
    ?>
<div class="container">
    <div class="text">
        Modifier une Organisation
    </div>
    <form action="?do=modifier&id=<?php echo $id?>" method="post">
        <div class="input">
            <label for="Nation">Nation</label>
            <select name="nat_id" required>
                <?php
                echo '<option value='.$organise_courante['nat_id'].'>...</option>';
                foreach ($all_nations as $nations) {
                    echo '<option value="'.$nations['nat_id'].'">'.$nations['nat_nom'].'</option>';
                }
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
        <br>
        <div class="submit_button">
            <div class="input">
                <input type="submit" name="submit_update" value="modifier">
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
    <?php }
    else{
        header('location:participe_table.php');
        exit();
    }
}elseif ($do == 'supprimer'){
    if( isset( $_GET['id'] )){
        $fullId = explode('_', $_GET['id']);
        deleteOrganisation($fullId[0],$fullId[1]);
        header("location:organise_table");
        exit();
    }
}elseif ( $do == "detailler"){
    $id = $_GET['id'];
    $fullId = explode('_', $_GET['id']);
    $organisation = organise_detail( $fullId[0],$fullId[1]);
    ?>
         <div class="container2">
     <a href="organise_table.php" class="btn_table">
                <img src="../icons/tableau-de-donnees.png"  width="25px" height="25px" alt="tableau_icon">
                Revenir au tableau
            </a>
        <?php echo intoBalise("h1","<mark> Le détail de l'organisation</mark>"); ?>
    <table class="fl-table">
        <thead>
            <tr>
                <th>Nation ID</th>
                <th>Pays hote</th>
                <th>Edition ID</th>
                <th>Edition</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $organisation[0]["nat_id"]?></td>
                <td><?php echo $organisation[0]["nat_nom"]?></td>
                <td><?php echo $organisation[0]["edt_id"]?></td>
                <td><?php echo $organisation[0]["edt_annee"]?></td>
            </tr>
        </tbody>
    </table> 
    <?php echo intoBalise("h1", "<mark>la liste de tous les pays hotes</mark>"); ?>
    <table class="fl-table">
        <thead>
            <tr> 
                <th>pays hote</th>
            </tr>
        </thead>
            <tbody>
                <?php
                 $edt_dtl = detail_edition2($fullId[1]);
                if($edt_dtl[0]['nat_nom'] == ""){
                    echo "<td> non communiqué</td>";
                }else{
                foreach ($edt_dtl as $pays) {?>
                    <tr>
                        <td><?php echo $pays['nat_nom'] ?></td>
                    </tr>
                <?php }
            }?>
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
        echo intoBalise("h1","<mark> les informations du pays hôte sélectionné</mark>");
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
