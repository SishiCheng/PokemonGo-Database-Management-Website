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

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Group 12: Pokemon Go Application</title>
    </head>
    <body>  
		<p>
			<?php 
				echo "Modifying PokeId: " . $_POST["pokeId"] . "...";
        
        $sqlt = 'START TRANSACTION';
        $sql = 'UPDATE Pokedex SET evolves_from = "'.$_POST["evolves_from"] . '" WHERE pokeId = "'.$_POST["pokeId"] . '"';
        $sqlb = 'SELECT EXISTS(SELECT * from Pokedex where pokeId = '.$_POST["evolves_from"] . ')';
        $sqlb = $sqlb. 'AS EXIST';
        $sqle = 'SELECT EXISTS(SELECT * from Pokedex where pokeId = '.$_POST["pokeId"] . ')';
        $sqle = $sqle. 'AS EXIST';
				try {
					$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
          $conn->exec($sqlt);
					$conn->exec($sql);
          $qb = $conn->query($sqlb);
          $qb->setFetchMode(PDO::FETCH_ASSOC);
          $valueb = $qb->fetch();
          $q = $conn->query($sqle);
          $q->setFetchMode(PDO::FETCH_ASSOC);
          $sqlc ='ROLLBACK';
          $value = $q->fetch();
					
          if($value['EXIST'] === 1 && $valueb['EXIST'] === 1){
            $sqlc = 'COMMIT';
            //echo $sqlc;
            $conn->exec($sqlc);
					  echo "New record created successfully";
            //exit;
          }
          else if ($value['EXIST'] === 0 || $valueb['EXIST'] === 0){
            $sqlc = 'ROLLBACK';
            echo 'The pokemon is not exist in pokedex<br>';
            $conn->exec($sqlc);
					  echo "ROLLBACK";
          }
			?>
				<p>You will be redirected in 3 seconds</p>
				<script>
					var timer = setTimeout(function() {
						window.location='modify.php'
					}, 3000);
				</script>
			<?php
				} catch(PDOException $e) {
          echo $sqlt . "<br>" . $e->getMessage();    
					echo $sql . "<br>" . $e->getMessage();
          echo $sqlb . "<br>" . $e->getMessage();  
          echo $sqle . "<br>" . $e->getMessage();  
          echo $sqlc . "<br>" . $e->getMessage();            
				}
				$conn = null;
			?>
		</p>
    </body>
</div>
</html>


