<?php

// Définition des constantes pour la connexion à la base de données
const HOST = 'localhost';
const USER = 'root';
const PASS = 'root';
const DB = 'existentia_db1';

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
        <strong>Attention Erreur !</strong> la connexion a échoué !
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div><br>' . $err->getMessage();
}

if (isset($_POST["faq_question_en"], $_POST["faq_question_pt"], $_POST["faq_answer_en"], $_POST["faq_answer_pt"])) {
    // Récupération des données du formulaire d'ajout d'une section "à propos"
    $faq_question_en = htmlspecialchars(trim($_POST["faq_question_en"])); //Cette ligne de code permet de récupérer la valeur soumise dans le champ de formulaire "faq_question", de supprimer les espaces inutiles avant et après cette valeur à l'aide de la fonction trim, puis de la sécuriser en utilisant la fonction htmlspecialchars.
    $faq_question_pt = htmlspecialchars(trim($_POST["faq_question_pt"]));
    $faq_answer_en = htmlspecialchars(trim($_POST["faq_answer_en"]));
    $faq_answer_pt = htmlspecialchars(trim($_POST["faq_answer_pt"]));


    /*$file_dest = '';

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
    }*/

    $stmt = $cnn->prepare("SELECT COUNT(*) FROM faq WHERE faq_question_en=?"); // Préparation de la requête pour compter les entrées dans la table "faq" ayant le même question que celui soumis dans le formulaire
    $stmt->execute([$faq_question_en]); // Exécution de la requête avec la valeur de $faq_question_en comme paramètre
    $row = $stmt->fetchColumn(); // Récupération du nombre d'entrées retournées par la requête
    
    if ($row > 0) { // Si une entrée avec le même question existe déjà dans la base de données
        echo "La question existe déjà."; // Afficher un message d'erreur à l'utilisateur
    } else { // Sinon, si aucune entrée avec le même question n'existe dans la base de données
        $sql = "INSERT INTO faq (faq_question_en, faq_question_pt, faq_answer_en, faq_answer_pt) VALUES(?,?,?,?)"; // Préparation de la requête d'insertion pour ajouter une nouvelle entrée à la table "faq"
        $stmt = $cnn->prepare($sql); // Préparation de la requête avec la commande "prepare"
        $stmt->execute([$faq_question_en, $faq_question_pt, $faq_answer_en, $faq_answer_pt]); // Exécution de la requête avec les valeurs fournies dans un tableau sous forme de paramètres
        header('location:admin_faq.php'); // Redirection de l'utilisateur vers la page "admin_faq.php"
    }
    
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" answer="IE=edge">
    <meta name="viewport" answer="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Document</title>
</head>


<body>
    <section class="faq">
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" required placeholder="question_anglais" class="faq_box" name="faq_question_en"> <br>
            <input type="text" required placeholder="question_portugais" class="faq_box" name="faq_question_pt"> <br>
            <input type="text" required placeholder="réponse_anglais" class="faq_box" name="faq_answer_en"> <br>
            <input type="text" required placeholder="réponse_portugais" class="faq_box" name="faq_answer_pt"> <br>
            <input type="submit" value="valider">
        </form>
    </section>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</body>

</html>