<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pokeid=parse_url($_SERVER['REQUEST_URI'],PHP_URL_QUERY);

$username = 'group12';
$password = 'pokemon';
$host = 'CMPSC431-S3-G-12.vmhost.psu.edu';
$dbname = 'group12_431W';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo1 = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo2 = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $basicquery = 'SELECT * from Pokedex WHERE pokeId =';
    $basicquery = $basicquery . $pokeid;
    
    $chargemovequery = 'SELECT d.pokeId, d.pokename, cm_name, power, cooldown, 
        round(power/cooldown,1) AS DPS 
        FROM Pokedex d, PokeChargeMove pcm, Charge_Move cm 
    WHERE d.pokeId=pcm.pokeID AND pcm.cmID=cm.cmID AND d.pokeid=';
    $chargemovequery =$chargemovequery . $pokeid;
    
    $fastmovequery = 'SELECT d.pokeID, d.pokename,fm_name,power,cooldown,
	    round(power/cooldown,1) AS DPS
        FROM Pokedex d, PokeFastMove pfm, Fast_Move fm
        WHERE d.pokeID=pfm.pokeID AND pfm.fmID = fm.fmID AND d.pokeID = ';
    $fastmovequery =$fastmovequery . $pokeid;

    $q = $pdo->query($basicquery);
    $q->setFetchMode(PDO::FETCH_ASSOC);

    $cq = $pdo1->query($chargemovequery);
    $cq->setFetchMode(PDO::FETCH_ASSOC);

    $fq = $pdo2->query($fastmovequery);
    $fq->setFetchMode(PDO::FETCH_ASSOC);



    
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Group 12: Pokemon Go Application</title>
        <link rel="stylesheet" href="PokemonLookup.css">
    </head>
    
    
    
    

	<div style="background-color:#2699fb;color:black;padding:2%;">
        <div id="container">
	
	<img src="pokelogo.png" alt="Logo"><p><?php include 'home.php' ;?></p></div></div>
    <div style="background-color:#f1f9ff;color:black;padding:2%;">
    <h1 style ="color:#5b5b5b;font-family:verdana">Pokemon Lookup</h1>

    
    
    <p style ="color:#5b5b5b;font-family:verdana;font-weight: bold" >Use Pokemon Lookup to search for your favorite Pokemon and learn more about their base stats
(CP, HP, ATK, DEF), their base moves (quick and charge moves), and a short description about
your Pokemon.</p>
<br>
    </body>

    <?php while ($row = $q->fetch()): ?>

	<h2 style ="color:#5b5b5b;font-family:verdana">#<?php echo htmlspecialchars($row['pokeId']) ?> <?php echo htmlspecialchars($row['pokename']) ?>
    
    </h2>

        <table cellspacing=2 cellpadding=2>

        <!-- <div class="row">

    

        <div class="column" > -->
        <td>
            <table border=1 cellspacing=5 cellpadding=5 style="background-color: white; color: #289afb; border-collapse:collapse">
                
                <thead style ="color:#5b5b5b;font-family:verdana">
		            <p style ="color:#5b5b5b;font-family:verdana">Pokemon Status</p>
                </thead>
                <tbody>

                <thead>
		            <tr><th>Height</th><td><?php echo htmlspecialchars($row['height']); ?></td></tr>
                    <tr><th>Weight</th><td><?php echo htmlspecialchars($row['weight']); ?></td></tr>
			        <tr><th>Generation</th><td><?php echo htmlspecialchars($row['generation']) ?></td><tr>
			
                </thead>
			    
                    <?php endwhile; ?>
                </tbody>
            </table>
        </td>
        <!--</div>
        <div class ="column"><img src = "3.png" ></div>
        <div class ="column">-->
        <td><img src = "3.png" ></td>
        <td>
            <table border=1 cellspacing=5 cellpadding=5 style="background-color: white; color: #289afb;border-collapse:collapse">
                
                <thead style ="color:#5b5b5b;font-family:verdana">
                <p style ="color:#5b5b5b;font-family:verdana">Move Status</p>
                        <th>Move Name</th>
                        <th>Power</th>
                        <th>DPS</th>
                </thead>
                <tbody>
            <?php while ($moverow = $cq->fetch()): ?>
                <tr>
		            <td><?php echo htmlspecialchars($moverow['cm_name']); ?></td>
                    <td><?php echo htmlspecialchars($moverow['power']); ?></td>
			        <td><?php echo htmlspecialchars($moverow['DPS']) ?></td>
			
                </tr>    
			    
            <?php endwhile; ?>
                </tbody>
            </table>
        </td>
        <!--</div>-->
        </div>


		
    
</div>
</div>
</html>
