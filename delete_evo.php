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

<body>
	<p>
		<?php
		echo "Deleting the evolution chain: " . $_POST["pokeId"] . " to " . $_POST["evolves_to"];
		$sql = 'DELETE FROM Evolution WHERE evolutionId = "' . $_POST["evolutionId"] . '"';
		try {
			$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->exec($sql);
			echo "<br>";
			echo nl2br("Evolution Chain deleted successfully");
		?>
			<p>You will be redirected in 3 seconds</p>
			<script>
				var timer = setTimeout(function() {
					window.location = 'delete_evoChain.php'
				}, 3000);
			</script>
		<?php
		} catch (PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
		$conn = null;
		?>
	</p>
</body>
</div>

</html>