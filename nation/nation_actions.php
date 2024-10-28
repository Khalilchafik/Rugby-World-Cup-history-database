<?php
include "../php_fichiers/init.php";
echo getDebutHTML("nation_actions","../css/styles.css");
$do = isset( $_GET['do'] ) ? $_GET['do'] :'';
if( $do == ''){
    header('location:nation_table.php');
    exit();
}
elseif( $do == 'Modifier'){
    if( isset( $_GET['id'] ) && is_numeric($_GET['id'])){
        $id = $_GET['id'];
    $nation = getNationById($id);
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_update"])) {
        $nation = array();
        $nation["nat_id"] = $id;
		$nation['nat_nom'] = $_POST['nat_nom'];
		$nation['nat_titre'] = $_POST['nat_titre'];
		$nation['nat_continent'] = $_POST['nat_continent'];
		$nation['nat_participation'] = $_POST['nat_participation'];
		$nation['nat_classement'] = $_POST['nat_classement'];
		$nation['nat_surnom'] = $_POST['nat_surnom'];
		updateNation($nation);
        header('location:nation_table.php');
        exit();
    }
    ?>
<div class="container">
    <div class="text">
        Modifier une  nation
    </div>
    <form action="?do=Modifier&id=<?php echo $id?>" method="post">
    <div class="input">
            <label for="Nom">Nom</label>
            <input value="<?php echo $nation['nat_nom']?>" type="text" name="nat_nom"  required>
        </div>
        <div class="input">
            <label for="Titre">Titre</label>
            <input value="<?php echo $nation['nat_titre']?>" type="number" name="nat_titre" required>
        </div>
        <div class="input">
            <label for="continent">Continent</label>
            <select name="nat_continent" required>
                <!-- une contrainte check sur les continents -->
                <option value="<?php echo $nation["nat_continent"]?>" ></option>
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
            <input  value="<?php echo $nation['nat_participation']?>" type="number" name="nat_participation" required>
        </div>
        <div class="input">
            <label for="classement">Classement</label>
            <input  value="<?php echo $nation["nat_classement"]?>" type="number" name="nat_classement" required>
        </div>
        <div class="input">
            <label for="surnom">Surnom</label>
            <input value="<?php echo $nation["nat_surnom"]?>" type="text" name="nat_surnom" required>
        </div>
        <br>
        <div class="submit_button">
            <div class="input">
                <input type="submit" name="submit_update" value="Modifier">
            </div>
        <div>
            <a href="nation_table.php" class="btn_table">
                <img src="../icons/tableau-de-donnees.png"  width="25px" height="25px" alt="">
                Revenir au tableau
            </a>
        </div>
    </form>
</div>
    <?php }
    else{
        header('location:nation_table.php');
        exit();
    }
}elseif ($do == 'Supprimer'){
    if( isset( $_GET['id'] ) && is_numeric($_GET['id'])){
        $id = $_GET['id'];
        deleteNation($id);
        header("location:nation_table");
        exit();
    }
}elseif ($do == 'detailler'){
    if( isset( $_GET['id'] ) && is_numeric($_GET['id'])){
        $nation_detailler = detail_nation( $_GET['id'] );
        ?>
        <div class="container2">
            <a href="nation_table.php" class="btn_table">
                <img src="../icons/tableau-de-donnees.png"  width="25px" height="25px" alt="table_icon">
                Revenir au tableau
            </a>
        <?php
        echo intoBalise("h1","<mark>les informations de la nation</mark>"); ?>  
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
                <td><?php echo $nation_detailler[0]['nat_id']?></td>    
                <td><?php echo $nation_detailler[0]['nat_nom']?></td>    
                <td><?php echo $nation_detailler[0]['nat_titre']?></td>
                <td><?php echo $nation_detailler[0]['nat_continent']?></td>
                <td><?php echo $nation_detailler[0]['nat_participation']?></td>
                <td><?php echo $nation_detailler[0]['nat_classement']?></td>
                <td><?php echo $nation_detailler[0]['nat_surnom']?></td>
                </tr>
        </tbody>   
    </table>
    <?php
    echo intobalise('h1','<mark>histoire des participations de la nation</mark>');
    $nation_history = detail_nation( $_GET['id'] );
    ?>
    <table class="fl-table" >
        <thead>
            <tr>
                <th>Edition année  </th>
                <th>matches joués</th>
                <th>résultat</th>  
            </tr>
        </thead>
        <tbody>
            <?php 
            if (count($nation_history) > 0 && $nation_history[0]['resultat'] != "" ){
            foreach($nation_history as $nat):?>
            <tr>
                <td><?php echo $nat['edt_annee']?></td>    
                <td><?php echo $nat['matches_joues']?></td>
                <td><?php echo $nat['resultat']?></td>
                </tr>
           <?php
            endforeach; 
            }else{
                echo "<td colspan=3>AUCUNE PARTICIPATION</td>";
            }?>
        </tbody>   
    </table>
        </div>
<?php
    }

}
echo getFinHTML()
?>