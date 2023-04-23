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

if (isset($_POST["about_title_en"], $_POST["about_title_pt"], $_POST["about_content_en"], $_POST["about_content_pt"], $_POST["about_img_alt_en"], $_POST["about_img_alt_pt"], $_POST["about_button"], $_POST["about_button_href_en"], $_POST["about_button_href_pt"])) {
    // Récupération des données du formulaire d'ajout d'une section "à propos"
    $about_title_en = htmlspecialchars(trim($_POST["about_title_en"])); //Cette ligne de code permet de récupérer la valeur soumise dans le champ de formulaire "about_title", de supprimer les espaces inutiles avant et après cette valeur à l'aide de la fonction trim, puis de la sécuriser en utilisant la fonction htmlspecialchars.
    $about_title_pt = htmlspecialchars(trim($_POST["about_title_pt"]));
    $about_content_en = htmlspecialchars(trim($_POST["about_content_en"]));
    $about_content_pt = htmlspecialchars(trim($_POST["about_content_pt"]));
    $about_img_alt_en = htmlspecialchars(trim($_POST["about_img_alt_en"]));
    $about_img_alt_pt = htmlspecialchars(trim($_POST["about_img_alt_pt"]));
    $about_button = htmlspecialchars(trim($_POST["about_button"]));
    $about_button_href_en = htmlspecialchars(trim($_POST["about_button_href_en"]));
    $about_button_href_pt = htmlspecialchars(trim($_POST["about_button_href_pt"]));

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

    $stmt = $cnn->prepare("SELECT COUNT(*) FROM about WHERE about_title_en=?"); // Préparation de la requête pour compter les entrées dans la table "about" ayant le même titre que celui soumis dans le formulaire
    $stmt->execute([$about_title_en]); // Exécution de la requête avec la valeur de $about_title_en comme paramètre
    $row = $stmt->fetchColumn(); // Récupération du nombre d'entrées retournées par la requête

    if ($row > 0) { // Si une entrée avec le même titre existe déjà dans la base de données
        echo "Le titre existe déjà."; // Afficher un message d'erreur à l'utilisateur
    } else { // Sinon, si aucune entrée avec le même titre n'existe dans la base de données
        $sql = "INSERT INTO about (about_title_en, about_title_pt, about_content_en, about_content_pt, about_img_alt_en, about_img_alt_pt, about_button, about_button_href_en, about_button_href_pt, about_img) VALUES(?,?,?,?,?,?,?,?,?,?)"; // Préparation de la requête d'insertion pour ajouter une nouvelle entrée à la table "about"
        $stmt = $cnn->prepare($sql); // Préparation de la requête avec la commande "prepare"
        $stmt->execute([$about_title_en, $about_title_pt, $about_content_en, $about_content_pt, $about_img_alt_en, $about_img_alt_pt, $about_button, $about_button_href_en, $about_button_href_pt, $file_dest]); // Exécution de la requête avec les valeurs fournies dans un tableau sous forme de paramètres
        header('location:admin_about2.php'); // Redirection de l'utilisateur vers la page "admin_about.php"
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>About</title>
</head>

<body class="container">
    <!-- ==================HEADER================== -->
    <section class="header">
        <div class="jumbotron">
            <a href="../index.php"> <img src="../assets/img/logo_existentia.png" style="position: relative;left: 19rem;width: 40%;margin-bottom: 3rem;background-color:cornflowerblue; border-radius:5px;"></a>
            <p class="lead">ABOUT_This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <a class="btn btn-primary btn-lg" href="../index.php" role="button">Learn more</a>
        </div>
    </section>

    <!-- ==================FORMULAIRE================== -->

    <section class="about">
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" required placeholder="titre_anglais" class="about_box" name="about_title_en"> <br>
            <input type="text" required placeholder="titre_portugais" class="about_box" name="about_title_pt"> <br>
            <textarea required placeholder="contenu_anglais" class="about_box" name="about_content_en"></textarea><br>
            <textarea required placeholder="contenu_portugais" class="about_box" name="about_content_pt"></textarea><br>
            <input type="file" required accept=".jpg,.jpeg,.png" class="about_box" name="uploaded_img"> <br>
            <input type="text" required placeholder="description_img_anglais" class="about_box" name="about_img_alt_en"> <br>
            <input type="text" required placeholder="description_img_portugais" class="about_box" name="about_img_alt_pt"> <br>
            <input type="text" required placeholder="bouton" class="about_box" name="about_button"> <br>
            <input type="text" required placeholder="lien_bouton_anglais" class="about_box" name="about_button_href_en"> <br>
            <input type="text" required placeholder="lien_bouton_portugais" class="about_box" name="about_button_href_pt"> <br>
            <input type="submit" value="valider">
        </form>
    </section>

    <!-- ==================AFFICHAGE DES DONNEES================== -->

    <section class="view">
        <?php
        // sélection de toutes les entrées de la table about
        $stmt = $cnn->query("SELECT * FROM about");

        //affichage des résultats
        while ($row = $stmt->fetch()) {
            echo "<img src='" . $row['about_img'] . "'alt='". $row['about_img_alt_en'] . "'>";
            echo "<img src='" . $row['about_img'] . "'alt='". $row['about_img_alt_pt'] . "'>";
            echo "<h2>" . $row['about_title_en'] . "</h2>";
            echo "<p>" . $row['about_content_en'] . "</p>";
            echo "<button><a href='" . $row['about_button_href_en'] . "'>" . $row['about_button'] . "</a></button>";
            echo "<h2>" . $row['about_title_pt'] . "</h2>";
            echo "<p>" . $row['about_content_pt'] . "</p>";
            echo "<button><a href='" . $row['about_button_href_pt'] . "'>" . $row['about_button'] . "</a></button>";
        }
        ?>
    </section>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
</body>

</html>