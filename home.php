<?php

$dbhost = 'oniddb.cws.oregonstate.edu';
$dbname = 'dalet-db';
$dbuser = 'dalet-db';
$dbpass = 'N9lGRQfgZkTeF9SM';

$mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
    or die("Error connecting to database server");

mysql_select_db($dbname, $mysql_handle)
    or die("Error selecting database: $dbname");

echo 'Successfully connected to database!';

mysql_close($mysql_handle);

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbuser);

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Board Game DB</title>
	</head>
	<body>
		<h1>Board Game Database</h1>
		
		<h2>Checking Stuff</h2>
		
		<div>
			<form method="post" action="check/checkGame.php">
				<fieldset>
					<legend>View Game By Name</legend>
					<p>Game: <select name="game">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, name FROM game_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($gid, $gname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $gid . ' "> ' . $gname . '</option>\n';
}
$stmt->close();

?>
					</select></p>
					<input type="submit" id="viewGame"></input></br>
				</fieldset>
			</form>
		</div>
		
		<div>
			<form method="post" action="check/viewByType.php">
				<fieldset>
					<legend>View Games By Type</legend>
					<p>Game: <select name="type">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, name FROM type_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
}
$stmt->close();

?>
					</select></p>
					<input type="submit" id="viewByType"></input></br>
				</fieldset>
			</form>
		</div>
		
		<div>
			<form method="post" action="check/viewPlayer.php">
				<fieldset>
					<legend>View Player</legend>
					<p>Game: <select name="player">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, fname, lname FROM player_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $fname, $lname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $fname . " " . $lname . '</option>\n';
}
$stmt->close();

?>
					</select></p>
					<input type="submit" id="viewGamebyType"></input></br>
				</fieldset>
			</form>
		</div>
		
		<a href="check/seeAllPlayers.php" id="seeAllPlayer">See List Players</a>
		<a href="check/seeAllGames.php" id="seeAllGames">See List Games</a>
		<a href="check/seeAllResults.php" id="seeAllResults">See List Results</a>
		<a href="check/seeAllTypes.php" id="seeAllTypes">See List Types</a>
		
		
		<h2>Adding Stuff</h2>
		<div>
			<form method="post" action="add/addResult.php">
				<fieldset>
					<legend>Add A Game Result</legend>
					<p>Game: <select name="game">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, name FROM game_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($gid, $gname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $gid . ' "> ' . $gname . '</option>\n';
}
$stmt->close();

?>
					</select></p>
					<p>Date Played: <input type="date" name="datePlayed"/></p>
					<p>Winner: <select name="player">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, fname, lname FROM player_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($pid, $fname, $lname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $pid . ' "> ' . $fname . " " . $lname . '</option>\n';
}
$stmt->close();

?>
					</select></p>
					<input type="submit" id="submitResult"></input></br>
				</fieldset>
			</form>
		</div>
		</br>		
		<div>
			<form method="post" action="add/addPlayer.php">
				<fieldset>
					<legend>Adding a Player</legend>
					<p>First Name: <input type="text" name ="fname" /></p>
					<p>Last Name: <input type="text" name="lname" /></p>
					<input type="submit" id="addPlayer"></input></br>
				</fieldset>
			</form>
		</div>
		</br>
		<div>
			<form method="post" action="add/addGame.php">
				<fieldset>
					<legend>Adding a Game</legend>
					<p>Game Name: <input type="text" name="name" /></p>
					<p>Minimum # of Players: <input type="number" name="minPlayer" min="1";/></p>
					<p>Maximum # of Players: <input type="number" name="maxPlayer" min="1"/></p>
					<input type="submit" id="addGame"></input></br>
				</fieldset>
			</form>
		</div>
		</br>
		<div>
			<form method="post" action="add/addType.php">
				<fieldset>
					<legend>Adding a Game Type</legend>
					<p>Type Name: <input type="text" name="name" /></p>
					<input type="submit" id="addType"></input></br>
				</fieldset>
			</form>
		</div>
		</br>
		<div>
			<form method="post" action="add/assignGameType.php">
				<fieldset>
					<legend>Assigning a Game Type to a Game</legend>
					<p>Game: <select name="game">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, name FROM game_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($gid, $gname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $gid . ' "> ' . $gname . '</option>\n';
}
$stmt->close();

