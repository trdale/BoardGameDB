<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "dalet-db", "N9lGRQfgZkTeF9SM", "dalet-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!($stmt = $mysqli->prepare("UPDATE game_tbl SET name=?, player_min=?, player_max=? WHERE id = ?"))) {
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("siii",$_POST['newName'],$_POST['newMin'],$_POST['newMax'],$_POST['game']))) {
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Game Updated";
}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Update Player</title>
	</head>
	<body>
		</br>
		<a href="../home.php">Back to Home</a>
	</body>
</html>