<?php

function getNationById(int $id) : array {
    $ptrDB = connexion();

    $query = "SELECT * FROM g04_nation WHERE nat_id = $1";

    pg_prepare($ptrDB, "reqPrepSelectNationById", $query);

    $ptrQuery = pg_execute($ptrDB, "reqPrepSelectNationById", array($id));
    $result = array();
    if(isset($ptrQuery)){
        $result = pg_fetch_assoc($ptrQuery);
        if(empty($result)){
            $result = array("message" => "Identifiant de nation non valide : $id");
        }
    }
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return $result;
}
function getAllNations() : array {
    $ptrDB = connexion();

    $query = "SELECT * FROM g04_nation ORDER BY nat_nom";
    pg_prepare($ptrDB, "reqPrepSelectAll", $query);
    $ptrQuery = pg_execute($ptrDB, "reqPrepSelectAll", array());

    $result = pg_fetch_all($ptrQuery);
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return $result;
}
function insererNation(array $nation) : array {
    $ptrDB = connexion();
    $query = "INSERT INTO g04_nation(nat_nom,nat_titre,nat_continent,nat_participation,nat_classement,nat_surnom) VALUES($1,$2,$3,$4,$5,$6) RETURNING nat_id";
    pg_prepare($ptrDB,'reqPrepInserNation',$query);
    $result = pg_execute($ptrDB, 'reqPrepInserNation', $nation);
    $nouvelleNation = pg_fetch_assoc($result);
    if (!$nouvelleNation) {
        return array("message" => "Erreur d'insertion");
    }
     return getNationById($nouvelleNation['nat_id']);
}
function updateNation(array $nation) {
    $ptrDB = connexion();
    //Preparation de la requete
    $query = 'UPDATE g04_nation SET nat_nom = $2, nat_titre = $3,  nat_continent = $4,  nat_participation = $5,nat_classement = $6 , nat_surnom = $7 WHERE nat_id = $1';
    pg_prepare($ptrDB,'reqUpdateNation',$query);
    //execution de la requete
    pg_execute($ptrDB,'reqUpdateNation',$nation);
    return getNationById($nation['nat_id']);
}
function deleteNation(int $id) {
    $ptrDB = connexion();
    //Preparation de la requete
    $query = 'DELETE FROM g04_nation WHERE nat_id = $1';
    pg_prepare($ptrDB, 'reqPrepDeleteNation',$query);
    pg_execute($ptrDB,'reqPrepDeleteNation',array($id));
    return getAllNations();
}
function detail_nation(int $id) : array {
    $ptrDB = connexion();
    $query = "SELECT g04_nation.* , g04_participe.resultat , g04_participe.matches_joues , g04_edition.edt_annee FROM g04_nation
    LEFT JOIN g04_participe on g04_nation.nat_id = g04_participe.nat_id
    LEFT JOIN g04_edition on g04_participe.edt_id = g04_edition.edt_id
    WHERE g04_nation.nat_id = $1";
    pg_prepare($ptrDB,'details',$query);
    $ptrQuery = pg_execute($ptrDB,'details',array($id));
    $result = pg_fetch_all($ptrQuery);
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return $result;
}
?>