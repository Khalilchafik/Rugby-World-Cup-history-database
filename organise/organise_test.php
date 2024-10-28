<?php
include "../php_fichiers/init.php";
$pageHtml = getDebutHtml("organise_test","../css/style_table.css");
// Test des fonctions de la table Organise
$pageHtml .= intobalise("h1","Test des fonctions de la table Organise","titre1");
$pageHtml .= intobalise("p","Test de getOrganiseById :", "sous_titre");
$titresOrganise = array('ID de nation', 'ID d\'édition');

$organiseA = getOrganiseById('4', '1');
$donneesOrganiseA = array_values($organiseA);
$pageHtml .= afficherTable($titresOrganise, array($donneesOrganiseA));

$organiseB = getOrganiseById('8', '2');
$donneesOrganiseB = array_values($organiseB);
$pageHtml .= afficherTable($titresOrganise, array($donneesOrganiseB));

$pageHtml .= intobalise("p", "Test de insererOrganisation :", "sous_titre");
$organisationC = getOrganiseById('4', '1');
$organisationC['nat_id'] = '10';
$organisationC['edt_id'] = '1';
$resultatInsertionOrganisation = insererOrganisation($organisationC);
$pageHtml .= afficherTable($titresOrganise, array(array_values($resultatInsertionOrganisation)));
$pageHtml .= intobalise("p", "Test de updateOrganisation :", "sous_titre");
$organisationD['nat_id'] = '9';
$organisationD['edt_id'] = $organisationC['edt_id'] ;
$organisationD["old_nat_id"] = $organisationC['nat_id'];
$resultatUpdateOrganisation = updateOrganisation($organisationD);
$pageHtml .= "<p>Organisation après la mise à jour :</p>";
$pageHtml .= afficherTable($titresOrganise, array(array_values($resultatUpdateOrganisation)));

$pageHtml .= intobalise("p", "Test de deleteOrganisation :", "sous_titre");
deleteOrganisation('9', '1');// pour éviter la répétition ,on voit bien  dans l'affichage de getAllOrganisations que l'organisation est bien supprimé.

$pageHtml .= intobalise("p", "Test de getAllOrganisations :", "sous_titre");
$allOrganisations = getAllOrganisations();
$pageHtml .= afficherTable($titresOrganise, $allOrganisations);

echo $pageHtml;
getfinHTML();
?>