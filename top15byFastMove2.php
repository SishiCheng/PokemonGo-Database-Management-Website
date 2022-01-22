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
    $sql = 'SELECT d.pokeID, d.pokename,fm_name,power,cooldown, round(power/cooldown,1) AS DPS, d.height, d.weight, d.catch_rate, d.flee_rate
    FROM Pokedex d, PokeFastMove pfm, Fast_Move fm
    WHERE d.pokeID=pfm.pokeID AND pfm.fmID = fm.fmID
    ORDER BY DPS DESC, pokeId LIMIT 15';
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

            <h2>Top 15 Pokemon by Fast Move<h2>
                    <h3> Select an Attribute to Sort By:</h3>
                    <h3> Sorting by DPS now</h3>
                    <form action="/top15byFastMove3.php" method="post">
                        <label for="sortBy">Select an Attribute to Sort By:</label>
                        <select name="sortBy" id="sortBy">
                            <option value="DPS">DPS</option>
                            <option value="height">Height</option>
                            <option value="weight">Weight</option>
                            <option value="power">Power</option>
                            <option value="cooldown">Cooldown</option>
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
                                <th>Fast Move Name</th>
                                <th>Power</th>
                                <th>Cooldown</th>
                                <th>Catch Rate</th>
                                <th>Flee Rate</th>
                                <th>DPS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $q->fetch()) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['pokeID']) ?></td>
                                    <td><?php echo htmlspecialchars($row['pokename']) ?></td>
                                    <td><?php echo htmlspecialchars($row['height']); ?></td>
                                    <td><?php echo htmlspecialchars($row['weight']); ?></td>
                                    <td><?php echo htmlspecialchars($row['fm_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['power']) ?></td>
                                    <td><?php echo htmlspecialchars($row['cooldown']); ?></td>
                                    <td><?php echo htmlspecialchars($row['catch_rate']); ?></td>
                                    <td><?php echo htmlspecialchars($row['flee_rate']); ?></td>
                                    <td><?php echo htmlspecialchars($row['DPS']); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </h2>
            </h2>
        </div>
    </div>
</body>
</html>