<?php
function connexion() {
    $strConnex = "host = ".$_ENV['dbHost']." dbname = ".$_ENV['dbName']." user = ".$_ENV['dbUser']." password = ".$_ENV['dbPassword'];
    $ptrDB = pg_connect($strConnex);
    return $ptrDB;
}
function getDebutHTML(string $title = "Title content", string $css = "styles.css"): string {
    return "<!DOCTYPE html>\n<html>\n<head>\n<title>$title</title>\n<link rel='stylesheet' href='$css'> \n</head>\n<body>\n";
}


function getFinHTML(): string {
    return "</body>\n</html>";
}

function intoBalise(string $nomElement, string $contenuElement, ?string $classe = null, ?string $id = null): string {
    $attributes = '';
    if ($classe !== null) {
        $attributes .= ' class="' . $classe . '"';
    }
    if ($id !== null) {
        $attributes .= ' id="' . $id . '"';
    }
    if ($contenuElement === "") {
        return "<$nomElement$attributes />";
    } else {
        return "<$nomElement$attributes>$contenuElement</$nomElement>";
    }
}
function afficherTable($titres, $donnees) {
    $html = "<table border='1'>";
    $html .= "<tr>";
    foreach ($titres as $titre) {
        $html .= "<th>$titre</th>";
    }
    $html .= "</tr>";
    foreach ($donnees as $ligne) {
        $html .= "<tr>";
        foreach ($ligne as $cellule) {
            $html .= "<td>$cellule</td>";
        }
        $html .= "</tr>";
    }
    $html .= "</table>";
    return $html;
}

?>