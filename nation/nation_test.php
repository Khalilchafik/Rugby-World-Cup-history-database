<?php
include "../php_fichiers/init.php";
$pageHtml = getDebutHtml("nation_test","../css/style_table.css");

// Test des fonctions de la table Nation
$pageHtml .= intobalise("h1","Test des fonctions de la table Nation","titre1");
$pageHtml .= intobalise("p","Affichage de la Nation avec l'ID 1 : <br />","sous_titre");
$titresNation = array('ID', 'Nom', 'Titres', 'Continent', 'Participation', 'Classement', 'Surnom');

$nation1 = getNationById('1');
$donneesNation1 = array_values($nation1);
$pageHtml .= afficherTable($titresNation, array($donneesNation1));

$pageHtml .= intobalise("p","Affichage de la Nation avec l'ID 10 : <br />","sous_titre");
$nation10 = getNationById('10');
$donneesNation10 = array_values($nation10);
$pageHtml .= afficherTable($titresNation, array($donneesNation10));

$pageHtml .= intobalise("p" ,"L'insertion d'une Nation : <br />","sous_titre");
$nation = getNationById('1');
unset($nation['nat_id']); // on enlève l'id de la nation puisqu'on donne un ID default 
$nation['nat_surnom'] = 'surnom'; // le surnom est unique on le change 
$resultatInsertionNation = insererNation($nation);
$pageHtml .= afficherTable($titresNation, array(array_values($resultatInsertionNation)));

$pageHtml .= intobalise("p","Modification d'une nation : <br />","sous_titre");
$nation = getNationById($resultatInsertionNation['nat_id']);
$nation['nat_surnom'] ='Bafana Bafana';
$nation['nat_classement'] = '180';
$nation_modifiee = updateNation($nation);
$pageHtml .= intobalise("p",'Après la  modification : <br />',"sous_titre");
$pageHtml .= afficherTable($titresNation, array(array_values($nation_modifiee)));
// test de la fonction deleteNation
$pageHtml .= intobalise("p","La suppression d'une nation :<br />","sous_titre");
deleteNation($nation_modifiee['nat_id']);// pour éviter la répétition ,on voit bien après dans l'affichage de getAllNations que la nation est bien supprimé.
$pageHtml .= intobalise("p","Affichage de toute la table Nation : <br />","sous_titre");
$allNations = getAllNations();
$pageHtml .= afficherTable($titresNation, $allNations);
echo $pageHtml;
getfinHTML();
?>