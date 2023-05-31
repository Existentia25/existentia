<?php

// Définition des constantes pour la connexion à la base de données
const HOST = 'localhost';
const USER = 'root';
const PASS = '';
const DB = 'existentia_db';

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

if (isset($_POST["about_title_en"], $_POST["about_title_pt"], $_POST["about_content_en"], $_POST["about_content_pt"], $_POST["about_img_alt_en"], $_POST["about_img_alt_pt"], $_POST["about_button_en"], $_POST["about_button_pt"], $_POST["about_button_href_en"], $_POST["about_button_href_pt"])) {
    // Récupération des données du formulaire d'ajout d'une section "à propos"
    $about_title_en = htmlspecialchars(trim($_POST["about_title_en"])); //Cette ligne de code permet de récupérer la valeur soumise dans le champ de formulaire "about_title", de supprimer les espaces inutiles avant et après cette valeur à l'aide de la fonction trim, puis de la sécuriser en utilisant la fonction htmlspecialchars.
    $about_title_pt = htmlspecialchars(trim($_POST["about_title_pt"]));
    $about_content_en = htmlspecialchars(trim($_POST["about_content_en"]));
    $about_content_pt = htmlspecialchars(trim($_POST["about_content_pt"]));
    $about_img_alt_en = htmlspecialchars(trim($_POST["about_img_alt_en"]));
    $about_img_alt_pt = htmlspecialchars(trim($_POST["about_img_alt_pt"]));
    $about_button_en = htmlspecialchars(trim($_POST["about_button_en"]));
    $about_button_pt = htmlspecialchars(trim($_POST["about_button_pt"]));
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
                echo "Fichier envoyé avec Succès.";
            } else {
                echo "Erreur survenue lors de l'envoie du fichier.";
            }
        } else {
            echo "Seules les Fichiers JPG ou PNG sont Autorisés.";
        }
    }

    $stmt = $cnn->prepare("SELECT COUNT(*) FROM about WHERE about_title_en=?"); // Préparation de la requête pour compter les entrées dans la table "about" ayant le même titre que celui soumis dans le formulaire
    $stmt->execute([$about_title_en]); // Exécution de la requête avec la valeur de $about_title_en comme paramètre
    $row = $stmt->fetchColumn(); // Récupération du nombre d'entrées retournées par la requête

    if ($row > 0) { // Si une entrée avec le même titre existe déjà dans la base de données
        echo "Le titre existe déjà."; // Afficher un message d'erreur à l'utilisateur
    } else { // Sinon, si aucune entrée avec le même titre n'existe dans la base de données
        $sql = "INSERT INTO about (about_title_en, about_title_pt, about_content_en, about_content_pt, about_img_alt_en, about_img_alt_pt, about_button_en, about_button_pt, about_button_href_en, about_button_href_pt, about_img) VALUES(?,?,?,?,?,?,?,?,?,?,?)"; // Préparation de la requête d'insertion pour ajouter une nouvelle entrée à la table "about"
        $stmt = $cnn->prepare($sql); // Préparation de la requête avec la commande "prepare"
        $stmt->execute([$about_title_en, $about_title_pt, $about_content_en, $about_content_pt, $about_img_alt_en, $about_img_alt_pt, $about_button_en, $about_button_pt, $about_button_href_en, $about_button_href_pt, $file_dest]); // Exécution de la requête avec les valeurs fournies dans un tableau sous forme de paramètres
        header('location:section_about.php'); // Redirection de l'utilisateur vers la page "section_about.php"
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js" integrity="sha512-yqTiaLfePJfjWGSBCycnnjPf8arvTBFA4fXVESVG+FHz5tP4FWBFiYn0uUAuJ7gfTS4eDGvm9N6Ncqukvv73vg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <title>Existentia || Backoffice
<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff"></title>
</head>

<body>
    <div class="container">
         <!-- ==================HEADER================== -->
        <div class="jumbotron" style="text-align: center">
            <img src="../assets/img/logo.png" alt="">
            <h1 class="display-4">About Section</h1>
        </div>

        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="backoffice.html" style="color: #0275d8">Backoffice</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="sections.html" style="color: #0275d8">Sections</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">About</li>
                </ol>
            </nav>
        </div>
        
<!-- ==================FORMULAIRE================== -->
        
        <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="row">
                    <div class="form-group position-relative" style="left:31rem;margin-bottom:3rem;">
                        <label for="exampleFormControlFile1">Image</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1" accept=".jpg,.jpeg,.png" name="uploaded_img" required/>
                        <div class="valid-feedback"> Ok !</div>
                        <div class="invalid-feedback"> Valeur incorrecte</div>
                    </div>
            </div>
            <div class="row">
                <div class="col-sm-6">    
                    <h2>About Anglais</h2>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Title</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="about_title_en" required/>
                        <div class="valid-feedback"> Ok !</div>
                        <div class="invalid-feedback"> Valeur incorrecte</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Content</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="about_content_en" rows="3" required></textarea>
                        <div class="valid-feedback"> Ok !</div>
                        <div class="invalid-feedback"> Valeur incorrecte</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleFormControlTextarea2">Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea2" name="about_img_alt_en" rows="3" required></textarea>                 
                        <div class="valid-feedback"> Ok !</div>
                        <div class="invalid-feedback"> Valeur incorrecte</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Button</label>
                        <input type="text" class="form-control" id="exampleFormControlInput2" name="about_button_en" required/>
                        <div class="valid-feedback"> Ok !</div>
                        <div class="invalid-feedback"> Valeur incorrecte</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleFormControlInput3">Button Direction</label>
                        <input type="text" class="form-control" id="exampleFormControlInput3" name="about_button_href_en" required/>
                        <div class="valid-feedback"> Ok !</div>
                        <div class="invalid-feedback"> Valeur incorrecte</div>
                    </div>                                   
                </div>
                <div class="col-sm-6">
                    <h2>About Portugais</h2>

                    <div class="form-group">
                        <label for="exampleFormControlInput4">Título</label>
                        <input type="text" class="form-control" id="exampleFormControlInput4" name="about_title_pt" required/>
                        <div class="valid-feedback"> Ok !</div>
                        <div class="invalid-feedback"> Valeur incorrecte</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleFormControlTextarea3">Contente</label>
                        <textarea class="form-control" id="exampleFormControlTextarea3" name="about_content_pt" rows="3" required></textarea>
                        <div class="valid-feedback"> Ok !</div>
                        <div class="invalid-feedback"> Valeur incorrecte</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleFormControlTextarea4">Descrição</label>
                        <textarea class="form-control" id="exampleFormControlTextarea4" name="about_img_alt_pt" rows="3" required></textarea>
                        <div class="valid-feedback"> Ok !</div>
                        <div class="invalid-feedback"> Valeur incorrecte</div>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput5">Botão</label>
                        <input type="text" class="form-control" id="exampleFormControlInput5" name="about_button_pt" required/>
                        <div class="valid-feedback"> Ok !</div>
                        <div class="invalid-feedback"> Valeur incorrecte</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleFormControlInput6">Direção do botão</label>
                        <input type="text" class="form-control" id="exampleFormControlInput6" name="about_button_href_pt" required/>
                        <div class="valid-feedback"> Ok !</div>
                        <div class="invalid-feedback"> Valeur incorrecte</div>
                    </div>                    
                </div>
                    <div class="position-relative" style="left:33rem;margin-top:3rem;">
                    <button type="submit" class="btn btn-primary" value="valider">Valider</button>
                    </div>
            </div>    
        </form>
    </div>

    <!-- ==================AFFICHAGE DES DONNEES================== -->

    <section class="view">
        <?php
        // sélection de toutes les entrées de la table about
        $stmt = $cnn->query("SELECT * FROM about ORDER BY id_about DESC"); ?>

        <!-- affichage des résultats -->
        <?php while ($row = $stmt->fetch()) : ?>
            <div class="image offset-3">
                <img src=<?= $row['about_img'] ?> alt=<?= $row['about_img_alt_en'] ?> alt=<?= $row['about_img_alt_pt'] ?>>
            </div>
            <div class="row offset-2">
                <div class="col-sm-6">
                    <div class="view_en">
                        <h2>About Anglais</h2>
                        <h2> <?= $row['about_title_en'] ?> </h2>
                        <p> <?= $row['about_content_en'] ?> </p>
                        <button><a href=<?= $row['about_button_href_en'] . "'>" . $row['about_button_en'] ?>> </a></button>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="view_pt">
                        <h2>About Portugais</h2>
                        <h2> <?= $row['about_title_pt'] ?> </h2>
                        <p> <?= $row['about_content_pt'] ?> </p>
                        <button><a href=<?= $row['about_button_href_pt'] . "'>" . $row['about_button_pt'] ?>> </a></button>
                    </div>
                    <br>
                </div>
            </div>
        <?php endwhile ?>
    </section>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
    <script>
    /*La fonction principale de ce script est d'empêcher l'envoi du formulaire si un champ a été mal rempli
            et d'appliquer les styles de validation aux différents éléments de formulaire */
           (function() {
             'use strict';
             window.addEventListener('load', function() {
               let forms = document.getElementsByClassName('needs-validation');
               let validation = Array.prototype.filter.call(forms, function(form) {
                 form.addEventListener('submit', function(event) {
                   if (form.checkValidity() === false) {
                     event.preventDefault();
                     event.stopPropagation();
                   }
                   form.classList.add('was-validated');
                 }, false);
               });
             }, false);
           })();
         </script>
</body>

</html>
