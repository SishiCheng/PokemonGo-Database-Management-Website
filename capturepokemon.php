<!-- CapturePokemon.php mark Pokemon as Captured, adding it to the player's current squad -->
<!-- Need to define a 'Team' of Pokemon -->
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
    $sql = 'SELECT d.pokeId, d.pokename, 
            FROM Pokedex d  
            ORDER BY DPS DESC, pokeId LIMIT 15
            ';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Group 12: Capture Pokemon</title>
</head>

<body>
    <div style="background-color:midnightblue;color:white;padding:2%;">
        <div id="container">

            <img src="pokelogo.png" alt="Logo"> <br>
            <br><?php include 'home.php'; ?>
            <div style="background-color:midnightblue;color:white;padding:2%;">

                <br>
                <h2>Capture Pokemon:</h2>
                <form action="/modifyupper.php" method="post">
                    <table>
                        <tr>
                            <td>Pokename:</td>
                            <td><input type="text" id="pokename" name="pokename" value="?"></td>
                        </tr>
                    </table>
                    <i>Please enter the Pokemon ID that you would like to capture</i>
                    <br>
                    <input type="submit" value="Modify evolves from">
                </form>
                <br>

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
                        <?php while ($row = $q->fetch()) : ?>
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