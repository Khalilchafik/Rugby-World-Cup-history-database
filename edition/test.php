<?php
function tableauIndex2Assoc ($donnes){
    $tab_assoc = array();
   for ($i=0 ; $i<count($donnes);$i+=2){
        $key = $donnes[$i];
        if (isset($donnes[$i +1])){
            $value = $donnes[$i +1];
        }else{
            $value = null;
        }
        $tab_assoc[$key] = $value;
    }
   return $tab_assoc;
}
$tabIndex = ["entrée", "crudités", "plat", "Steack frites", "dessert", "Glaces"];
$assocArray = tableauIndex2Assoc($tabIndex);

print_r($assocArray);
function tableau2D2liste ($donnes) : string {
    $liste ="";
    if (empty($donnes)){
        return $liste;
    }else{
        $liste .= "<ul>";
        foreach ($donnes as $key => $values):
            $liste .= "<li>" . $key ."<ul>" ;
            foreach ($values as $value):
                $liste .= "<li>" . $value . "</li>";
            endforeach;
            $liste .= "</ul>" . "</li>";
        endforeach;
    }
    $liste .= "</ul>";
    return $liste;
}
$tab = [
    "Entrée" => ["Crudités", "Charcuterie", "Feuilleté"],
    "Plat" => ["Steack frites", "Saumon Riz", "Assiette de légumes"],
    "Dessert" => ["Glace", "Mousse au chocolat", "Fraises Chantilly"]
];
echo tableau2D2liste($tab);
?>