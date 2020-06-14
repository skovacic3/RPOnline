<?php
    session_start();
    if(isset($_SESSION['username'])){
        $_SESSION['username'];
    }
    if(isset($_SESSION['level'])){
        $_SESSION['level'];
    }
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
                <a href="#"><img src="logo.png" alt="logo"></a>
                <ul>
                    <li><a href="#">HOME</a></li>
                    <li><a href="kategorija.php?kategorija=politika">POLITIKA</a></li>
                    <li><a href="kategorija.php?kategorija=sport">SPORT</a></li>
                    <li><a href="administracija.php">ADMINISTRACIJA</a></li>
                </ul>
            </div>
        </header>
        <section>
            <div class="mainSection">
                <div class="title">
                    <h3>Sport</h3>
                </div>
                <?php
                $dbc = mysqli_connect('localhost', 'root', '', 'RPOnline') or
                die(mysqli_connect_error());
                if($dbc){
                    $query = "SELECT * FROM article WHERE arhiva = 0 AND kategorija = 'sport' ORDER BY datum DESC LIMIT 3";
                    $result = mysqli_query($dbc, $query);
                    if ($result->num_rows > 0){
                        while($row = mysqli_fetch_array($result)){
                            echo "
                            <article>
                                <a href='clanak.php?id=" . $row['id'] ."'><img src='slike/" . $row["slika"] . "' alt='article picture'></a>
                                <h3><a href='clanak.php?id=" . $row['id'] ."'>" . $row["naslov"] . "</a></h3>
                                <p>" . $row["sazetak"] ."</p></article>";
                        }
                    }
                }
                else{
                    echo "Connection failed";
                }
                mysqli_close($dbc);
            ?>
        </section>

        <section>
            <div class="mainSection">
                <div class="title">
                    <h3>Politika</h3>
                </div>
                <?php
                $dbc = mysqli_connect('localhost', 'root', '', 'RPOnline') or
                die(mysqli_connect_error());
                if($dbc) {
                    $query = "SELECT * FROM article WHERE arhiva = 0 AND kategorija = 'politika' ORDER BY datum DESC LIMIT 3";
                    $result = mysqli_query($dbc, $query);
                    if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            echo "
                            <article>
                                <a href='clanak.php?id=" . $row['id'] ."'><img src='slike/" . $row["slika"] . "' alt='article picture'></a>
                                <h3><a href='clanak.php?id=" . $row['id'] . "'>" . $row["naslov"] . "</a></h3>
                                <p>" . $row["sazetak"] . "</p></article>";
                        }
                    }
                }
                else{
                    echo "Connection failed";
                }
                mysqli_close($dbc);
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


