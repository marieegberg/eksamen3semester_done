<?php
require_once('db_con.php');
	
if(isset($_GET['id_text'])){
	
	// delete category
		$cid = filter_input(INPUT_GET, 'id_text', FILTER_VALIDATE_INT)
			or die('Missing/illegal id_text parameter');
		$sql = ("DELETE FROM text_table WHERE id_text=?");
		$stmt = $con->prepare($sql);
		$stmt->bind_param('i', $cid);
		$stmt->execute();
		
		if($stmt->affected_rows > 0){
			echo 'Deleted category '.$cid;
			echo '<meta http-equiv="refresh" content="0; url=secret.php" />';
			exit();
		}
		else {
			echo 'Error deleting category';
		}
		
	}
	else {
		die('Unknown cmd parameter'.$cid);
	}
	
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Slet</title>
</head>

<body>

</body>