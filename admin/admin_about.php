<?php
include  "../component/connect.php";

if (isset($_POST["about"])) {

    $about_title = $_POST["about_title"];
    $about_content = $_POST["about_content"];
    $about_img_alt_en = $_POST["about_img_alt_en"];
    $about_img_alt_pt = $_POST["about_img_alt_pt"];
    $about_button = $_POST["about_button"];
    $about_button_href = $_POST["about_button_href"];

    $about_img = $_FILES["image"]["name"];
    $about_img_size = $_FILES["image"]["size"];
    $about_img_tmp_name = $_FILES["image"]["tmp_name"];
    $about_img_folder = "../uploaded_img/" . $about_img;

 if ($about_img_size > 2000000)    {
    $message[]= "votre image est trés lourde";
 }else{
    move_uploaded_file($about_img_tmp_name, $about_img_folder);

    $insert_about= $conn->prepare("INSERT INTO `about`(about_title, about_content, about_img_alt_en, about_img_alt_pt, about_button, about_button_href, about_img ) VALUES(?,?,?,?,?,?,?)");
    $insert_about->execute([$about_title , $about_content , $about_img_alt_en , $about_img_alt_pt , $about_button , $about_button_href ,$about_img  ]);

    $message[]= "succes";
    var_dump($_POST);

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
            <input type="text" required placeholder="titre" class="about_box"> <br>
            <input type="text" required placeholder="contenu" class="about_box"> <br>
            <input type="file" required placeholder="img" class="about_box"> <br>
            <input type="text" required placeholder="alt_anglais" class="about_box"> <br>
            <input type="text" required placeholder="alt_portugais" class="about_box"> <br>
            <input type="text" required placeholder="about_button" class="about_box"> <br>
            <input type="text" required placeholder="about_href" class="about_box"> <br>
            <input type="submit" value="valider">


        </form>
    </section>
</body>

</html>