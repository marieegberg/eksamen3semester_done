<?php
ob_start();
// require_once forbinder til databasen db_con.php
require_once("db_con.php"); 


//if(isset($_SESSION["login_table"])){
	//header("Location: secret.php");}

//input post - sender direkte videre som HTTP Post transaction - kan ikke gemmes af brugeren.

if (filter_input(INPUT_POST, 'submit')){ //submit er knappen som opretter brugeren
	
	$un = filter_input(INPUT_POST, 'username')
		or die('Missing/illegal username parameter'); // hvis inogle parametre er null (no value) bliver funktionen null og kan ikke køres igennem.
	
	$email = filter_input(INPUT_POST, 'email')
		or die('Missing/illegal password parameter');
	
	$pw = filter_input(INPUT_POST, 'password')
		or die('Missing/illegal password parameter');
	
	$pw = password_hash($pw, PASSWORD_DEFAULT); //password_hash bruger en krypteret kode, som sikre at brugerens oplysninger ikke bliver misbrugt
	
	echo 'Creating user '.$un.' with password: '.$pw; // fortæller at du er oprettet som bruger med et password
	
	// her indsættes data fra login_table  
	$sql= 'INSERT INTO login_table (username, email, password) VALUES (?, ?, ?)';
	$stmt = $con->prepare($sql); //Forbereder en SQL statement til at blive excecutet (udført)
	$stmt->bind_param('sss', $un, $email, $pw); //Binder variablerne til en prepare statement som parametre 
	$stmt->execute(); //udføre en prepared Query
	
	if ($stmt->affected_rows > 0) {  //fører videre til næste side hvis det samlede tal af ændrede, slettede eller indsættede rows er over 0 -  videreføres til login.php
		// kommer med en javascript alert om at brugeren er oprettet
		echo 'user '.$un.' added ';
		echo "<script language='javascript' type='text/javascript'>";
		echo "alert('Du er nu oprettet som bruger');";
		echo "</script>";
		$URL="login.php";
		echo "<script>location.href='$URL'</script>";
	}
	else {
		echo 'could not add user'; // ellers kommer en alert om at brugeren ikke kunne oprettes
	}
}
?>

<!DOCTYPE html>
<html lang="da">
<head>
<meta charset="UTF-8">
<!--<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">-->
    
    <link href="https://fonts.googleapis.com/css?family=Patrick+Hand" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<title>Opret dig som bruger</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="mobil.css">
        <link rel="stylesheet" href="medium.css" media="screen and (min-width: 960px)">
        <link rel="stylesheet" href="large.css" media="screen and (min-width: 1500px)">
<!--JAVASCRIPT-->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
	
</head>
<body>

<!--Navbar-->
<!-- tablet fix --> <div style="background: white; position: fixed; top: 0; left: 0; right: 0; height: 84px; z-index: 999;">
<div class="navbar-left">
    <a href="index.html">
        <img class="logo" src="logo_done.png" alt="logo">
    </a>
</div>
	
<div class="navbar">
    <div id="navbar-right">
        <ul>
            <li><a class="active" href="#sun">HJEM</a></li>
            <li><a href="login.php">LOG IND</a></li>
            <li><a href="#campaign">SIKKERSOL KAMPAGNEN</a></li>
            <li><a href="#uv">UV-MÅLER</a></li>
            <li><a href="#solraad">SOLRÅD &amp; HUDTYPE</a></li>
			<li><a href="#us_behind">OS BAG</a></li>
        </ul>
    </div>
</div>
<!-- tablet fix slut --> </div>
<!-- Navbar mobile -->
 <div class="name">
        <a href="index.html">
        </a>
    </div>
    <nav class="mobile">
		<button></button>
		<div>
			<a href="index.html">HJEM</a>
           	<a href="login.php">LOG IND</a>
            <a href="index.html">SIKKERSOL KAMPAGNEN</a>
            <a href="index.html">UV-MÅLER</a>
            <a href="index.html">SOLRÅD &amp; HUDTYPE</a>
            <a href="index.html">OS BAG</a>
        </div>
    </nav>

<!-- Dette er en placeholder til oprettelse af bruger -->
<div class="container_opretbruger">
<h1 class="h1_konkurrence">Vær med i konkurrencen her</h1>
<h2 class="h2_opretbruger">Opret bruger</h2>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    	<input name="username" type="text" placeholder="Brugernavn" required /><br>
    	<input name="email" type="email" placeholder="Email" required /><br>
    	<input name="password" type="password" placeholder="Adgangskode" required /><br>
    	<input class="opretbruger_button" name="submit" type="submit" value="Opret bruger" />
    	<h3 class="h3_login">Har du allerede en bruger?<a class="login_link" href="login.php">Login</a></h3>
</form>
</div>
	</div>
<!-- background mobile -->
<img class="frontpage_mobile" src="#" alt="photo">
    <script src="hamburger.js"></script>
	<script src="smootscroll.js"></script>
</body>
</html>