<!-- Start.php is the Main page for PokeTracker, providing users with a view of all Pokemon available in the tracker. -->
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
    <title>Group 12: Pokemon Go Application</title>
</head>

<body>
    <div style="background-color:midnightblue;color:white;padding:2%;">
        <div id="container">

            <img src="pokelogo.png" alt="Logo"> <br>
            <br><?php include 'home.php'; ?>
            <div style="background-color:midnightblue;color:white;padding:2%;">

            <h1> Welcome to PokeTracker </h1>
            <body> The world's greatest Pokemon Go Companion App, allowing players of all ages and skill levels to track their captured Pokemon and learn more about wild Pokemon to encounter! </body>
            <body> Try clicking a Pokemon's name below to learn more about it! </body>
            <br>

                <!-- Admin View of Pokedex -->
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
                                <td><a href=<?php echo "PokemonLookup.php?" . htmlspecialchars($row['pokeId']) ?>><?php echo htmlspecialchars($row['pokename']) ?></a></td>
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
                <h2>Add Pokemon:</h2>
                <form action="/insert.php" method="post">
                    <table>
                        <tr>
                            <td>Pokemon Id:</td>
                            <td><input type="text" id="pokeId" name="pokeId" value="?"></td>
                        </tr>
                        <tr>
                            <td>Pokename:</td>
                            <td><input type="text" id="pokename" name="pokename" value="?"></td>
                        </tr>
                        <tr>
                            <td>Height:</td>
                            <td><input type="text" id="height" name="height" value="?"></td>
                        </tr>
                        <tr>
                            <td>Weight:</td>
                            <td><input type="text" id="weight" name="weight" value="?"></td>
                        </tr>
                        <tr>
                            <td>Generation:</td>
                            <td><input type="text" id="generation" name="generation" value="?"></td>
                        </tr>
                        <tr>
                            <td>Catch Rate:</td>
                            <td><input type="text" id="catch_rate" name="catch_rate" value="?"></td>
                        </tr>
                        <tr>
                            <td>Flee Rate:</td>
                            <td><input type="text" id="flee_rate" name="flee_rate" value="?"></td>
                        </tr>
                        <tr>
                            <td>Evolves From:</td>
                            <td><input type="text" id="evolves_from" name="evolves_from" value="?"></td>
                        </tr>
                    </table>
                    <input type="submit" value="ADD">
                </form>
                <br>
                <br><br><br>
</body>
</div>
</div>

</html>