<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = 'group12';
$password = 'pokemon';
$host = 'CMPSC431-S3-G-12.vmhost.psu.edu';
$dbname = 'group12_431W';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $sql = 'SELECT p.pokeId, p.pokename, e.evolves_to, temp.evolves_to_name FROM (SELECT pokename AS evolves_to_name, evolves_to FROM Pokedex p, Evolution e WHERE p.pokeId = e.evolves_to GROUP BY evolves_to) AS temp, Pokedex p, Evolution e WHERE p.pokeId = e.pokeId AND temp.evolves_to = e.evolves_to ORDER BY p.pokeId';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Group 12: Pokemon Go Application</title>
    </head>
    <body>
	<div style="background-color:midnightblue;color:white;padding:2%;">
        <div id="container">
	
	<img src="pokelogo.png" alt="Logo"> <br>
  <br><?php include 'home.php' ;?>
  <div style="background-color:midnightblue;color:white;padding:2%;">

	<h2>Pokedex (ADMIN)</h2>

            <table border=1 cellspacing=5 cellpadding=5 style="background-color: white; color: midnightblue">
                <thead>
		    <tr>
			<th>PokeId</th>
                        <th>Pokename</th>
                        <th>Evolves To (ID)</th>
                        <th>Evolves To (name)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
			<tr>
			    <td><?php echo htmlspecialchars($row['pokeId']) ?></td>
                            <td><?php echo htmlspecialchars($row['pokename']) ?></td>
                            <td><?php echo htmlspecialchars($row['evolves_to']); ?></td>
			    <td><?php echo htmlspecialchars($row['evolves_to_name']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
		<br><br><br>
    </body>
</div>
</div>
</html>
