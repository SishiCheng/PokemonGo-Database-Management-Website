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

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $username = $_SESSION["username"];
    //exit;
}

//$username = 'group12';
$password = 'pokemon';
$host = 'CMPSC431-S3-G-12.vmhost.psu.edu';
$dbname = 'group12_431W';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $sql = 'SELECT e.evolutionId, p.pokeId, p.pokename AS pokename_before_evolution, e.evolves_to, d.pokename AS pokename_after_evolution FROM Pokedex p INNER JOIN Evolution e ON p.pokeId=e.pokeId INNER JOIN Pokedex d ON d.pokeId=e.evolves_to ORDER BY evolutionId';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Delete an Evolution Chain</title>
</head>

<body>
    <div style="background-color:midnightblue;color:white;padding:2%;">
        <div id="container">

            <img src="pokelogo.png" alt="Logo"> <br>
            <br><?php include 'home.php'; ?>
            <div style="background-color:midnightblue;color:white;padding:2%;">

                <h2>Delete an Evolution Chain</h2>

                <table border=1 cellspacing=5 cellpadding=5 style="background-color: white; color: midnightblue">
                    <thead>
                        <tr>
                            <th>Evolution ID</th>
                            <th>PokeId</th>
                            <th>Pokename Before Evolution</th>
                            <th>Evolves To</th>
                            <th>Pokename After Evolution</th>
                            <th>Action</th>
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
                                <td><?php echo '<form action="/delete_evo.php" method="post"> <input type="submit" value="DELETE"> <input type="hidden" name="evolutionId" value="' . htmlspecialchars($row['evolutionId']) . '"><input type="hidden" name="pokeId" value="' . htmlspecialchars($row['pokeId']) . '"><input type="hidden" name="evolves_to" value="' . htmlspecialchars($row['evolves_to']) . '"></form>'; ?></td>
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