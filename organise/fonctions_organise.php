<?php
function getOrganiseById(int $id , int $id2) : array {
    $ptrDB = connexion();

    $query = "SELECT * FROM g04_organise WHERE nat_id = $1 AND edt_id = $2";

    pg_prepare($ptrDB, "reqPrepSelectOrganiseById", $query);

    $ptrQuery = pg_execute($ptrDB, "reqPrepSelectOrganiseById", array($id,$id2));
    $result = array();
    if(isset($ptrQuery)){
        $result = pg_fetch_assoc($ptrQuery);
        if(empty($result)){
            $result = array("message" => "Identifiant de organise non valide : $id et $id2");
        }
    }
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return $result;
}
function getAllOrganisations() : array {
    $ptrDB = connexion();

    $query = "SELECT * FROM G04_organise";
    pg_prepare($ptrDB, "reqPrepSelectAllOrganisations", $query);
    $ptrQuery = pg_execute($ptrDB, "reqPrepSelectAllOrganisations", array());

    $result = pg_fetch_all($ptrQuery);
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return $result;
}
function insererOrganisation(array $organisation) : array {
    $ptrDB = connexion();
    $query = "INSERT INTO G04_organise (nat_id, edt_id) VALUES($1, $2)";
    pg_prepare($ptrDB, 'reqPrepInserOrganisation', $query);
    $result = pg_execute($ptrDB, 'reqPrepInserOrganisation', $organisation);
    $nouvelleOrganisation = pg_fetch_assoc($result);
    if (!$result) {
        return array("message" => "Erreur d'insertion");
    }
     return getOrganiseById($organisation['nat_id'],$organisation['edt_id']);
}
/* pour la logique de la fonction de modification , puisqu'on dispose que du nat_id et edt_id
    , on a décidé que l'utilisateur ne peut modifier que la nation et non l'année de l'édition
    , donc l'array donné en paramètre doit contenir l'ancien nat_id ou le nat_id qu'on veut changer
    plus l'edt_id et le nouveau id de la nation qu'on souhaite mettre à la place de l'ancien.
*/
function updateOrganisation(array $organisation) {
    $ptrDB = connexion();
    $query = 'UPDATE G04_organise SET nat_id = $1 WHERE nat_id = $3 AND edt_id = $2';
    pg_prepare($ptrDB, 'reqUpdateOrganisation', $query);
    pg_execute($ptrDB, 'reqUpdateOrganisation', $organisation);
   return getOrganiseById($organisation['nat_id'],$organisation['edt_id']);
}
function deleteOrganisation(int $id , int $id2) {
    $ptrDB = connexion();
    $query = 'DELETE FROM g04_organise WHERE nat_id=$1 AND edt_id = $2 ';
    pg_prepare($ptrDB, 'reqPrepDeleteOrganise',$query);
    pg_execute($ptrDB,'reqPrepDeleteOrganise',array($id,$id2));
    return getAllOrganisations();
}
/* la fonction getInner..() est utilisée pour pouvoir afficher l'année de l'édition et le nom de
la nation au lieu du nat_id et edt_id */
function getInnerfromOrganisation() : array{
    $ptrDB = connexion();
    $query = 'select g04_organise.* , g04_nation.nat_nom , g04_edition.edt_annee from g04_organise
    inner join g04_nation on g04_organise.nat_id = g04_nation.nat_id 
    inner join g04_edition on g04_organise.edt_id = g04_edition.edt_id';
    pg_prepare($ptrDB, 'jointure_organise', $query);
    $ptrQuery = pg_execute($ptrDB,'jointure_organise',array());
    $result = pg_fetch_all($ptrQuery);
    return $result;    
}
function organise_detail(int $nat_id, int $edt_id) : array{
    $ptrDB = connexion();
    $query = 'SELECT g04_organise.* , g04_nation.nat_nom , g04_edition.edt_annee from g04_organise 
    inner join g04_nation on g04_organise.nat_id = g04_nation.nat_id 
    inner join g04_edition on g04_organise.edt_id = g04_edition.edt_id
    where g04_nation.nat_id = $1 and g04_edition.edt_id = $2';
    pg_prepare($ptrDB,'detail_organise', $query); 
    $ptrQuery = pg_execute($ptrDB,'detail_organise',array($nat_id,$edt_id));
    $result = pg_fetch_all($ptrQuery);
    return $result;
}
?>