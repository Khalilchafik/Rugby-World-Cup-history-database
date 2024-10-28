<?php
function getParticipeById(int $id , int $id2) : array {
    $ptrDB = connexion();

    $query = "SELECT * FROM g04_participe WHERE nat_id = $1 AND edt_id=$2 ";

    pg_prepare($ptrDB, "reqPrepSelectparticipeById", $query);

    $ptrQuery = pg_execute($ptrDB, "reqPrepSelectparticipeById", array($id,$id2));
    $result = array();
    if(isset($ptrQuery)){
        $result = pg_fetch_assoc($ptrQuery);
        if(empty($result)){
            $result = array("message" => "Identifiant de participe non valide : $id et $id2 ");
        }
    }
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return $result;
}
function getAllParticipations() : array {
    $ptrDB = connexion();

    $query = "SELECT * FROM G04_participe";
    pg_prepare($ptrDB, "reqPrepSelectAllParticipations", $query);
    $ptrQuery = pg_execute($ptrDB, "reqPrepSelectAllParticipations", array());

    $result = pg_fetch_all($ptrQuery);
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return $result;
}
/* la fonction  plusmoins_participation , une fonction qu'on va utiliser dans la fonction
 d'insertion et de suppression d'une participation , suivant la logique que si on ajoute
 une participation pour une nation , on rajoute cette participation au nombre de participations
 qui existe dèja , et si on supprime une participation : on met à jour le nbr de participations
 dans la table nation d'une façon qu'on soustrait un du nbr de participations :)  */ 
function plusmoins_participation($arg , $id1) {
    $ptrDB = connexion();
    if ($arg == 'plus'){
        $requete = "UPDATE g04_nation
        SET nat_participation = nat_participation + 1
        WHERE nat_id = $id1";
        }
    else if ($arg == "moins"){
        $requete = "UPDATE g04_nation
        SET nat_participation = nat_participation - 1
        WHERE nat_id = $id1";
    }
    pg_prepare($ptrDB, "plusmoins", $requete);
    $ptrQuery = pg_execute($ptrDB, "plusmoins",array());
}
function insererParticipation(array $participation) : array {
    $ptrDB = connexion();
    $query = "INSERT INTO G04_participe (nat_id, edt_id, matches_joues, resultat) VALUES($1, $2, $3, $4)";
    pg_prepare($ptrDB, 'reqPrepInserParticipation', $query);
    $result = pg_execute($ptrDB, 'reqPrepInserParticipation', $participation);
    plusmoins_participation("plus",$participation['nat_id']);
    $nouvelleParticipation = pg_fetch_assoc($result);
    if (!$result) {
        return array("message" => "Erreur d'insertion");
    }
    return getParticipeById($participation['nat_id'],$participation['edt_id']);

}
function updateParticipation(array $participation) {
    $ptrDB = connexion();
    $query = 'UPDATE G04_participe SET matches_joues = $3, resultat = $4 WHERE nat_id = $1 AND edt_id = $2';
    pg_prepare($ptrDB, 'reqUpdateParticipation', $query);
    pg_execute($ptrDB, 'reqUpdateParticipation', $participation);
    return getParticipeById($participation['nat_id'],$participation['edt_id']);
}
function deleteParticipation(int $id , int $id2) {
    $ptrDB = connexion();
    //Preparation de la requete
    $query = 'DELETE FROM g04_participe WHERE nat_id=$1 AND edt_id = $2';
    pg_prepare($ptrDB, 'reqPrepDeleteParticipe',$query);
    pg_execute($ptrDB,'reqPrepDeleteParticipe',array($id,$id2));
    plusmoins_participation('moins',$id);
    return getAllParticipations();

}
/*la fonction getInnerFromParticipation() , est une fct où on va utilliser deux jointures 
entre la table g04_nation et g04_participe (sur le nat_id) pour afficher à l'utilisateur le nom 
de la nation au lieu du nat_id et entre la table g04_edition et g04_participe (sur l'edt_id)
pour afficher l'année de l'édition au lieu de l'edt_id */
function getInnerfromParticipation() : array{
    $ptrDB = connexion();
    $query = 'select g04_participe.* , g04_nation.nat_nom , g04_edition.edt_annee from g04_participe
    inner join g04_nation on g04_participe.nat_id = g04_nation.nat_id 
    inner join g04_edition on g04_participe.edt_id = g04_edition.edt_id';
    pg_prepare($ptrDB, 'test', $query);
    $ptrQuery = pg_execute($ptrDB,'test',array());
    $result = pg_fetch_all($ptrQuery);
    return $result;    
}
/* la fonction check_champion , c'est une fonction qui nous permet de s'assurer ou de limiter 
le nbr des champions d'une édition à un , pour l'utilisation de cette fonction , c'est dans le 
cas où l'utilisateur insére une nouvelle participation , on vérifie si une édition a dèja un champion
( si la fonction retourne 1 donc dèja un champion existe) ou pas si c'est le cas on 
affiche un message d'erreur , sinon l'utilisateur peut mettre dans la case résultat champion
sans aucun soucis , la deuxième utilisation c'est dans la modification avec le même principe*/
function check_champion(int $edtId) : int{
$ptrDB = connexion();
$query = "SELECT count(*) AS nbr from g04_participe where edt_id = $1 and resultat = 'Champion' " ;
pg_prepare($ptrDB,'champQuery', $query);
$ptrQuery= pg_execute($ptrDB,'champQuery',array($edtId));
$result =pg_fetch_all($ptrQuery);
return $result[0]['nbr'];
}
function participe_detail (int $nat_id , int $edt_id) : array {
    $ptrDB = connexion();
    $query = 'SELECT g04_participe.* , g04_nation.nat_nom , g04_edition.edt_annee from g04_participe
    inner join g04_nation on g04_participe.nat_id = g04_nation.nat_id 
    inner join g04_edition on g04_participe.edt_id = g04_edition.edt_id
	where g04_nation.nat_id = $1 and g04_edition.edt_id = $2';
    pg_prepare($ptrDB,'detail_participe', $query); 
    $ptrQuery = pg_execute($ptrDB,'detail_participe',array($nat_id,$edt_id));
    $result = pg_fetch_all($ptrQuery);
    return $result;
}
?>