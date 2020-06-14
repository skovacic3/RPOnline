<?php
session_start();
if (!isset($_SESSION['username']))
{
    header("Location: login.php");
    die();
}
else{
    if($_SESSION['username'] == null){
        header("Location:logout.php");
        exit();
    }
    if($_SESSION['level'] != 1){
        echo "<h1>Nemate ovlasti.</h1>";
        header("Refresh:2; url=index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>RP Online</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="jquery-1.11.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="form-validation.js"></script>
</head>
<body>
<header>
    <div id="mainHeader">
        <a href="index.php"><img src="logo.png"></a>
        <ul>
            <li><a href="index.php">HOME</a></li>
            <li><a href="kategorija.php?kategorija=politika">POLITIKA</a></li>
            <li><a href="kategorija.php?kategorija=sport">SPORT</a></li>
            <li><a href="administracija.php">ADMINISTRACIJA</a></li>
        </ul>
    </div>
</header>
<section>
    <div class="mainSection">
        <div class="title">
            <h3>Unos</h3>
        </div>
        <form action="skripta.php?id=0" method="POST" name="myForm">
            <div class="form-item">
                <label for="title">Naslov vijesti</label>
                <div class="form-field" id="title">
                    <input type="text" name="title" class="form-field-textual">
                </div>
            </div>
            <div class="form-item">
                <label for="about">Kratki sadržaj vijesti (do 50 znakova)</label>
                <div class="form-field" id="about">
                    <textarea name="about" cols="30" rows="10" class="formfield-textual"></textarea>
                </div>
            </div>
            <div class="form-item">
                <label for="content">Sadržaj vijesti</label>
                <div class="form-field" id="content">
                    <textarea name="content" cols="30" rows="10" class="form-field-textual"></textarea>
                </div>
            </div>
            <div class="form-item">
                <label for="photo">Slika: </label>
                <div class="form-field" id="photo">
                    <input type="file" accept="image/jpg" class="input-text" name="photo"/>
                </div>
            </div>
            <div class="form-item">
                <label for="category">Kategorija vijesti</label>
                <div class="form-field" id="category">
                    <select name="category" id="" class="form-field-textual">
                        <option value="sport">Sport</option>
                        <option value="politika">Politika</option>
                    </select>
                </div>
            </div>
            <div class="form-item">
                <label>Spremiti u arhivu:</label>
                <div class="form-field">
                    <input type="checkbox" name="archive">
                </div>
            </div>
            <div class="form-item">
                <button type="reset" value="Poništi">Poništi</button>
                <button type="submit" value="Prihvati">Prihvati</button>
            </div>
        </form>
    </div>
</section>
<footer>
    <h3>RP DIGITAL GMBH | ALLE RECHTE WORBEHALTEN</h3>
    <p>Content Management by Sven</p>
</footer>
</body>
</html>
