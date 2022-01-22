<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_SESSION["loggedin"]) === false || $_SESSION["loggedin"] === false){
    //$username = 'group12';
    header("location: login.php");
    exit;
}

$username = $_SESSION["username"];
$password = 'pokemon';
$host = 'CMPSC431-S3-G-12.vmhost.psu.edu';
$dbname = 'group12_431W';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $sql = 'SELECT e.evolutionId, p.pokeId, p.pokename AS pokename_before_evolution, e.evolves_to, d.pokename AS pokename_after_evolution FROM Pokedex p INNER JOIN Evolution e ON p.pokeId=e.pokeId INNER JOIN Pokedex d ON d.pokeId=e.evolves_to ORDER BY evolutionId';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database: $dbname " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Add an Evolution Chain</title>
</head>

<body>
    <div style="background-color:midnightblue;color:white;padding:2%;">
        <div id="container">

            <img src="pokelogo.png" alt="Logo"> <br>
            <br><?php include 'home.php'; ?>
            <div style="background-color:midnightblue;color:white;padding:2%;">

            <h2> Add New Link to Evolution Chain </h2>
            <h4> The new link must be from an existing pokemon to existing pokemon. </h4>
                <form action="/insert_evo.php" method="post">
                    <table>
                        <tr>
                            <td>Pokemon Id:</td>
                            <td><input type="text" id="pokeId" name="pokeId" value=""></td>
                        </tr>
                        <tr>
                            <td>Evolves To Id:</td>
                            <td><input type="text" id="evolves_to" name="evolves_to" value=""></td>
                        </tr>
                    </table>
                    <input type="submit" value="ADD">
                </form>

                <h2>The Current Evolution Chain</h2>
                <table border=1 cellspacing=5 cellpadding=5 style="background-color: white; color: midnightblue">
                    <thead>
                        <tr>
                            <th>Evolution ID</th>
                            <th>PokeId</th>
                            <th>Pokename Before Evolution</th>
                            <th>Evolves To</th>
                            <th>Pokename After Evolution</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $q->fetch()) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['evolutionId']) ?></td>
                                <td><?php echo htmlspecialchars($row['pokeId']) ?></td>
                                <td><?php echo htmlspecialchars($row['pokename_before_evolution']); ?></td>
                                <td><?php echo htmlspecialchars($row['evolves_to']); ?></td>
                                <td><?php echo htmlspecialchars($row['pokename_after_evolution']); ?></td>
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