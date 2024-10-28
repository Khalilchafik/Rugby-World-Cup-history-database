<?php

function getEditionById(int $id) : array {
    $ptrDB = connexion();
    $query = "SELECT * FROM g04_edition WHERE edt_id = $1";
    pg_prepare($ptrDB,'reqPrepSelectEditionById',$query);
    $ptrQuery = pg_execute($ptrDB,'reqPrepSelectEditionById',array($id));
    if(isset($ptrQuery)){
        $result = pg_fetch_assoc($ptrQuery);
        if(empty($result)){
            $result = array("message" => "Identifiant d'édition non valide : $id");
        }
    }
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return $result;
}
function getAllEditions() : array {
    $ptrDB = connexion();

    $query = "SELECT * FROM g04_edition ORDER BY edt_annee desc";
    pg_prepare($ptrDB, "reqPrepSelectAll", $query);
    $ptrQuery = pg_execute($ptrDB, "reqPrepSelectAll", array());

    $result = pg_fetch_all($ptrQuery);
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return $result;
}
function insererEdition(array $edition) : array {
    $ptrDB = connexion();
    $query = "INSERT INTO g04_edition(edt_annee,edt_champion,edt_nbr_participants,edt_budget,edt_mvp,edt_spectateurs,edt_matches) VALUES($1,$2,$3,$4,$5,$6,$7) RETURNING edt_id";
    pg_prepare($ptrDB,'reqPrepInserEdition',$query);
    $result = pg_execute($ptrDB, 'reqPrepInserEdition', $edition);
    $nouvelleEdition= pg_fetch_assoc($result);
    if (!$nouvelleEdition) {
        return array("message" => "Erreur d'insertion");
    }
    return getEditionById($nouvelleEdition['edt_id']);
}
function updateEdition(array $edition) {
    $ptrDB = connexion();
    $query = 'UPDATE g04_edition SET edt_annee = $2, edt_champion = $3 , edt_nbr_participants=$4,  edt_budget = $5, edt_mvp=$6, edt_spectateurs=$7,  edt_matches=$8 WHERE edt_id = $1';
    pg_prepare($ptrDB,'reqUpdateEdition',$query);
    pg_execute($ptrDB,'reqUpdateEdition',$edition);
     return getEditionById($edition['edt_id']);
}
function deleteEdition(int $id) {
    $ptrDB = connexion();
    $query = 'DELETE FROM g04_edition  WHERE edt_id = $1 ';
    pg_prepare($ptrDB, 'reqPrepDeleteEdition',$query);
    pg_execute($ptrDB,'reqPrepDeleteEdition',array($id));
    return getAllEditions();
}
function detail_edition1(int $id) : array{
    $ptrDB = connexion(); 
    $query = "SELECT  g04_edition.edt_id ,g04_participe.* , g04_nation.nat_nom FROM g04_edition
    left join g04_participe ON g04_edition.edt_id = g04_participe.edt_id
    left join g04_nation ON g04_participe.nat_id = g04_nation.nat_id
	where g04_edition.edt_id = $1;";
    pg_prepare($ptrDB,"edition_details",$query);
    $result = pg_execute($ptrDB,"edition_details",array($id));
    $edition_detail = pg_fetch_all($result);
    return $edition_detail;
}
function detail_edition2 (int $id) : array{
    $ptrDB = connexion();
    $query = "SELECT g04_edition.*  , g04_organise.nat_id, g04_nation.nat_nom
    from g04_edition
    left join g04_organise on g04_edition.edt_id = g04_organise.edt_id
    left join g04_nation on g04_organise.nat_id = g04_nation.nat_id
    where g04_edition.edt_id = $1;";
    pg_prepare($ptrDB,"detail_edition",$query);
    $ptrQuery = pg_execute($ptrDB,"detail_edition",array($id));
    $result = pg_fetch_all($ptrQuery);
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return $result;
}
?>