<!-- ShowEvoChain.php presents the user with the evolution chains for all Pokemon of Selected Type -->
<!-- Currently only showing Grass type pokemon, but change query to include other pokemon types. -->
<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

$username = 'group12';
$password = 'pokemon';
$host = 'CMPSC431-S3-G-12.vmhost.psu.edu';
$dbname = 'group12_431W';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $sql = 'SELECT p.pokeId, p.pokename, type, evolves_from, evolves_to
            FROM Pokedex p, Evolution e, Type t, poketype pt
            WHERE p.pokeId=pt.pokeId AND p.pokeId = e.pokeId AND pt.typeId=t.typeId 
            AND t.type="Grass"';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Group 12: Display Evolution Chains</title>
</head>

<body>
    <div style="background-color:midnightblue;color:white;padding:2%;">
        <div id="container">

            <img src="pokelogo.png" alt="Logo"> <br>
            <br><?php include 'home.php'; ?>
            <div style="background-color:midnightblue;color:white;padding:2%;">

                <h2> Select a Pokemon Type to View!</h2>
                <form action="/searchevochains.php" method="post">
                    <label for="type">Choose a Type:</label>
                    <select name="type" id="type">
                        <option value="Grass">Grass</option>
                        <option value="Bug">Bug</option>
                        <option value="Dark">Dark</option>
                        <option value="Dragon">Dragon</option>
                        <option value="Electric">Electric</option>
                        <option value="Fairy">Fairy</option>
                        <option value="Fighting">Fighting</option>
                        <option value="Fire">Fire</option>
                        <option value="Flying">Flying</option>
                        <option value="Ghost">Ghost</option>
                        <option value="Ground">Ground</option>
                        <option value="Ice">Ice</option>
                        <option value="Normal">Normal</option>
                        <option value="Poison">Poison</option>
                        <option value="Psychic">Psychic</option>
                        <option value="Rock">Rock</option>
                        <option value="Steel">Steel</option>
                        <option value="Water">Water</option>
                    </select>
                    <input type="submit" value="Search!" style="font-size: 20px;">
                </form>

                <h2>Evolution Chain for Grass Pokemon</h2>
                <table border=1 cellspacing=5 cellpadding=5 style="background-color: white; color: midnightblue">
                    <thead>
                        <tr>
                            <th>PokeId</th>
                            <th>Pokename</th>
                            <th>Type</th>
                            <th>Evolves From</th>
                            <th>Evolves To</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $q->fetch()) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['pokeId']) ?></td>
                                <td><?php echo htmlspecialchars($row['pokename']); ?></td>
                                <td><?php echo htmlspecialchars($row['type']); ?></td>
                                <td><?php echo htmlspecialchars($row['evolves_from']); ?></td>
                                <td><?php echo htmlspecialchars($row['evolves_to']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <br>
                <br>
                <br>
                <br><br><br>
</body>
</div>
</div>

</html>