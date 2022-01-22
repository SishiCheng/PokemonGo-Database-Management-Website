<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $username = $_SESSION["username"];
}

//$username = 'group12';
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
				//echo "Modifying the Evolution chain: " . $_POST["pokename"] . "...";
        $sqlt = 'START TRANSACTION';
        $sql = 'UPDATE Evolution SET evolves_to = "'.$_POST["evolvesAfter"] . '"';
        $sql = $sql.'WHERE pokeId = "'.$_POST["pokeId"] . '" AND evolves_to = "'.$_POST["evolvesBefore"] . '"';
        $sqlb = 'SELECT EXISTS(SELECT * from Pokedex where pokeId = '.$_POST["evolvesAfter"] . ')';
        $sqlb = $sqlb. 'AS EXIST';
        $sqlf = 'SELECT EXISTS(SELECT * from Pokedex where pokeId = '.$_POST["pokeId"] . ')';
        $sqlf = $sqlf. 'AS EXIST';
        $sqle = 'SELECT EXISTS(SELECT * from Pokedex where pokeId = '.$_POST["evolvesBefore"] . ')';
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
          $q = $conn->query($sqlf);
          $q->setFetchMode(PDO::FETCH_ASSOC);
          $sqlc ='ROLLBACK';
          $value = $q->fetch();
          $qe = $conn->query($sqle);
          //echo $sqle;
          $qe->setFetchMode(PDO::FETCH_ASSOC);
          $valuee = $qe->fetch();
          
					if($value['EXIST'] === 1 && $valuee['EXIST'] === 1 && $valueb['EXIST'] === 1){
            $sqlc = 'COMMIT';
            //echo $sqlc;
            $conn->exec($sqlc);
					  echo "New record created successfully";
            //exit;
          }
          else if ($value['EXIST'] === 0 || $valuee['EXIST'] === 0 || $valueb['EXIST'] === 0){
            $sqlc = 'ROLLBACK';
            echo 'The pokemon is not exist in pokedex<br>';
            $conn->exec($sqlc);
					  echo "ROLLBACK";
          }
			?>
				<p>You will be redirected in 3 seconds</p>
				<script>
					var timer = setTimeout(function() {
						window.location='evolvesTo.php'
					}, 3000);
				</script>
			<?php
				} catch(PDOException $e) {
					echo $sqlt . "<br>" . $e->getMessage();
          echo $sql . "<br>" . $e->getMessage();
          echo $sqlb . "<br>" . $e->getMessage();
          echo $sqlf . "<br>" . $e->getMessage();
          echo $sqle . "<br>" . $e->getMessage();
          echo $sqlc . "<br>" . $e->getMessage();
				}
				$conn = null;
			?>
		</p>
    </body>
</div>
</html>
