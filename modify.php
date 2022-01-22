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
        <title>PHP MySQL Query Data Demo</title>
    </head>
    <body>
	 <div style="background-color:midnightblue;color:white;padding:2%;">
        <div id="container">

        <img src="pokelogo.png" alt="Logo"> <br>
  <br><?php include 'home.php' ;?>
  <div style="background-color:midnightblue;color:white;padding:2%;">
<h2>Modify Pokedex:</h2>
<form action="/modifyname.php" method="post">
    <table>
        
        <tr><td>PokeId:</td><td><input type="text" id="pokeId" name="pokeId" value="?"></td><td>New Pokename:</td> <td><input type="text" id="pokename" name="pokename" value="?"> <input type="submit" value="MODIFY"></td></tr>
    </table>
    </form>
    <form action="/modifyheight.php" method="post">
    <table>
        <tr><td>PokeId:</td><td><input type="text" id="pokeId" name="pokeId" value="?"></td><td>New Height:</td><td><input type="text" id="height" name="height" value="?"> <input type="submit" value="MODIFY"></td></tr>
    </table>
    </form>
    <form action="/modifyweight.php" method="post">
    <table>
        <tr><td>PokeId:</td><td><input type="text" id="pokeId" name="pokeId" value="?"></td><td>New Weight:</td> <td><input type="text" id="weight" name="weight" value="?"> <input type="submit" value="MODIFY"></td></tr>
    </table>
    </form>
<form action="/modifygeneration.php" method="post">
    <table>
        <tr><td>PokeId:</td><td><input type="text" id="pokeId" name="pokeId" value="?"></td><td>New Generation:</td> <td><input type="text" id="generation" name="generation" value="?"> <input type="submit" value="MODIFY"></td></tr>
    </table>
    </form>
    <form action="/modifycatch.php" method="post">
    <table>
        <tr><td>PokeId:</td><td><input type="text" id="pokeId" name="pokeId" value="?"></td><td>New Catch Rate:</td> <td><input type="text" id="catch_rate" name="catch_rate" value="?"> <input type="submit" value="MODIFY"></td></tr>
    </table>
    </form>
    <form action="/modifyflee.php" method="post">
    <table>
        <tr><td>PokeId:</td><td><input type="text" id="pokeId" name="pokeId" value="?"></td><td>New Flee Rate:</td> <td><input type="text" id="flee_rate" name="flee_rate" value="?"> <input type="submit" value="MODIFY"></td></tr>
    </table>
    </form>
    <form action="/modifyEvolveFrom.php" method="post">
    <table>
        <tr><td>PokeId:</td><td><input type="text" id="pokeId" name="pokeId" value="?"></td><td>New Evolves From ID:</td> <td><input type="text" id="evolves_from" name="evolves_from" value="?"> <input type="submit" value="MODIFY"></td></tr>
    </table>

</form>

<br>

            <h2>Current Pokedex</h2>
            <table border=1 cellspacing=5 cellpadding=5>
                <thead>
                    <tr>
                        <th>PokeID</th>
                        <th>Pokemon</th>
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
                            <td><?php echo htmlspecialchars($row['pokename']); ?></td>
			    <td><?php echo htmlspecialchars($row['height']); ?></td>
			 <td><?php echo htmlspecialchars($row['weight']); ?></td>
				 <td><?php echo htmlspecialchars($row['generation']); ?></td>
				 <td><?php echo htmlspecialchars($row['catch_rate']); ?></td>
				 <td><?php echo htmlspecialchars($row['flee_rate']); ?></td>
				 <td><?php echo htmlspecialchars($row['evolves_from']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
		
		<br>
		<br><br><br>
    </body>
</div>
</html>


