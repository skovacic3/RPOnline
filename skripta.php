<?php

    $title = $_POST["title"];
    $about = $_POST["about"];
    $content = $_POST["content"];
    $photo = $_POST["photo"];
    $category = $_POST["category"];

    if(isset($_GET["id"])){
        $id = $_GET["id"];
    }
    else{
        $id = 0;
    }

    if(isset($_POST["archive"])){
        $archive = 1;
    }
    else{
        $archive = 0;
    }




    $dbc = mysqli_connect('localhost', 'root', '', 'RPOnline') or
    die(mysqli_connect_error());
    $datum = date("YYYY-mm-dd");
    if($dbc && $id == 0){
        $sql="INSERT INTO  article(datum,naslov,sazetak, tekst, slika, kategorija, arhiva) values (?, ?, ?, ?, ?, ?, ?)";
        $stmt=mysqli_stmt_init($dbc);
        if(mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_bind_param($stmt,'ssssssd',$datum,$title, $about, $content, $photo, $category, $archive);

            mysqli_stmt_execute($stmt);
            header("Location: index.php");
        }

    }
    else if($dbc && $id != 0){
        $sql="UPDATE article set naslov = ?, sazetak = ?, tekst = ?, slika = ?, kategorija = ?, arhiva = ? WHERE article.id = ?";
        $stmt=mysqli_stmt_init($dbc);
        if(mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_bind_param($stmt,'sssssis',$title,$about, $content, $photo, $category, $archive, $id);

            mysqli_stmt_execute($stmt);
            header("Location: index.php");
        }
    }
    else{
        echo "Connection failed";
    }
    mysqli_close($dbc);
?>