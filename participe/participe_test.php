<?php
include "../php_fichiers/init.php";
$pageHtml = getDebutHtml("participe_test","../css/style_table.css");
// Test des fonctions de la table Participe
$pageHtml .= intobalise("h1","Test des fonctions de la table Participation","titre1");
$pageHtml .= intobalise("p","Test de la fonction getParticipeById <br />","sous_titre");
$titresParticipation = array('ID de nation', 'ID d\'édition', 'Matches joués', 'Résultat');

$participationA = getParticipeById('11', '1');
$donneesParticipationA = array_values($participationA);
$pageHtml .= afficherTable($titresParticipation, array($donneesParticipationA));

$participationB = getParticipeById('11', '2');
$donneesParticipationB = array_values($participationB);
$pageHtml .= afficherTable($titresParticipation, array($donneesParticipationB));

$pageHtml .= intobalise("p", "Test de insererParticipation :<br />", "sous_titre");
$participation = getParticipeById('11', '1');
$participation['nat_id'] = '1';
$participation['edt_id'] = '1';
$resultatInsertionParticipation = insererParticipation($participation);
$pageHtml .= afficherTable($titresParticipation, array(array_values($resultatInsertionParticipation)));

$pageHtml .= intobalise("p", "Test de updateParticipation :<br />", "sous_titre");
$participationModifiee = getParticipeById('1', '1');
$participationModifiee ['matches_joues'] = '10';
$participationModifiee ['resultat'] = 'Quart de finale';
updateParticipation($participationModifiee );

$pageHtml .= "<p>Participation après la mise à jour :</p>";
$pageHtml .= afficherTable($titresParticipation, array(array_values($participationModifiee)));

$pageHtml .= intobalise("p", "Test de deleteParticipation :<br />", "sous_titre");
deleteParticipation('1', '1');// pour éviter la répétition ,on voit bien après dans l'affichage de getAllParticipations que la participation est bien supprimé.

$pageHtml .= intobalise("p", "Test de getAllParticipations :<br />", "sous_titre");
$allParticipations = getAllParticipations();
$pageHtml .= afficherTable($titresParticipation, $allParticipations);
echo $pageHtml;
getfinHTML();
?>