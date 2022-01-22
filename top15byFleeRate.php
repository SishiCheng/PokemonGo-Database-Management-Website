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
    $sql = 'SELECT * from Pokedex ORDER BY ' . $_POST['sortBy'] . ' DESC LIMIT 15';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
} ?>

<!DOCTYPE html>
<html>

<head>
    <title>Print Out top 15 Pokemon</title>
</head>

<body>
    <div style="background-color:midnightblue;color:white;padding:2%;">
        <div id="container">

            <img src="pokelogo.png" alt="Logo">
            <br><br><?php include 'home.php'; ?>

            <h2>Top 15 Pokemon by Flee Rate<h2>
                    <h3> Select an Attribute to Sort By:</h3>
                    <form action="/top15byFleeRate.php" method="post">
                        <label for="sortBy">Select an Attribute to Sort By:</label>
                        <select name="sortBy" id="sortBy">
                            <option value="height">Height</option>
                            <option value="weight">Weight</option>
                            <option value="catch_rate">Catch Rate</option>
                            <option value="flee_rate">Flee Rate</option>
                        </select>
                        <input type="submit" value="Search!" style="font-size: 20px;">
                    </form>


                    <table border=1 cellspacing=5 cellpadding=5 style="background-color: white;color:midnightblue">
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
                                    <td><?php echo '<form action="/delete.php" method="post"><input type="submit" value="RELEASE"><input type="hidden" name="pokeId" value="' . htmlspecialchars($row['pokeId']) . '"></form>'; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
</body>

</html>