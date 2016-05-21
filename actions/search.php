<?php
    $db = mysqli_connect('nortri.ninja:3306', 'fiches', 'q75kXwDEsQbO9ftq', 'fiches');
    $first_element = false;

    $query = 'SELECT Fiche_lien FROM fiche_memoire JOIN
        apprenti ON Apprenti_id = Fiche_apprenti JOIN
        tuteur ON Tuteur_id = Fiche_tuteur JOIN
        entreprise ON Entreprise_id = Fiche_entreprise ';

    if(isset($_POST["apprenti_formation"]) && !empty($_POST["apprenti_formation"])) {
        $string = "Apprenti_formation = '".mysqli_real_escape_string($db, $_POST["apprenti_formation"])."'";
        $query .= where_clause($string);
    }

    if(isset($_POST["apprenti_promotion"]) && !empty($_POST["apprenti_promotion"])) {
        $string = "Apprenti_promotion = '".mysqli_real_escape_string($db, $_POST["apprenti_promotion"])."'";
        $query .= where_clause($string);
    }

    if(isset($_POST["tuteur_nom"]) && !empty($_POST["tuteur_nom"])) {
        $string = "Tuteur_nom = '".mysqli_real_escape_string($db, $_POST["tuteur_nom"])."'";
        $query .= where_clause($string);
    }

    if(isset($_POST["tuteur_prenom"]) && !empty($_POST["tuteur_prenom"])) {
        $string = "Tuteur_prenom = '".mysqli_real_escape_string($db, $_POST["tuteur_prenom"])."'";
        $query .= where_clause($string);
    }

    if(isset($_POST["entreprise_secteur"]) && !empty($_POST["entreprise_secteur"])) {
        $string = "Entreprise_secteur = '".mysqli_real_escape_string($db, $_POST["entreprise_secteur"])."'";
        $query .= where_clause($string);
    }

    if(isset($_POST["entreprise_nom"]) && !empty($_POST["entreprise_nom"])) {
        $string = "Entreprise_nom = '".mysqli_real_escape_string($db, $_POST["entreprise_nom"])."'";
        $query .= where_clause($string);
    }

    if(isset($_POST["entreprise_taille"]) && !empty($_POST["entreprise_taille"])) {
        $string = "Entreprise_taille = '".mysqli_real_escape_string($db, $_POST["entreprise_taille"])."'";
        $query .= where_clause($string);
    }

    if(isset($_POST["fiche_titre"]) && !empty($_POST["fiche_titre"])) {
        $string = "Fiche_titre = '".mysqli_real_escape_string($db, $_POST["fiche_titre"])."'";
        $query .= where_clause($string);
    }

    if(isset($_POST["fiche_problematique"]) && !empty($_POST["fiche_problematique"])) {
        $string = "Fiche_problematique = '".mysqli_real_escape_string($db, $_POST["fiche_problematique"])."'";
        $query .= where_clause($string);
    }

    if(isset($_POST["fiche_note"]) && !empty($_POST["fiche_note"])) {
        $string = "Fiche_note > '".mysqli_real_escape_string($db, $_POST["fiche_note"])."'";
        $query .= where_clause($string);
    }

    echo $query." \n";
    $result = mysqli_query($db, $query);
    if(!result) {
            echo("Error description : ".mysqli_error($db));
    } else {
        while($row = mysqli_fetch_array($result)) {
            echo "Link : ".$row[0] . "\n";
        }
    }


    mysqli_close($db);


    function where_clause($string) {
        global $first_element;
        if(!$first_element) {
            $newstring = "WHERE ".$string;
            $first_element = true;
        }
        else $newstring = "AND ".$string;

        return $newstring." ";
    }
 ?>
