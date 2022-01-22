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
    $sql = 'SELECT * from Pokedex ORDER BY height DESC LIMIT 15';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
} ?>

<!DOCTYPE html>
<html>



<head>
    <title>Group 12: Show Top 15 Pokemon by Attribute</title>
</head>

<body>
    <div style="background-color:midnightblue;color:white;padding:2%;">
        <div id="container">

            <img src="pokelogo.png" alt="Logo">
            <br><br><?php include 'home.php'; ?>
            <div style="background-color:midnightblue;color:white;padding:2%;">
            
            <h2> Select an Attribute to Sort By:</h2>
                <form action="/searchtop15.php" method="post">
                    <label for="attribute">Choose an Attribute:</label>
                    <select name="attribute" id="attribute">
                        <option value="height">Height</option>
                        <option value="weight">Weight</option>
                        <option value="catch_rate">Catch Rate</option>
                        <option value="flee_rate">Flee Rate</option>
                    </select>
                    <input type="submit" value="Search!" style="font-size: 20px;">
                </form>
            <br>
</body>

</html>