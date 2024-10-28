<?php
include "../php_fichiers/init.php";
echo getDebutHTML("edition_actions","../css/styles.css");
$do = isset( $_GET['do'] ) ? $_GET['do'] :'';
if( $do == ''){
    header('location:edition_table.php');
    exit();
}
elseif( $do == 'Modifier'){
    if( isset( $_GET['id'] ) && is_numeric($_GET['id'])){
        $id = $_GET['id'];
    $resultat = getEditionById($id);
    $result_nation = getAllNations();
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_update"])) {
        $edition = array();
        $edition["edt_id"] = $id;
		$edition['edt_annee'] = intval($_POST['edt_annee']);
		$edition['edt_champion'] = $_POST['edt_champion'];
	    $edition['edt_nbr_participants'] = intval($_POST['edt_nbr_participants']);
		$edition['edt_budget'] = floatval($_POST['edt_budget']);
		$edition['edt_mvp'] = $_POST['edt_mvp'];
		$edition['edt_spectateurs'] = intval($_POST['edt_spectateurs']);
		$edition['edt_matches'] = intval($_POST['edt_matches']);
	    updateEdition($edition);
        header('location:edition_table.php');
        exit();
    }
    ?>
<div class="container">
    <div class="text">
        Modifier une  édition
    </div>
    <form action="?do=Modifier&id=<?php echo $id?>" method="post">
        <div class="input">
            <label for="annee">Année</label>
            <input value="<?php echo $resultat['edt_annee']?>" type="number" name="edt_annee" required>
        </div>
        <div class="input">
            <label for="Nation">Champion</label>
            <select name="edt_champion" required>
                <option  value="<?php echo $resultat['edt_champion']?>"><?php echo $resultat['edt_champion'] ?></option>
                <?php
                foreach ($result_nation as $nation) {
                    echo '<option value="'.$nation['nat_nom'].'">'.$nation['nat_nom'].'</option>';
                }
                ?>
            </select>
        </div>
        <div class="input">
            <label for="nbr_participants">Nombre de participants</label>
            <input  value="<?php echo $resultat['edt_nbr_participants']?> "type="text" name="edt_nbr_participants"  required>
        </div>
        <div class="input">
            <label for="budget">Budget</label>
            <input  value="<?php echo $resultat['edt_budget']?>"type="number" name="edt_budget"  placeholder="le budget en livres sterling">
        </div>
        <div class="input">
            <label for="mvp">MVP</label>
            <input value="<?php echo $resultat['edt_mvp']?>" type="text" name="edt_mvp" required>
        </div>
        <div class="input">
            <label for="spectateurs">Spectateurs</label>
            <input value="<?php echo $resultat['edt_spectateurs']?>" type="number" name="edt_spectateurs" required >
        </div>
        <div class="input">
            <label for="matches">Matches</label>
            <input value="<?php echo $resultat['edt_matches']?>" type="number" name="edt_matches" required> 
        </div>
        <br>
        <div class="submit_button">
            <div class="input">
                <input type="submit" name="submit_update" value="Modifier">
            </div>
        </div>
            <a href="edition_table.php" class="btn_table">
                <img src="../icons/tableau-de-donnees.png"  width="25px" height="25px" alt="">
                Revenir au tableau
            </a>
    </form>
</div>
    <?php }
    else{
        header('location:edition_table.php');
        exit();
    }
}elseif ($do == 'Supprimer'){
    if( isset( $_GET['id'] ) && is_numeric($_GET['id'])){
        $id = $_GET['id'];
        deleteEdition($id);
        header("location:edition_table");
        exit();
    }
}elseif ( $do == "detailler") {
    if( isset( $_GET["id"] ) && is_numeric($_GET["id"])){
        $edt_dtl = detail_edition2($_GET["id"]);
        ?>
        <div class="container2">
        <a href="edition_table.php" class="btn_table">
                <img src="../icons/tableau-de-donnees.png"  width="25px" height="25px" alt="tableau_icon">
                Revenir au tableau
            </a>
         <h1><mark> les informations de l'édition</mark> </h1>
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
                    <td><?php echo $edt_dtl[0]['edt_id']?></td>    
                    <td><?php echo $edt_dtl[0]['edt_annee']?></td>    
                    <td><?php echo $edt_dtl[0]['edt_champion']?></td>
                    <td><?php echo $edt_dtl[0]['edt_nbr_participants']?></td>
                    <td><?php
                        if ($edt_dtl[0]['edt_budget'] == null){
                            echo "non communiqué";
                        }else{
                            echo ($edt_dtl[0]['edt_budget']);
                        }?></td>
                    <td><?php echo $edt_dtl[0]['edt_mvp']?></td>
                    <td><?php
                     if ($edt_dtl[0]['edt_spectateurs'] == null){
                        echo "non communiqué";
                    }else{
                     echo ($edt_dtl[0]['edt_spectateurs']);
                    }?></td>
                    <td><?php echo $edt_dtl[0]['edt_matches']?></td>
                </tr>
        </tbody>   
    </table>
         <h1> <mark>la liste des pays hotes</mark> </h1>
    <table class="fl-table">
        <thead>
            <tr> 
                <th>pays hote</th>
            </tr>
        </thead>
            <tbody>
                <?php
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
        echo intoBalise("h1","<mark>le détail de l'édition</mark>");
        $edition_detail = detail_edition1 ($_GET["id"]);?>
        <table class="fl-table">
        <thead>
            <tr>
                <th>Nation</th>
                <th>matches joués</th>
                <th>résultat</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (count($edition_detail) > 0 && $edition_detail[0]["nat_nom"] != ""){
            foreach($edition_detail as $edt):?>
            <tr>
                <td><?php echo $edt['nat_nom']?></td>    
                <td><?php echo $edt['matches_joues']?></td>
                <td><?php echo $edt['resultat']?></td>
            </tr>
           <?php
            endforeach;}
             else{
                echo "<td colspan=3> Aucun participant</td>";
             }?>
        </tbody>   
    </table>
        </div>
    <?php
    }
    else{
        header('location:edition_table.php');
        exit();
    }

}
echo getFinHTML()
?>
