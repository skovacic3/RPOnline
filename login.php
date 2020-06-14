<?php
session_start();
if(isset($_SESSION['username'])){
    header("Location:index.php");
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
            <h3>Login panel</h3>
        </div>
        <form action="" method="POST" name="registracija">
            <div class="form-item">
                <label for="username">Username</label>
                <div class="form-field" id="username">
                    <input type="text" name="username" class="form-field-textual">
                </div><br>
                <label for="password">Password</label>
                <div class="form-field" id="password">
                    <input type="password" name="password" class="form-field-textual">
                </div><br>

            </div>
            <div class="form-item">
                <div class="form-field">
                    <button type="submit" value="Prihvati" name="gumb">Login</button>
                    <a href="registracija.php"><button type="button">Registracija</button></a>
                </div>
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

<?php
    $dbc = mysqli_connect('localhost', 'root', '', 'rponline') or
    die(mysqli_connect_error());
    if ($dbc && isset($_POST['gumb'])) {
        $prijavaImeKorisnika = $_POST['username'];
        $prijavaLozinkaKorisnika = $_POST['password'];
        $sql = "SELECT username, password, razina FROM users WHERE username = ?";
        $stmt = mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $sql))
        {
            mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        }
        mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $level);
        mysqli_stmt_fetch($stmt);
        if (password_verify($_POST['password'], $lozinkaKorisnika) && mysqli_stmt_num_rows($stmt) > 0) {
            $uspjesnaPrijava = true;
            if ($level == 1) {
                $admin = true;
            } else {
                $admin = false;
            }
            //postavljanje session varijabli
            $_SESSION['username'] = $imeKorisnika;
            $_SESSION['level'] = $level;
        } else {
            $uspjesnaPrijava = false;
        }

        if (($uspjesnaPrijava == true && $admin == true) || (isset($_SESSION['$username'])) && $_SESSION['$level'] == 1) {
            echo "<div class='form-item'>
                <div class='form-field'>
                    <h1 style='margin: 0 auto'>Uspješno ste prijavljeni kao administrator.</h1>
                </div>
            </div>";
            header("Refresh:2; url=index.php");
            exit();
        } else if ($uspjesnaPrijava == true && $admin == false) {

            echo "<div class='form-item'>
                <div class='form-field'>
                    <h1 style='margin: 0 auto'>Uspješno ste prijavljeni!</h1>
                </div>
            </div>";
            header("Refresh:2; url=index.php");
            exit();
        }
        else{
            echo "<div class='form-item'>
                <div class='form-field'>
                    <h1 style='margin: 0 auto'>Kriva lozinka ili password.</h1>
                </div>
            </div>";
        }
    }
?>
