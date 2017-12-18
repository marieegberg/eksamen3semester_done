<?php
require_once("db_con.php");

if(!isset($_SESSION["tjeklogin"])){ //hvis du ikke er logget ind og prøver at komme ind på siden, sender den dig tilbage til opret.php
	session_unset();
	session_destroy();
	header("Location: opret.php");
} else {
	session_unset();
	session_destroy(); //hvis du er logget ind, sletter den oplysninger og føre dig videre til opret.php
	header("Location: opret.php");
}
?>
