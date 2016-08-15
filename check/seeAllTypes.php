<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "dalet-db", "N9lGRQfgZkTeF9SM", "dalet-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>All Types</title>
	</head>
	<body>
		<div>
			<table>
				<caption>Types</caption>
				<tr>
					<th>Name</th>
				</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT name FROM type_tbl"))) {
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}	
if(!$stmt->bind_result($name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo "<tr>\n<td>" . $name . "</td>\n</tr>";
}
$stmt->close();
?>
			</table>
		</div>
		<a href="../home.php">Back to Home</a>
	</body>
</html>