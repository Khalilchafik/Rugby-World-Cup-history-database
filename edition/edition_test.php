<?php
include "../php_fichiers/init.php";
$pageHtml = getDebutHtml("edition_test","../css/style_table.css");
// Test des fonctions de la table Edition
$pageHtml .= intobalise("h1","Test des fonctions de la table Edition","titre1");
$pageHtml .= intobalise("p","Affichage de l'édition avec l'ID 1 : <br />","sous_titre");
$titresEdition = array('ID', 'Année', 'Pays champion', 'Participants', 'Budget', 'MVP', 'Spectateurs', 'Matches');

$edition1 = getEditionById('1');
$donneesEdition1 = array_values($edition1);
$pageHtml .= afficherTable($titresEdition, array($donneesEdition1));
$pageHtml .= intobalise("p","Affichage de l'édition avec l'ID 10 : <br />","sous_titre");
$edition10 = getEditionById('10');
$donneesEdition10 = array_values($edition10);
$pageHtml .= afficherTable($titresEdition, array($donneesEdition10));

$edition = getEditionById('1');
unset($edition['edt_id']); // on enlève l'id , puisqu'on donne un id default dans la fonction insererEdition()
$edition['edt_annee'] = '2027';// l'année est unique dans la BD
$resultatInsertionEdition = insererEdition($edition);
$pageHtml .= intobalise("p" ,"Insertion d'une édition : <br />","sous_titre");
$pageHtml .= afficherTable($titresEdition, array(array_values($resultatInsertionEdition)));

$pageHtml .= intobalise("p","Modification d'une édition : <br />","sous_titre");
$edition = getEditionById($resultatInsertionEdition['edt_id']);
$edition['edt_champion'] ='Zimbabwe' ;
$edition['edt_mvp'] = 'Khalil chafik';
$edition_modifiee = updateEdition($edition);
$pageHtml .= intobalise("p",'Après la modification : <br />',"sous_titre");
$pageHtml .= afficherTable($titresEdition, array(array_values($edition_modifiee)));

$pageHtml .= intobalise("p","Suppression d'une édition :<br />","sous_titre");
deleteEdition($edition_modifiee['edt_id']);// pour éviter la répétition ,on voit bien après dans l'affichage de getAllEdition que l'édition est bien supprimée.

$pageHtml .= intobalise("p","Affichage de toute la table Edition : <br />","sous_titre");
$allEditions = getAllEditions();
$pageHtml .= afficherTable($titresEdition, $allEditions);
echo $pageHtml;
getfinHTML();
?>