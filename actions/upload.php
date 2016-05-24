<?php
    include_once('./digest.php');

    $target_dir = "../xmls/";
    $target_file = $target_dir.basename($_FILES["input_name"]["name"]);
    $upload_ok = true;
    $file_type = pathinfo($target_file,PATHINFO_EXTENSION);
    if(isset($_POST["submit"])) {
        $upload_ok = true;
    } else {
        $upload_ok = false;
        echo ("Aucun fichier envoyé.");
    }

    if(file_exists($target_file)) {
        echo("Fichier portant ce nom déjà existant");
        $upload_ok = false;
    }
    if($file_type != "xml") {
        echo("Le fichier soumis n'est pas au format xml");
        $upload_ok = false;
    }

    if(!$upload_ok) {
        echo("Fichier non enregistré. Veuillez réessayer.");
    } else {
        if(move_uploaded_file($_FILES["input_name"]["tmp_name"], $target_file)) {
            echo("Le fichier ".basename($_FILES["input_name"]["name"]). "a été envoyé");
            digest($target_file);
        } else {
            echo("Erreur lors de l'envois de votre fichier");
        }
    }


?>
