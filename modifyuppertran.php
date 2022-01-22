<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $username = $_SESSION["username"];
    //exit;
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
      //$_POST["pokename"]="";
      //$_POST["evolvesFrom"]="";
				echo "Modifying the Evolution chain: " . $_POST["pokename"] . "...";
        $sqlt = 'START TRANSACTION';
        $sql = 'UPDATE Pokedex SET evolves_from = "'.$_POST["evolvesFrom"] . '"';
        $sql = $sql.'WHERE pokename = "'.$_POST["pokename"] . '"';
        //$sqlf = 'SELECT EXISTS(SELECT * from Pokedex where pokeId = 6) AS A;';
        $sqlf = 'SELECT EXISTS(SELECT * from Pokedex where pokeId = "'.$_POST["evolvesFrom"] . '")';
        $sqlf = $sqlf. 'AS EXIST'; 

				try {
					$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
          $conn->exec($sqlt);
					$conn->exec($sql);
          $q = $conn->query($sqlf);
          $q->setFetchMode(PDO::FETCH_ASSOC);
          $sqlc ='ROLLBACK';
          $value = $q->fetch(); 
          //var_dump($value);
          
          if($value['EXIST'] === 1){
            $sqlc = 'COMMIT';
            $conn->exec($sqlc);
					  echo "New record created successfully";
            //exit;
          }
          else if ($value['EXIST'] === 0){
            $sqlc = 'ROLLBACK';
            echo 'The pokemon is not exist in pokedex<br>';
            $conn->exec($sqlc);
					  echo "ROLLBACK";
          }
          //var_dump($sqlc);
			?>
				<p>You will be redirected in 3 seconds</p>
				<script>
					var timer = setTimeout(function() {
						window.location='modifyevolution.php'
					}, 3000);
				</script>
			<?php
				} catch(PDOException $e) {
					echo $sqlt . "<br>" . $e->getMessage();
          echo $sql . "<br>" . $e->getMessage();
          echo $sqlf . "<br>" . $e->getMessage();
          echo $sqlc . "<br>" . $e->getMessage();
				}
				$conn = null;
			?>
		</p>
    </body>
</div>
</html>
