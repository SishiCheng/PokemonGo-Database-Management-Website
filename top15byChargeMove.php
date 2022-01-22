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
    $sql = 'SELECT d.pokeId, d.pokename, cm_name, power, cooldown, round(power/cooldown,1) AS DPS, d.height, d.weight, d.catch_rate, d.flee_rate
            FROM Pokedex d, PokeChargeMove pcm, Charge_Move cm 
            WHERE d.pokeId=pcm.pokeID AND pcm.cmID=cm.cmID 
            ORDER BY DPS, ' . $_POST['sortBy'] . ' DESC, pokeId LIMIT 15';
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

            <h2>Top 15 Pokemon by Charge Move DPS<h2>
                    <form action="/top15byChargeMove.php" method="post">
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
                                <th>Charge Move Name</th>
                                <th>Power</th>
                                <th>Cooldown</th>
                                <th>Catch Rate</th>
                                <th>Flee Rate</th>
                                <th>DPS</th>
                                <th>Release</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $q->fetch()) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['pokeId']) ?></td>
                                    <td><?php echo htmlspecialchars($row['pokename']) ?></td>
                                    <td><?php echo htmlspecialchars($row['height']); ?></td>
                                    <td><?php echo htmlspecialchars($row['weight']); ?></td>
                                    <td><?php echo htmlspecialchars($row['cm_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['power']) ?></td>
                                    <td><?php echo htmlspecialchars($row['cooldown']); ?></td>
                                    <td><?php echo htmlspecialchars($row['catch_rate']); ?></td>
                                    <td><?php echo htmlspecialchars($row['flee_rate']); ?></td>
                                    <td><?php echo htmlspecialchars($row['DPS']); ?></td>

                                    <td><?php echo '<form action="/delete.php" method="post"><input type="submit" value="RELEASE"><input type="hidden" name="pokeId" value="' . htmlspecialchars($row['pokeId']) . '"></form>'; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
</body>

</html>