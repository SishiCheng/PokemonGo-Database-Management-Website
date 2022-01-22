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
    $sql = 'SELECT * from Pokedex ORDER BY "' . $_POST['sort1'] . '","' . $_POST["sort2"] . '" DESC LIMIT 15';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
} ?>


<!DOCTYPE html>
<html>

<head>
    <title>Search Top15 Pokemon by Attribute</title>
</head>

<body>
    <div style="background-color:midnightblue;color:white;padding:2%;">
        <div id="container">

            <img src="pokelogo.png" alt="Logo">
            <br><br><?php include 'home.php'; ?>
            <h2>Top 15 Pokemon by <?php echo htmlspecialchars($_POST['sort1']) ?> and <?php echo htmlspecialchars($_POST['sort2']) ?><h2>
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