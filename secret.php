<?php
ob_start();
require_once("db_con.php");

//if(!isset($_SESSION["login_table"])){
	//echo "Du er ikke logget ind. Klik <a href=\"login.php\">her</a> for at logge ind";
//} else {
?>

<!DOCTYPE html>
<html lang="da">
<head>
<meta charset="UTF-8">
<!--<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">-->
    
    <link href="https://fonts.googleapis.com/css?family=Patrick+Hand" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<title>Din personlige side</title>
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

<?php

$text_box = filter_input(INPUT_POST, 'text_box', FILTER_SANITIZE_STRING);

	if(!empty($text_box)){ // button was pressed
		
		$headline = filter_input(INPUT_POST, 'headline', FILTER_SANITIZE_STRING) or die('missing/illegal param headline');
		$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING) or die('missing/illegal param name');
		$text_box = filter_input(INPUT_POST, 'text_box', FILTER_SANITIZE_STRING) or die('missing/illegal param text_box');
		
		$sql = 'INSERT INTO text_table (headline, name, text_box, user_id) VALUES (?, ?, ?, ?)';
		$stmt = $con->prepare($sql);
		$stmt->bind_param("sssi", $headline, $name, $text_box, $_SESSION["user_id"]);
		$stmt->execute();

			//echo 'inserted '.$stmt->affected_rows.' rækker'; 
		}
	
?>
<div class="poster">
		<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<h2 class="h2_poster">Jeg vil vinde en Uv-måler fordi..</h2>
			<input type="text" placeholder="Overskrift" name="headline" required><br><br>
			<input type="text" placeholder="Dit navn" name="name" required><br><br>
			<textarea class="text_height" type="text" placeholder="Skriv din tekst her" name="text_box" required></textarea><br><br>
			<input type="submit" name="post" value="Slå op">
			<a href="logud.php">Log ud</a>
		</form>
	</div>
<div class="container_post">
<h2 class="h2_post">Her kan du se de forskellige historier, som er med i konkurrencen.</h2>
<?php 
		$sql = 'SELECT id_text, headline, name, text_box, user_id FROM text_table';
		$stmt = $con->prepare($sql);
		$stmt->bind_result($id_text, $headline, $name, $text_box, $uid);
		$stmt->execute();
	
	while($stmt->fetch()) {
		echo '<div class="container_opslag">
				<div class="all_poster">
				<h2>Jeg vil vinde en Uv-måler fordi..</h2>
				<li class="headline">'.$headline.'</li>
				<li>'.$name.'</li>
				<li>'.$text_box.'</li>';
		
				
		if($uid == $_SESSION["user_id"]){
				echo '<a href="rename.php?id_text=' . $id_text . '">Rename</a> ';
				echo '<a href="delete.php?id_text=' . $id_text . '">Delete</a>';
		}
				echo '</div>
			</div>';	
	}
?>
	</div>
	</body>
</html>
