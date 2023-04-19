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

if (isset($_POST["faq_question_en1"], $_POST["faq_question_pt1"], $_POST["faq_answer_en1"], $_POST["faq_answer_pt1"], $_POST["faq_question_en2"], $_POST["faq_question_pt2"], $_POST["faq_answer_en2"], $_POST["faq_answer_pt2"], $_POST["faq_question_en3"], $_POST["faq_question_pt3"], $_POST["faq_answer_en3"], $_POST["faq_answer_pt3"], 
$_POST["faq_question_en4"], $_POST["faq_question_pt4"], $_POST["faq_answer_en4"], $_POST["faq_answer_pt4"], $_POST["faq_question_en5"], $_POST["faq_question_pt5"], $_POST["faq_answer_en5"], $_POST["faq_answer_pt5"], $_POST["faq_question_en6"], $_POST["faq_question_pt6"], $_POST["faq_answer_en6"], $_POST["faq_answer_pt6"], 
$_POST["faq_question_en7"], $_POST["faq_question_pt7"], $_POST["faq_answer_en7"], $_POST["faq_answer_pt7"], $_POST["faq_question_en8"], $_POST["faq_question_pt8"], $_POST["faq_answer_en8"], $_POST["faq_answer_pt8"])) {
    // Récupération des données du formulaire d'ajout d'une section "à propos"
    $faq_question_en1 = htmlspecialchars(trim($_POST["faq_question_en1"])); //Cette ligne de code permet de récupérer la valeur soumise dans le champ de formulaire "faq_question", de supprimer les espaces inutiles avant et après cette valeur à l'aide de la fonction trim, puis de la sécuriser en utilisant la fonction htmlspecialchars.
    $faq_question_pt1 = htmlspecialchars(trim($_POST["faq_question_pt1"]));
    $faq_answer_en1 = htmlspecialchars(trim($_POST["faq_answer_en1"]));
    $faq_answer_pt1 = htmlspecialchars(trim($_POST["faq_answer_pt1"]));
    $faq_question_en2 = htmlspecialchars(trim($_POST["faq_question_en2"])); 
    $faq_question_pt2 = htmlspecialchars(trim($_POST["faq_question_pt2"]));
    $faq_answer_en2 = htmlspecialchars(trim($_POST["faq_answer_en2"]));
    $faq_answer_pt2 = htmlspecialchars(trim($_POST["faq_answer_pt2"]));
    $faq_question_en3 = htmlspecialchars(trim($_POST["faq_question_en3"])); 
    $faq_question_pt3 = htmlspecialchars(trim($_POST["faq_question_pt3"]));
    $faq_answer_en3 = htmlspecialchars(trim($_POST["faq_answer_en3"]));
    $faq_answer_pt3 = htmlspecialchars(trim($_POST["faq_answer_pt3"]));
    $faq_question_en4 = htmlspecialchars(trim($_POST["faq_question_en4"])); 
    $faq_question_pt4 = htmlspecialchars(trim($_POST["faq_question_pt4"]));
    $faq_answer_en4 = htmlspecialchars(trim($_POST["faq_answer_en4"]));
    $faq_answer_pt4 = htmlspecialchars(trim($_POST["faq_answer_pt4"]));
    $faq_question_en5 = htmlspecialchars(trim($_POST["faq_question_en5"])); 
    $faq_question_pt5 = htmlspecialchars(trim($_POST["faq_question_pt5"]));
    $faq_answer_en5 = htmlspecialchars(trim($_POST["faq_answer_en5"]));
    $faq_answer_pt5 = htmlspecialchars(trim($_POST["faq_answer_pt5"]));
    $faq_question_en6 = htmlspecialchars(trim($_POST["faq_question_en6"])); 
    $faq_question_pt6 = htmlspecialchars(trim($_POST["faq_question_pt6"]));
    $faq_answer_en6 = htmlspecialchars(trim($_POST["faq_answer_en6"]));
    $faq_answer_pt6 = htmlspecialchars(trim($_POST["faq_answer_pt6"]));
    $faq_question_en7 = htmlspecialchars(trim($_POST["faq_question_en7"])); 
    $faq_question_pt7 = htmlspecialchars(trim($_POST["faq_question_pt7"]));
    $faq_answer_en7 = htmlspecialchars(trim($_POST["faq_answer_en7"]));
    $faq_answer_pt7 = htmlspecialchars(trim($_POST["faq_answer_pt7"]));
    $faq_question_en8 = htmlspecialchars(trim($_POST["faq_question_en8"])); 
    $faq_question_pt8 = htmlspecialchars(trim($_POST["faq_question_pt8"]));
    $faq_answer_en8 = htmlspecialchars(trim($_POST["faq_answer_en8"]));
    $faq_answer_pt8 = htmlspecialchars(trim($_POST["faq_answer_pt8"]));


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

    $stmt = $cnn->prepare("SELECT COUNT(*) FROM faq WHERE faq_question_en1=?"); // Préparation de la requête pour compter les entrées dans la table "faq" ayant le même question que celui soumis dans le formulaire
    $stmt->execute([$faq_question_en1]); // Exécution de la requête avec la valeur de $faq_question_en comme paramètre
    $row = $stmt->fetchColumn(); // Récupération du nombre d'entrées retournées par la requête
    
    if ($row > 0) { // Si une entrée avec le même question existe déjà dans la base de données
        echo "La question existe déjà."; // Afficher un message d'erreur à l'utilisateur
    } else { // Sinon, si aucune entrée avec le même question n'existe dans la base de données
        $sql = "INSERT INTO faq (faq_question_en1, faq_question_pt1, faq_answer_en1, faq_answer_pt1, faq_question_en2, faq_question_pt2, faq_answer_en2, faq_answer_pt2, faq_question_en3, faq_question_pt3, faq_answer_en3, faq_answer_pt3, faq_question_en4, faq_question_pt4, faq_answer_en4, faq_answer_pt4,
        faq_question_en5, faq_question_pt5, faq_answer_en5, faq_answer_pt5, faq_question_en6, faq_question_pt6, faq_answer_en6, faq_answer_pt6, faq_question_en7, faq_question_pt7, faq_answer_en7, faq_answer_pt7, faq_question_en8, faq_question_pt8, faq_answer_en8, faq_answer_pt8) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"; // Préparation de la requête d'insertion pour ajouter une nouvelle entrée à la table "faq"
        $stmt = $cnn->prepare($sql); // Préparation de la requête avec la commande "prepare2
        $stmt->execute([$faq_question_en1, $faq_question_pt1, $faq_answer_en1, $faq_answer_pt1, $faq_question_en2, $faq_question_pt2, $faq_answer_en2, $faq_answer_pt2, $faq_question_en3, $faq_question_pt3, $faq_answer_en3, $faq_answer_pt3, $faq_question_en4, $faq_question_pt4, $faq_answer_en4, $faq_answer_pt4, $faq_question_en5, $faq_question_pt5, $faq_answer_en5, $faq_answer_pt5,
        $faq_question_en6, $faq_question_pt6, $faq_answer_en6, $faq_answer_pt6, $faq_question_en7, $faq_question_pt7, $faq_answer_en7, $faq_answer_pt7, $faq_question_en8, $faq_question_pt8, $faq_answer_en8, $faq_answer_pt8]); // Exécution de la requête avec les valeurs fournies dans un tableau sous forme de paramètres
        header('location:admin_faq2.php'); // Redirection de l'utilisateur vers la page "admin_faq.php"
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

    <title>FAQs</title>
</head>

<body class="container">
    <!-- ==================HEADER================== -->
    <section class="header">
        <div class="jumbotron">
            <a href="../index.php"> <img src="../assets/img/logo_existentia.png" style="position: relative;left: 19rem;width: 40%;margin-bottom: 3rem;background-color:cornflowerblue; border-radius:5px;"></a>
            <p class="lead">FAQs_This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <a class="btn btn-primary btn-lg" href="../index.php" role="button">Learn more</a>
        </div>
    </section>

    <!-- ==================FORMULAIRE================== -->


<body>
    <section class="faq">
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" required placeholder="question_anglais" class="faq_box" name="faq_question_en1"> <br>
            <input type="text" required placeholder="question_portugais" class="faq_box" name="faq_question_pt1"> <br>
            <textarea required placeholder="réponse_anglais" class="faq_box" name="faq_answer_en1"></textarea><br>
            <textarea required placeholder="réponse_portugais" class="faq_box" name="faq_answer_pt1"></textarea><br>
            <input type="text" required placeholder="question_anglais" class="faq_box" name="faq_question_en2"> <br>
            <input type="text" required placeholder="question_portugais" class="faq_box" name="faq_question_pt2"> <br>
            <textarea required placeholder="réponse_anglais" class="faq_box" name="faq_answer_en2"></textarea><br>
            <textarea required placeholder="réponse_portugais" class="faq_box" name="faq_answer_pt2"></textarea><br>
            <input type="text" required placeholder="question_anglais" class="faq_box" name="faq_question_en3"> <br>
            <input type="text" required placeholder="question_portugais" class="faq_box" name="faq_question_pt3"> <br>
            <textarea required placeholder="réponse_anglais" class="faq_box" name="faq_answer_en3"></textarea><br>
            <textarea required placeholder="réponse_portugais" class="faq_box" name="faq_answer_pt3"></textarea><br>
            <input type="text" required placeholder="question_anglais" class="faq_box" name="faq_question_en4"> <br>
            <input type="text" required placeholder="question_portugais" class="faq_box" name="faq_question_pt4"> <br>
            <textarea required placeholder="réponse_anglais" class="faq_box" name="faq_answer_en4"></textarea><br>
            <textarea required placeholder="réponse_portugais" class="faq_box" name="faq_answer_pt4"></textarea><br>
            <input type="text" required placeholder="question_anglais" class="faq_box" name="faq_question_en5"> <br>
            <input type="text" required placeholder="question_portugais" class="faq_box" name="faq_question_pt5"> <br>
            <textarea required placeholder="réponse_anglais" class="faq_box" name="faq_answer_en5"></textarea><br>
            <textarea required placeholder="réponse_portugais" class="faq_box" name="faq_answer_pt5"></textarea><br>
            <input type="text" required placeholder="question_anglais" class="faq_box" name="faq_question_en6"> <br>
            <input type="text" required placeholder="question_portugais" class="faq_box" name="faq_question_pt6"> <br>
            <textarea required placeholder="réponse_anglais" class="faq_box" name="faq_answer_en6"></textarea><br>
            <textarea required placeholder="réponse_portugais" class="faq_box" name="faq_answer_pt6"></textarea><br>
            <input type="text" required placeholder="question_anglais" class="faq_box" name="faq_question_en7"> <br>
            <input type="text" required placeholder="question_portugais" class="faq_box" name="faq_question_pt7"> <br>
            <textarea required placeholder="réponse_anglais" class="faq_box" name="faq_answer_en7"></textarea><br>
            <textarea required placeholder="réponse_portugais" class="faq_box" name="faq_answer_pt7"></textarea><br>
            <input type="text" required placeholder="question_anglais" class="faq_box" name="faq_question_en8"> <br>
            <input type="text" required placeholder="question_portugais" class="faq_box" name="faq_question_pt8"> <br>
            <textarea required placeholder="réponse_anglais" class="faq_box" name="faq_answer_en8"></textarea><br>
            <textarea required placeholder="réponse_portugais" class="faq_box" name="faq_answer_pt8"></textarea><br>
            <input type="submit" value="valider">
        </form>
    </section>


    <!-- ==================AFFICHAGE DES DONNEES================== -->

    <section class="view">
        <?php
        // sélection de toutes les entrées de la table faq
        $stmt = $cnn->query("SELECT * FROM faq");

        //affichage des résultats
        while ($row = $stmt->fetch()) {
           
            echo "<h3>" . $row['faq_question_en1'] . "</h3>";
            echo "<p>" . $row['faq_answer_en1'] . "</p>";
            echo "<h3>" . $row['faq_question_pt1'] . "</h3>";
            echo "<p>" . $row['faq_answer_pt1'] . "</p>";
            echo "<h3>" . $row['faq_question_en2'] . "</h3>";
            echo "<p>" . $row['faq_answer_en2'] . "</p>";
            echo "<h3>" . $row['faq_question_pt2'] . "</h3>";
            echo "<p>" . $row['faq_answer_pt2'] . "</p>";
            echo "<h3>" . $row['faq_question_en3'] . "</h3>";
            echo "<p>" . $row['faq_answer_en3'] . "</p>";
            echo "<h3>" . $row['faq_question_pt3'] . "</h3>";
            echo "<p>" . $row['faq_answer_pt3'] . "</p>";
            echo "<h3>" . $row['faq_question_en4'] . "</h3>";
            echo "<p>" . $row['faq_answer_en4'] . "</p>";
            echo "<h3>" . $row['faq_question_pt4'] . "</h3>";
            echo "<p>" . $row['faq_answer_pt4'] . "</p>";
            echo "<h3>" . $row['faq_question_en5'] . "</h3>";
            echo "<p>" . $row['faq_answer_en5'] . "</p>";
            echo "<h3>" . $row['faq_question_pt5'] . "</h3>";
            echo "<p>" . $row['faq_answer_pt5'] . "</p>";
            echo "<h3>" . $row['faq_question_en6'] . "</h3>";
            echo "<p>" . $row['faq_answer_en6'] . "</p>";
            echo "<h3>" . $row['faq_question_pt6'] . "</h3>";
            echo "<p>" . $row['faq_answer_pt6'] . "</p>";
            echo "<h3>" . $row['faq_question_en7'] . "</h3>";
            echo "<p>" . $row['faq_answer_en7'] . "</p>";
            echo "<h3>" . $row['faq_question_pt7'] . "</h3>";
            echo "<p>" . $row['faq_answer_pt7'] . "</p>";
            echo "<h3>" . $row['faq_question_en8'] . "</h3>";
            echo "<p>" . $row['faq_answer_en8'] . "</p>";
            echo "<h3>" . $row['faq_question_pt8'] . "</h3>";
            echo "<p>" . $row['faq_answer_pt8'] . "</p>";
            
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