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

?>
<!DOCTYPE html>
<html>

<head>
	<title>Group 12: Pokemon Go Application</title>
</head>

<body>
	<p>
		<?php
		echo "Inserting new Pokemon: " . $_POST["pokename"] . "...";
    $sqlt = 'START TRANSACTION';
		$sql = 'INSERT INTO Pokedex (pokeId, pokename, height, weight, generation, catch_rate, flee_rate, evolves_from)';
		$sql = $sql . 'VALUES ("' . $_POST["pokeId"] . '","' . $_POST["pokename"] . '","' . $_POST["height"] . '","' . $_POST["weight"] . '","' . $_POST["generation"] . '","' . $_POST["catch_rate"] . '","' . $_POST["flee_rate"] . '","' . $_POST["evolves_from"] . '")';
    $sqlc = 'COMMIT';
		try {
			$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->exec($sql);
			echo "New record created successfully";
		?>
			<p>You will be redirected in 3 seconds</p>
			<script>
				var timer = setTimeout(function() {
					window.location = 'start.php'
				}, 3000);
			</script>
		<?php
		} catch (PDOException $e) {
      echo $sqlt . "<br>" . $e->getMessage();
			echo $sql . "<br>" . $e->getMessage();
      echo $sqlc . "<br>" . $e->getMessage();
		}
		$conn = null;
		?>
	</p>
</body>
</div>

</html>