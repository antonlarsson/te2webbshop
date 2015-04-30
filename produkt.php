<?php

//Ta emot id för den produkt som skall visas
$produktid = $_GET["produktid"];

//Variabler för databaskoppling
$dbhost     = "localhost";
$dbname     = "te2swag";
$dbuser     = "root";
$dbpass     = "";

//Koppla till databasen
$DBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

// Välj felhantering (här felsökningsläge)
$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

// Förbered databasfråga med placeholders (markerade med : i början)
$STH = $DBH->prepare("SELECT * FROM tbl_produkter WHERE id = :id");

// Koppla placeholder med ett variabelvärde.
$STH->bindParam(":id", $produktid);

// Utför databasfrågan.
$STH->execute();

// Stäng databaskopplingen
$DBH = null;

// Hämtar värden
$result = $STH->fetch();


?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

<h1> <?php echo $result["titel"];?> </h1> <?php echo $result["pris"];?> kr
<br>

<?php echo $result["beskrivning"];?>
<br>
<br>
<img src="<?php echo $result["bildfil"];?>"
<br>
<br>
Antal i lager:<?php echo $result["lagersaldo"];?> <br>

</body>
</html>