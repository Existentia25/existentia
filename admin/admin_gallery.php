<?php

// Définition des constantes pour la connexion à la base de données
const HOST = 'localhost';
const USER = 'root';
const PASS = 'root';
const DB = 'existentia_db1';

try {
    // Connexion à la base de données avec PDO
    $cnn = new PDO('mysql:host=' . HOST . ';dbname=' . DB . ';charset=utf8', USER, PASS);
    // Configuration du mode d'affichage des erreurs
    $cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Configuration du mode de récupération des résultats des requêtes SQL
    $cnn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $err) {
    // Affichage d'un message d'erreur si la connexion à la base de données échoue
    echo '<br><div style="box-shadow: 5px 5px 2px 0px rgba(0,0,0,0.52);" class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Attention Erreur !</strong> la connexion a échoué !
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div><br>' . $err->getMessage();
}

if (isset($_POST["gallery_title_en"], $_POST["gallery_title_pt"], $_POST["gallery_description_en"], $_POST["gallery_description_pt"], $_POST["gallery_img"], $_POST["gallery_img_alt_en"], $_POST["gallery_img_alt_pt"])) {
    // Récupération des données du formulaire d'ajout d'une section "à propos"
    $steps_title_en = htmlspecialchars(trim($_POST["gallery_title_en"])); //Cette ligne de code permet de récupérer la valeur soumise dans le champ de formulaire "steps_title", de supprimer les espaces inutiles avant et après cette valeur à l'aide de la fonction trim, puis de la sécuriser en utilisant la fonction htmlspecialchars.
    $steps_title_pt = htmlspecialchars(trim($_POST["gallery_title_pt"]));
    $steps_card_description_en = htmlspecialchars(trim($_POST["gallery_description_en"]));
    $steps_card_description_pt = htmlspecialchars(trim($_POST["gallery_description_pt"]));
    $steps_card_title_en = htmlspecialchars(trim($_POST["gallery_img_alt_en"]));
    $steps_card_title_pt = htmlspecialchars(trim($_POST["gallery_img_alt_pt"]));
    $steps_card_title_pt = htmlspecialchars(trim($_POST["gallery_img"]));

    $file_dest = '';

    // Vérification et traitement du fichier envoyé avec le formulaire
    if (!empty($_FILES['uploaded_img'])) {
        // Récupération de l'extension du fichier envoyé
        $file_extension = strrchr($_FILES['uploaded_img']['name'], ".");

        $file_tmp_name = $_FILES['uploaded_img']['tmp_name'];
        // Génération d'un nom unique pour le fichier et définition de son emplacement de destination
        $file_dest = 'uploaded_img/' . uniqid('', true) . $file_extension;

        $authorized = array('.jpg', '.JPG', '.jpeg', '.JPEG', '.png', '.PNG');

        // Vérification que l'extension du fichier est autorisée
        if (in_array($file_extension, $authorized)) {
            // Déplacement du fichier vers son emplacement de destination
            if (move_uploaded_file($file_tmp_name, $file_dest)) {
                echo 'Fichier envoyé avec Succès.';
            } else {
                echo "Erreur survenue lors de l'envoie du fichier.";
            }
        } else {
            echo 'Seules les Fichiers JPG ou PNG sont Autorisés.';
        }
    }

    $stmt = $cnn->prepare("SELECT COUNT(*) FROM gallery WHERE gallery_title_en=?"); // Préparation de la requête pour compter les entrées dans la table "gallery" ayant le même titre que celui soumis dans le formulaire
    $stmt->execute([$gallery_title_en]); // Exécution de la requête avec la valeur de $gallery_title_en comme paramètre
    $row = $stmt->fetchColumn(); // Récupération du nombre d'entrées retournées par la requête

    if ($row > 0) { // Si une entrée avec le même titre existe déjà dans la base de données
        echo "Le titre existe déjà."; // Afficher un message d'erreur à l'utilisateur
    } else { // Sinon, si aucune entrée avec le même titre n'existe dans la base de données
        $sql = "INSERT INTO gallery (gallery_title_en, gallery_title_pt, gallery_description_en, gallery_description_pt, gallery_img_alt_en, gallery_img_alt_pt, gallery_img) VALUES(?,?,?,?,?,?)"; // Préparation de la requête d'insertion pour ajouter une nouvelle entrée à la table "about"
        $stmt = $cnn->prepare($sql); // Préparation de la requête avec la commande "prepare"
        $stmt->execute([$gallery_title_en, $gallery_title_pt, $gallery_description_en, $gallery_description_pt, $gallery_img_alt_en, $gallery_img_alt_pt, $gallery_img, $file_dest]); // Exécution de la requête avec les valeurs fournies dans un tableau sous forme de paramètres
        header('location:admin_gallery2.php'); // Redirection de l'utilisateur vers la page "steps_about.php"
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<section class="about">
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" required placeholder="titre_anglais" class="gallery_box" name="gallery_title_en"> <br>
            <input type="text" required placeholder="titre_portugais" class="gallery_box" name="gallery_title_pt"> <br>
            <textarea required placeholder="description_anglais" class="gallery_box" name="gallery_description_en"></textarea><br>
            <textarea required placeholder="description_portugais" class="gallery_box" name="gallery_description_pt"></textarea><br>
            <input type="text" required placeholder="gallery_alt_en" class="gallery_box" name="gallery_img_alt_en"> <br>
            <input type="text" required placeholder="gallery_alt_pt" class="gallery_box" name="gallery_img_alt_pt"> <br>
            <input type="file" required accept=".jpg,.jpeg,.png" class="gallery_box" name="uploaded_img"> <br>
            <input type="submit" value="valider">
        </form>
    </section>
</body>

</html>
