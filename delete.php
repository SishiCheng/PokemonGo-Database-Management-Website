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
		echo "Deleting pokemon: " . $_POST["pokeId"] . "...";
    $sqlt = 'START TRANSACTION';
		$sql = 'DELETE FROM Pokedex WHERE pokeId = "' . $_POST["pokeId"] . '"';
    $sqlc = 'COMMIT';
		try {
			$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->exec($sql);
			echo "Pokemon deleted successfully";
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