<?php

// Définition des constantes pour la connexion à la base de données
const HOST = 'localhost';
const USER = 'root';
const PASS = '';
const DB = 'existentia_db';

try {
    // Connexion à la base de données avec PDO
    $cnn = new PDO('mysql:host='.HOST.';dbname='.DB.';charset=utf8', USER, PASS);
    // Configuration du mode d'affichage des erreurs
    $cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Configuration du mode de récupération des résultats des requêtes SQL
    $cnn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $err) {
    // Affichage d'un message d'erreur si la connexion à la base de données échoue
    echo '<br><div style="box-shadow: 5px 5px 2px 0px rgba(0,0,0,0.52);" class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Attention Erreur !</strong> la connexion à échoué !
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div><br>' . $err->getMessage();
}

if (isset($_POST["about_mozambique_title"], $_POST["about_mozambique_content"], $_POST["about_mozambique_img_alt_en"], $_POST["about_mozambique_img_alt_pt"], $_POST["about_mozambique_button"], $_POST["about_mozambique_button_href"])) {
    // Récupération des données du formulaire d'ajout d'une section "à propos"
    $about_mozambique_title = htmlspecialchars(trim($_POST["about_mozambique_title"])); //Cette ligne de code permet de récupérer la valeur soumise dans le champ de formulaire "about_title", de supprimer les espaces inutiles avant et après cette valeur à l'aide de la fonction trim, puis de la sécuriser en utilisant la fonction htmlspecialchars.
    $about_mozambique_content = htmlspecialchars(trim($_POST["about_mozambique_content"]));
    $about_mozambique_img_alt_en = htmlspecialchars(trim($_POST["about_mozambique_img_alt_en"]));
    $about_mozambique_img_alt_pt = htmlspecialchars(trim($_POST["about_mozambique_img_alt_pt"]));
    $about_mozambique_button = htmlspecialchars(trim($_POST["about_mozambique_button"]));
    $about_mozambique_button_href = htmlspecialchars(trim($_POST["about_mozambique_button_href"]));


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

    $stmt = $cnn->prepare("SELECT COUNT(*) FROM about_mozambique WHERE about_mozambique_title=?"); // Préparation de la requête pour compter les entrées dans la table "about" ayant le même titre que celui soumis dans le formulaire
    $stmt->execute([$about_mozambique_title]); // Exécution de la requête avec la valeur de $about_mozambique_title comme paramètre
    $row = $stmt->fetchColumn(); // Récupération du nombre d'entrées retournées par la requête
    
    if ($row > 0) { // Si une entrée avec le même titre existe déjà dans la base de données
        echo "Le titre existe déjà."; // Afficher un message d'erreur à l'utilisateur
    } else { // Sinon, si aucune entrée avec le même titre n'existe dans la base de données
        $sql = "INSERT INTO about_mozambique (about_mozambique_title, about_mozambique_content, about_mozambique_img_alt_en, about_mozambique_img_alt_pt, about_mozambique_button, about_mozambique_button_href, about_mozambique_img ) VALUES(?,?,?,?,?,?,?)"; // Préparation de la requête d'insertion pour ajouter une nouvelle entrée à la table "about_mozambique"
        $stmt = $cnn->prepare($sql); // Préparation de la requête avec la commande "prepare"
        $stmt->execute([$about_mozambique_title, $about_mozambique_content, $about_mozambique_img_alt_en, $about_mozambique_img_alt_pt, $about_mozambique_button, $about_mozambique_button_href, $file_dest]); // Exécution de la requête avec les valeurs fournies dans un tableau sous forme de paramètres
        header('location:admin_about_mozambique.php'); // Redirection de l'utilisateur vers la page "admin_mozambique_about.php"
    }
    
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Document</title>
</head>


<body>
    <section class="about">
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" required placeholder="titre" class="about_box" name="about_mozambique_title"> <br>
            <input type="text" required placeholder="contenu" class="about_box" name="about_mozambique_content"> <br>
            <input type="file" required accept=".jpg,.jpeg,.png" class="about_box" name="uploaded_img"> <br>
            <input type="text" required placeholder="alt_anglais" class="about_box" name="about_mozambique_img_alt_en"> <br>
            <input type="text" required placeholder="alt_portugais" class="about_box" name="about_mozambique_img_alt_pt"> <br>
            <input type="text" required placeholder="about_button" class="about_box" name="about_mozambique_button"> <br>
            <input type="text" required placeholder="about_href" class="about_box" name="about_mozambique_button_href"> <br>
            <input type="submit" value="valider">
        </form>
    </section>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</body>

</html>