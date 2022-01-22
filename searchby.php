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
    $sql = 'SELECT d.pokeId, pokename, type, fm_name, cm_name FROM Pokedex d, Type t, poketype pt, PokeFastMove pfm, Fast_Move fm, PokeChargeMove pcm, Charge_Move cm WHERE d.pokeId=pt.pokeId AND pt.typeId=t.typeId AND d.pokeId=pfm.pokeId AND pfm.fmID=fm.fmId AND d.pokeId=pcm.pokeId AND pcm.cmID=cm.cmID AND t.type="' . $_POST["type"] . '" AND (cm_name="' . $_POST["cm_name"] . '" '. $_POST["andor"] .' fm_name="' . $_POST["fm_name"] . '") order by fm_name, cm_name, pokeId';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} 
catch (PDOException $e) {
    die("Could not connect to the database: $dbname " . $e->getMessage());
}
?>

<!DOCTYPE html>

<html>

<head>
    <title>Look Up Result</title>
</head>

<body>
    <div style="background-color:midnightblue;color:white;padding:2%;">
        <div id="container">

        	<img src="pokelogo.png" alt="Logo">
        	<br><br>
            <?php include 'home.php'; ?>
            <div style="background-color:midnightblue;color:white;padding:2%;">

            	<h2>
            		<?php echo "Looking for " . $_POST["type"] . " type Pokemon with Fast Move " . $_POST["fm_name"] . " " . $_POST["andor"] . " Charge Move " . $_POST["cm_name"]; ?>
            	</h2>

                <h2>Here is the result for your Look Up</h2>
                <table border=1 cellspacing=5 cellpadding=5 style="background-color: white; color: midnightblue">
                    <thead>
                        <tr>
                            <th>PokeId</th>
                            <th>Pokename</th>
                            <th>Type</th>
                            <th>Fast Move</th>
                            <th>Charge Move</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $q->fetch()) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['pokeId']) ?></td>
                                <td><?php echo htmlspecialchars($row['pokename']); ?></td>
                                <td><?php echo htmlspecialchars($row['type']); ?></td>
                                <td><?php echo htmlspecialchars($row['fm_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['cm_name']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <br>
                <a href="http://cmpsc431-s3-g-12.vmhost.psu.edu/lookup.php"><button type="button" style="font-size: 20px;">Do Another Look Up</button></a>
                <br>
            </div>
        </div>
    </div>
</body>
</html>