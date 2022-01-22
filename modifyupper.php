<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = 'group12';
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
        //$sqlt = 'START TRANSACTION';
        $sql = 'UPDATE Pokedex SET evolves_from = "'.$_POST["evolvesFrom"] . '"';
        $sql = $sql.'WHERE pokename = "'.$_POST["pokename"] . '"';
        //$sqlf = 'SELECT EXISTS(SELECT * from Pokedex where pokeId = "'.$_POST["evolvesFrom"] . '")';
        //$sqlf = $sqlf. 'AS EXIST'; 

				try {
					$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          //$conn->exec($sqlt);
					$conn->exec($sql);
          //$conn->exec($sqlf);
          //$sqlc ='ROLLBACK';
          //$value = $_row['EXIST']; 
          //var_dump($value);
          
          //if($value === 1){
            //$sqlc = 'COMMIT';
            //exit;
          //}
          //else if ($value === 0){
            //$sqlc = 'ROLLBACK';
            //exit('The pokemon is not exist in pokedex');
          //}
          //$conn->exec($sqlc);
					//echo "New record created successfully";
			?>
				<p>You will be redirected in 3 seconds</p>
				<script>
					var timer = setTimeout(function() {
						window.location='modifyevolution.php'
					}, 3000);
				</script>
			<?php
				} catch(PDOException $e) {
					//echo $sqlt . "<br>" . $e->getMessage();
          echo $sql . "<br>" . $e->getMessage();
          echo $sqlf . "<br>" . $e->getMessage();
          //echo $sqlc . "<br>" . $e->getMessage();
				}
				$conn = null;
			?>
		</p>
    </body>
</div>
</html>
