<?php
session_start();
if(isset($_SESSION['username'])){
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
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
            <h3>Registracija</h3>
        </div>
        <form action="" method="POST" name="registracija">
            <div class="form-item">
                <label for="ime">Unesite svoje ime</label>
                <div class="form-field" id="ime">
                    <input type="text" name="ime" class="form-field-textual">
                </div><br>
                <label for="prezime">Unesite svoje prezime</label>
                <div class="form-field" id="prezime">
                    <input type="text" name="prezime" class="form-field-textual">
                </div><br>
                <label for="username">Unesite username</label>
                <div class="form-field" id="username">
                    <input type="text" name="username" class="form-field-textual">
                </div><br>
                <label for="password">Unesite password</label>
                <div class="form-field" id="password">
                    <input type="password" name="password" class="form-field-textual">
                </div><br>

            </div>
            <div class="form-item">
                <div class="form-field" id="password">
                    <button type="submit" name="gumb" value="Prihvati">Registriraj me</button>
                </div>
            </div>
        </form>
    </div>
</section>

<?php
$user = "";
$pw = "";
$ime = "";
$prezime = "";
$razinaDefault = 0;
if(isset($_POST['username'])){
    $user = $_POST['username'];
}
if(isset($_POST['password'])){
    $pw = $_POST['password'];
}
if(isset($_POST['ime'])){
    $ime = $_POST['ime'];
}
if(isset($_POST['prezime'])){
    $prezime = $_POST['prezime'];
}
$hashed_pw = password_hash($pw, CRYPT_BLOWFISH);
$dbc = mysqli_connect('localhost', 'root', '', 'rponline') or
die(mysqli_connect_error());
if ($dbc && isset($_POST['gumb'])) {
    $query = "SELECT * FROM users WHERE username = '$user'";
    $result = mysqli_query($dbc, $query);
    if(mysqli_num_rows($result)==0){
        $sql="INSERT INTO users (ime,prezime,username, password, razina) values (?, ?, ?, ?, ?)";
        $stmt=mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $sql) && isset($_POST['gumb'])){
            echo "<div class='form-item'>
                <div class='form-field' id='password'>
                    <h1 style='margin: 0 auto'>Uspješno ste registrirani!</h1>
                </div>
            </div>";
            mysqli_stmt_bind_param($stmt,'ssssd',$ime,$prezime,$user,$hashed_pw, $razinaDefault);

            /* Izvršava pripremljeni upit */
            mysqli_stmt_execute($stmt);
            header("Refresh:2; url=login.php");
            exit();
        }
    }
    else if(isset($_POST['gumb'])){
        echo "<div class='form-item'>
                <div class='form-field' id='password'>
                    <h1 style='margin: 0 auto'>Username vec postoji</h1>
                </div>
            </div>";
    }
}
mysqli_close($dbc);
?>
</body>
</html>