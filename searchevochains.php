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
    $sql = 'SELECT p.pokeId, p.pokename, type, evolves_from, evolves_to
            FROM Pokedex p, Evolution e, Type t, poketype pt
            WHERE p.pokeId=pt.pokeId AND p.pokeId = e.pokeId AND pt.typeId=t.typeId 
            AND t.type="' . $_POST["type"] . '" order by p.pokeId';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database: $dbname " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>

<body>
    <div style="background-color:midnightblue;color:white;padding:2%;">
        <div id="container">

            <img src="pokelogo.png" alt="Logo"> <br>
            <br><?php include 'home.php'; ?>
            <div style="background-color:midnightblue;color:white;padding:2%;">
                <h2>Evolution Chain for <?php echo htmlspecialchars($_POST['type']) ?> Type Pokemon</h2>
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
                <a href="http://cmpsc431-s3-g-12.vmhost.psu.edu/showevochain.php"><button type="button" style="font-size: 20px;">Search for another Evolution Chain</button></a>
</div>
</div>
</div>
</body>
</html>