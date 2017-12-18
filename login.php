<?php
ob_start();
require_once('db_con.php');


//if(isset($_SESSION["login_table"])){
	//header("Location: secret.php");}
?>

<!DOCTYPE html>
<html lang="da">
<head>
<meta charset="UTF-8">
<!--<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">-->
    
    <link href="https://fonts.googleapis.com/css?family=Patrick+Hand" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<title>Logind her</title>
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
            <li><a class="active" href="index.html">HJEM</a></li>
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


<?php
if(filter_input(INPUT_POST, 'submit')){
	$un = filter_input(INPUT_POST, 'un') 
		or die('Missing/illegal un parameter');
	$pw = filter_input(INPUT_POST, 'pw')
		or die('Missing/illegal pw parameter');
	
	$sql = 'SELECT id, username, password FROM login_table WHERE username=?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('s', $un);
	$stmt->execute();
	$stmt->bind_result($id, $username, $password);
	$stmt->store_result(); //gemmer resultaterne til senere brug 
	
	
	if($stmt->num_rows == 1) { // Henter antallet af resultater, og ser om det er lige med 1
		while($stmt->fetch()){ //henter daterne fra forspørgelsen
			if (password_verify($pw, $password)){  //fører videre til næste side som nu bliver: secret.php
				$_SESSION["login_table"] = $username;
				$_SESSION["user_id"] = $id;
				echo "<script language='javascript' type='text/javascript'>";
				echo "alert('Du er logget ind');";
				echo "</script>";
				header("Location: secret.php");
			}
			
			else{
				echo 'Illegal username/password. Please try again combination';
			}
		}
	} else {
		echo "Brugeren findes ikke";
	}
	echo '<hr>';
}
	
?>

<!-- Dette er en placeholder til at logge ind -->
<div class="container_opretbruger">
<h1 class="h1_konkurrence">Log ind her <br>Opret din egen historie om hvorfor at du skal vinde en Uv-måler.</h1>
<h2 class="h2_opretbruger">Log ind</h2>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    	<input name="un" type="text" placeholder="Brugernavn" size="30" required /><br>
    	<input name="pw" type="password" placeholder="Password" size="30"  required /><br><br>
    	<input class="opretbruger_button" name="submit" type="submit" value="Login" />
    	<h3 class="h3_login">Har du ikke en profil?<a class="login_link" href="opret.php">Opret</a></h3>
</form>
</div>
<div class="container_post">
<h2 class="h2_post">Her kan du se de forskellige historier, som er med i konkurrencen.</h2>
<?php 
		$sql = 'SELECT headline, name, text_box FROM text_table';
		$stmt = $con->prepare($sql);
		$stmt->bind_result($headline, $name, $text_box);
		$stmt->execute();
	
	while($stmt->fetch()) {
		echo '<div class="container_opslag">
				<div class="all_poster">
				<h2>Jeg vil vinde en Uv-måler fordi..</h2>
				<li class="headline">'.$headline.'</li>
				<li>'.$name.'</li>
				<li>'.$text_box.'</li>
				</div>
			</div>';	
	}
?>
	</div>
<!-- background mobile -->
<img class="frontpage_mobile" src="#" alt="photo">
    <script src="hamburger.js"></script>
	<script src="smootscroll.js"></script>
</body>
</html>