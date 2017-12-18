<?php
require_once('db_con.php');
?>

<?php
if($cmd = filter_input(INPUT_POST, 'cmd')){
	
		$cid = filter_input(INPUT_POST, 'id_text', FILTER_VALIDATE_INT)
			or die('Missing/illegal id_text parameter');
		$cnam = filter_input(INPUT_POST, 'headline')
			or die('Missing/illegal categoryname parameter');
	
		$txt = filter_input(INPUT_POST, 'text_box')
			or die('Missing/illegal categorynasme parameter');
		
		$sql = 'UPDATE text_table SET headline=?, text_box=? WHERE id_text=?';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('ssi', $cnam, $txt, $cid);
		$stmt->execute();
		
		if($stmt->affected_rows >0){
			echo 'Category name updated to '.$cnam;
			echo "<script language='javascript' type='text/javascript'>";
		echo "alert('Du har nu ændret indholdet');";
		echo "</script>";
		}
		else {
			echo 'Could not change name of category '.$cid;
		}
	
}
	
	
	
if(empty($cid)){	
	$cid = filter_input(INPUT_GET, 'id_text', FILTER_VALIDATE_INT)
		or die('Missing/illegal categoryid parameter');
}
	
	require_once('db_con.php');
	$sql = 'SELECT headline, text_box FROM text_table WHERE id_text=?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('i', $cid);
	$stmt->execute();
	$stmt->bind_result($cnam, $txt);
	while($stmt->fetch()) {}
	
?>
<!DOCTYPE html>
<html lang="da">
<head>
<meta charset="UTF-8">
<!--<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">-->
    
    <link href="https://fonts.googleapis.com/css?family=Patrick+Hand" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<title>Ændre indholdet</title>
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
			<li><a class="active" href="#sun">HJEM</a></li>
            <li><a href="login.php">LOG IND</a></li>
            <li><a href="#campaign">SIKKERSOL KAMPAGNEN</a></li>
            <li><a href="#uv">UV-MÅLER</a></li>
            <li><a href="#solraad">SOLRÅD &amp; HUDTYPE</a></li>
			<li><a href="#us_behind">OS BAG</a></li>
        </div>
    </nav>
<body>

<div class="container_opretbruger">
<h1 class="h1_konkurrence">Ændre navnet og indholdet her</h1>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    	<input type="hidden" type="hidden" name="id_text" value="<?=$cid?>" />
    	<input name="headline" type="text" value="<?=$cnam?>" placeholder="Overskrift" required />
    	
    	<input name="text_box" type="text" value="<?=$txt?>" placeholder="Tekst" required />
    	<input class="opretbruger_button" name="cmd" type="submit" value="Ændre teksten her" />
    	<div class="klik"><a href="secret.php">Tilbage til historierne</a></div>
</form>
</div>
	</div>
</body>
</html>
<?php ob_flush(); ?>