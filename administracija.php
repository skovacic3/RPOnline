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
        <a href="index.php"><img src="logo.png" alt="logo"></a>
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
            <h3>Admin panel</h3>
        </div>
        <form method="post">
            <div class='form-item'>
                <div class='form-field'>
                    <button type="button" value='dodaj' style='width: 80%;' onclick="location.href='unos.php';">Dodaj
                        novi članak
                    </button>
                </div>
            </div>

            <?php
            $dbc = mysqli_connect('localhost', 'root', '', 'RPOnline') or
            die(mysqli_connect_error());
            if ($dbc) {
                echo "
                        <div class='form-item'>
                            <div class='form-field'>";
                $query = "SELECT * FROM article";
                $result = mysqli_query($dbc, $query);
                echo "<select name='clanak' id='' class='form-field-textual'>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='" . $row["id"] . "'>" . $row["naslov"] . "</option>";
                }
                echo "</select>";
                echo "</div>";
                echo "<button name='edit' value='edit' style='margin-top: 15px;'>Uredi članak</button>
                            <button name='delete' value='delete'>Izbriši članak</button>
                        </div>
                        </section>
                        </form>";


                if (isset($_POST['edit'])) {
                    $id = $_POST['clanak'];
                    $query = "SELECT * FROM article WHERE id = $id";
                    $result = mysqli_query($dbc, $query);
                    $row = mysqli_fetch_array($result);
                    if ($_POST['edit']) {
                        writeEdit($row, $id);
                    }
                }
                if (isset($_POST['delete'])) {
                    $id = $_POST['clanak'];
                    $query = "DELETE FROM article WHERE id = $id";
                    $result = mysqli_query($dbc, $query);
                    header("Refresh:0");
                }
            } else {
                echo "Connection failed";
            }
            mysqli_close($dbc);
            ?>
            <footer>
                <h3>RP DIGITAL GMBH | ALLE RECHTE WORBEHALTEN</h3>
                <p>Content Management by Sven</p>
                <?php
                if(isset($_SESSION['username'])) {
                    if ($_SESSION['username']) {
                        echo "<p>Logged in as " . $_SESSION['username'] . "<a href='logout.php' style='color:white; text-decoration: none'>  Logout</a></p>";
                    }
                }
                ?>
            </footer>
</body>
</html>

<?php
function writeEdit($row, $id)
{
    echo "<section>
                <div class='mainSection'>
                    <div class='title'>
                        <h3>Editanje " . $row['naslov'] . "</h3>
                    </div>
                    <form method='POST' action='skripta.php?id=" . $id . "' name='myForm'>
                        <div class='form-item'>
                            <label for='title'>Naslov vijesti</label>
                            <div class='form-field'>
                                <input type='text' name='title' class='form-field-textual' value='" . $row['naslov'] . "'>
                            </div>
                        </div>
                        <div class='form-item'>
                            <label for='about'>Kratki sadržaj vijesti (do 50 znakova)</label>
                            <div class='form-field'>
                                <textarea name='about' id='' cols='30' rows='10' class='form-field-textual'>" . $row['sazetak'] . "</textarea>
                            </div>
                        </div>
                        <div class='form-item'>
                            <label for='content'>Sadržaj vijesti</label>
                            <div class='form-field'>
                                <textarea name='content' id='' cols='30' rows='10' class='form-field-textual'>" . $row['tekst'] . "</textarea>
                            </div>
                        </div>
                        <div class='form-item'>
                            <label for='photo'>Slika: </label>
                            <div class='form-field'>
                                <input type='file' accept='image/jpg' class='input-text' name='photo'/>
                            </div>
                        </div>
                        <div class='form-item'>
                            <label for='category'>Kategorija vijesti</label>
                            <div class='form-field'>
                                <select name='category' id='' class='form-field-textual'>
                                <option value='sport'>Sport</option>
                                <option value='politika'>Politika</option>
                                </select>
                            </div>
                        </div>
                        <div class='form-item'>
                            <label>Spremiti u arhivu:</label>
                            <div class='form-field'>
                                <input type='checkbox' name='archive'>
                            </div>
                        </div>
                        <div class='form-item'>
                            <button name='Poništi' type='reset' value='Poništi'>Poništi</button>
                            <button name='Prihvati' type='submit' value='Prihvati'>Prihvati</button>
                        </div>
                    </form>
                </div>
            </section>";
}
?>