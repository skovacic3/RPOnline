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
        <?php
        if(isset($_GET['kategorija']) && ($_GET['kategorija'] == "sport" || $_GET['kategorija'] == "politika")){
            $dbc = mysqli_connect('localhost', 'root', '', 'RPOnline') or
            die(mysqli_connect_error());
            if ($dbc) {
                $query = "SELECT * FROM article WHERE kategorija = '" . $_GET['kategorija'] . "'";
                $result = mysqli_query($dbc, $query);
                echo "<div class='title'>
                        <h3>" . ucfirst($_GET['kategorija']) . "</h3>
                    </div>";

                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        echo "
                                <article>
                                    <img src='slike/" . $row["slika"] . "' alt='article picture'>
                                    <h3><a href='clanak.php?id=" . $row['id'] . "'>" . $row["naslov"] . "</a></h3>
                                    <p>" . $row["sazetak"] . "</p></article>";
                    }
                }
            } else {
                echo "Connection failed";
            }
            mysqli_close($dbc);
        }
        else{
            echo "<h5 style='font-size: 50px'>Greška</h5>";
            header("refresh:2,url=index.php");
        }
        ?>
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


