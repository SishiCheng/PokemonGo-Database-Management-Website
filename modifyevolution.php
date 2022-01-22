<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_SESSION["loggedin"]) === false || $_SESSION["loggedin"] === false){
    //$username = 'group12';
    header("location: login.php");
    exit;
}
$username = $_SESSION["username"];
$password = 'pokemon';
$host = 'CMPSC431-S3-G-12.vmhost.psu.edu';
$dbname = 'group12_431W';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $sql = 'SELECT * FROM Pokedex';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Group 12: Modify Evolution</title>
    </head>
    <body>
	<div style="background-color:midnightblue;color:white;padding:2%;">
        <div id="container">
	
	<img src="pokelogo.png" alt="Logo"> <br>
  <br><?php include 'home.php' ;?>
  <div style="background-color:midnightblue;color:white;padding:2%;">

  <br><h2>Modify the upper level in Evolution chain:</h2>
		<form action="/modifyuppertran.php" method="post">
			<table>
				<tr><td>Pokename:</td><td><input type="text" id="pokename" name="pokename" value="?"></td></tr>
				<tr><td>Modify to:</td><td><input type="text" id="evolvesFrom" name="evolvesFrom" value="?"></td></tr>
			</table>
      <i>Please enter the id of the pokemon in the field (id can be found below)</i>
      <br>
			<input type="submit" value="Modify evolves from">
		</form>
  <br>
  
    <br><h2>Modify the next level in Evolution chain:</h2>
		<form action="/modifylower.php" method="post">
			<table>
				<tr><td>PokeId:</td><td><input type="text" id="pokeId" name="pokeId" value="?"></td></tr>
				<tr><td>Modify from:</td><td><input type="text" id="evolvesBefore" name="evolvesBefore" value="?"></tr>
        <tr><td>To:</td><td><input type="text" id="evolvesAfter" name="evolvesAfter" value="?"></td></tr>
			</table>
      <i>Please enter the id of the pokemon in the field (id can be found below)</i>
      <br>
			<input type="submit" value="Modify evolves from">
		</form>
  <br>
  <i>Not sure?</i>
  <a style = "color: red" href="http://cmpsc431-s3-g-12.vmhost.psu.edu/evolvesTo.php">Check the EVOLVES TO TABLE here~</a>
  
	<h2>Pokedex (ADMIN)</h2>

            <table border=1 cellspacing=5 cellpadding=5 style="background-color: white; color: midnightblue">
                <thead>
		    <tr>
			<th>PokeId</th>
                        <th>Pokename</th>
                        <th>Height</th>
                        <th>Weight</th>
			<th>Generation</th>
			<th>Catch Rate</th>
			<th>Flee Rate</th>
			<th>Evolves From</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
			<tr>
			    <td><?php echo htmlspecialchars($row['pokeId']) ?></td>
                            <td><?php echo htmlspecialchars($row['pokename']) ?></td>
                            <td><?php echo htmlspecialchars($row['height']); ?></td>
			    <td><?php echo htmlspecialchars($row['weight']); ?></td>
                            <td><?php echo htmlspecialchars($row['generation']) ?></td>
                            <td><?php echo htmlspecialchars($row['catch_rate']); ?></td>
			    <td><?php echo htmlspecialchars($row['flee_rate']); ?></td>
                            <td><?php echo htmlspecialchars($row['evolves_from']); ?></td>
                            <td><?php echo '<form action="/delete.php" method="post"><input type="submit" value="DELETE"><input type="hidden" name="pokeId" value="' . htmlspecialchars($row['pokeId']) . '"></form>'; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
		<br>
		<br><br><br>
    </body>
</div>
</div>
</html>
