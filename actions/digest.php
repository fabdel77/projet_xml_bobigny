<?php

function digest($url) {
    try {
        $db = new PDO("mysql:dbname=fiches;host=nortri.ninja:3306", "fiches", "q75kXwDEsQbO9ftq");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $xml = simplexml_load_file($url) or die('ERROR : cannot create object');
        // print_r($xml);

        // Enregistre informations apprenti
        try{
            $stmt = $db->prepare('INSERT INTO apprenti(Apprenti_promotion, Apprenti_formation)
            VALUES (:promo, :format)');
            $stmt->bindValue(':promo', $xml->apprenti->promotion, PDO::PARAM_STR);
            $stmt->bindValue(':format', $xml->apprenti->formation, PDO::PARAM_STR);
            $stmt->execute();
            $apprenti = $db->lastInsertId();
        } catch(PDOException $e) {
            echo("Apprenti Error : ".$e->getMessage());
        }

        // Enregistre informations tuteur pedago
        try{
            $stmt = $db->prepare('INSERT INTO tuteur(Tuteur_prenom, Tuteur_nom)
            VALUES (:prenom, :nom)');
            $stmt->bindValue(':prenom', $xml->apprenti->tuteurPedago->prenom, PDO::PARAM_STR);
            $stmt->bindValue(':nom', $xml->apprenti->tuteurPedago->nom, PDO::PARAM_STR);
            $stmt->execute();
            $tuteur = $db->lastInsertId();
        } catch(PDOException $e) {
            echo ("Pedago Error : ".$e->getMessage());
        }

        // Enregistre informations entreprise
        try{
            $stmt = $db->prepare('INSERT INTO entreprise(Entreprise_nom, Entreprise_secteur, Entreprise_taille)
            VALUES (:nom, :secteur, :taille)');
            $stmt->bindValue(':nom', $xml->entreprise->nom, PDO::PARAM_STR);
            $stmt->bindValue(':secteur', $xml->entreprise->secteur, PDO::PARAM_STR);
            $stmt->bindValue(':taille', $xml->entreprise->taille, PDO::PARAM_STR);
            $stmt->execute();
            $entreprise = $db->lastInsertId();
        } catch(PDOException $e) {
            echo("Entreprise Error : ".$e->getMessage());
        }

        // Enregistre informations de la fiche memoire
        try{
            $stmt = $db->prepare('INSERT INTO fiche_memoire(Fiche_titre, Fiche_problematique,
                Fiche_note, Fiche_lien, Fiche_apprenti, Fiche_tuteur, Fiche_entreprise)
            VALUES (:titre, :problematique, :note, :lien, :apprenti, :tuteur, :entreprise)');
            $stmt->bindValue(':titre', $xml->entreprise->nom, PDO::PARAM_STR);
            $stmt->bindValue(':problematique', $xml->contenu->titre, PDO::PARAM_STR);
            $stmt->bindValue(':note', intval($xml->contenu->note), PDO::PARAM_INT);
            $stmt->bindValue(':lien', $url, PDO::PARAM_STR);
            $stmt->bindValue(':apprenti', intval($apprenti), PDO::PARAM_INT);
            $stmt->bindValue(':tuteur', intval($tuteur), PDO::PARAM_INT);
            $stmt->bindValue(':entreprise', intval($entreprise), PDO::PARAM_INT);
            $stmt->execute();
            $fiche = $db->lastInsertId();
        } catch(PDOException $e) {
            echo("Entreprise Error : ".$e->getMessage());
        }

        // Enregistre informations mot_clefs
        try{
            $stmt = $db->prepare('INSERT INTO mot_clefs(mc_mot, mc_fiche)
            VALUES (:mot, :fiche)');
            $stmt->bindValue(':mot', $xml->entreprise->nom, PDO::PARAM_STR);
            $stmt->bindValue(':fiche', intval($fiche), PDO::PARAM_INT);
            $stmt->execute();
        } catch(PDOException $e) {
            echo("Entreprise Error : ".$e->getMessage());
        }

        $db = null;
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}
 ?>
