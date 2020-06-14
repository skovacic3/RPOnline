<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>RP Online</title>
        <link rel="stylesheet" type="text/css" href="style.css">
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
                <?php
                if(isset($_GET['id']) && $_GET['id'] != ""){
                    $dbc = mysqli_connect('localhost', 'root', '', 'RPOnline') or
                    die(mysqli_connect_error());

                    $id = $_GET["id"];
                    if($dbc){
                        $query = "SELECT * FROM article WHERE id = " . $id;
                        $result = mysqli_query($dbc, $query);
                        $row = mysqli_fetch_array($result);
                        if(mysqli_num_rows($result) > 0){
                            echo "
                                <div class='title'>
                                    <h3>". $row['naslov'] . "</h3>
                                </div>";
                                        echo "
                                <article>
                                    <img id='clanak' src='slike/" . $row["slika"] . "' alt='article picture'>
                                    <h3>" . $row["sazetak"] . "</h3>
                                    <p>" . $row["tekst"] . "</p>
                                </article>";
                        }
                        else{
                            echo "DB error, contact your admin.";
                        }
                    }
                    else{
                        echo "DB error, contact your admin.";
                    }
                    mysqli_close($dbc);
                }
                else{
                    echo "DB error, contact your admin.";
                }
                ?>
                </div>
            </section>
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