?>
					</select></p>
					<p>Type Name: <select name="type">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, name FROM type_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($tid, $tname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $tid . ' "> ' . $tname . '</option>\n';
}
$stmt->close();

?>
					</select></p>
					<input type="submit" id="addGameType"></input></br>
				</fieldset>
			</form>
		</div>
		
		<h2>Updating Stuff</h2>
		
		<div>
			<form method="post" action="update/updatePlayer.php">
				<fieldset>
					<legend>Update a Player</legend>
					<p>Select Player: <select name="player">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, fname, lname FROM player_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($pid, $fname, $lname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $pid . ' "> ' . $fname . " " . $lname . '</option>\n';
}
$stmt->close();

?>
					</select></p>
					<p>New First Name: <input type="text" name ="newfname" /></p>
					<p>New Last Name: <input type="text" name="newlname" /></p>
					<input type="submit" id="updatePlayer"></input></br>
				</fieldset>
			</form>
		</div>
		</br>
		<div>
			<form method="post" action="update/updateGame.php">
				<fieldset>
					<legend>Update a Game</legend>
					<p>Select Game: <select name="game">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, name FROM game_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($gid, $gname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $gid . ' "> ' . $gname . '</option>\n';
}
$stmt->close();

?>
					</select></p>
					<p>New Name: <input type="text" name="newName" /></p>
					<p>New Minimum # of Players: <input type="number" name="newMin" min="1";/></p>
					<p>New Maximum # of Players: <input type="number" name="newMax" min="1"/></p>
					<input type="submit" id="updateGame"></input></br>
				</fieldset>
			</form>
		</div>
		
		
		<h2>Deleting Stuff</h2>
	
		<div>
			<form method="post" action="delete/removeGameType.php">
				<fieldset>
					<legend>Remove a Type from a Game</legend>
					<p>Select Game: <select name="game">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, name FROM game_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($gid, $gname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $gid . ' "> ' . $gname . '</option>\n';
}
$stmt->close();

?>
					</select></p>
					<p>Type Name: <select name="type">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, name FROM type_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($tid, $tname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $tid . ' "> ' . $tname . '</option>\n';
}
$stmt->close();

?>
					</select></p>
					<input type="submit" id="removeGame"></input></br>
				</fieldset>
			</form>
		</div>
		</br>
		<div>
			<form method="post" action="delete/deletePlayer.php">
				<fieldset>
					<legend>Delete a Player</legend>
					<p>Select Player: <select name="player">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, fname, lname FROM player_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($pid, $fname, $lname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $pid . ' "> ' . $fname . " " . $lname . '</option>\n';
}
$stmt->close();

?>
					</select></p>
					<input type="submit" id="deletePlayer"></input></br>
				</fieldset>
			</form>
		</div>
		</br>
		<div>
			<form method="post" action="delete/deleteGame.php">
				<fieldset>
					<legend>Delete a Game</legend>
					<p>Select Game: <select name="game">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, name FROM game_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($gid, $gname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $gid . ' "> ' . $gname . '</option>\n';
}
$stmt->close();

?>
					</select></p>
					<input type="submit" id="deleteGame"></input></br>
				</fieldset>
			</form>
		</div>	
		</br>
		<div>
			<form method="post" action="delete/deleteType.php">
				<fieldset>
					<legend>Delete a Type</legend>
					<p>Type Name: <select name="type">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, name FROM type_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($tid, $tname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $tid . ' "> ' . $tname . '</option>\n';
}
$stmt->close();

?>
					</select></p>
					<input type="submit" id="deleteType"></input></br>
				</fieldset>
			</form>
		</div>
	</body>
</html>