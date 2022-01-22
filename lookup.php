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
    $sql = 'SELECT evolutionId, p.pokeId, p.pokename, evolves_to FROM Pokedex p, Evolution e WHERE p.pokeId=e.pokeId order by evolutionId';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database: $dbname " . $e->getMessage());
}
?>

<!DOCTYPE html>

<html>

<head>
    <title>Look Up by Type, Fast Move and/or Charge Move</title>
</head>

<body>
    <div style="background-color:midnightblue;color:white;padding:2%;">
        <div id="container">

            <img src="pokelogo.png" alt="Logo"> <br>
            <br><?php include 'home.php'; ?>
            <div style="background-color:midnightblue;color:white;padding:2%;">

            <h2> Select the Type, Fast Move and/or Charge Move you want </h2>
            <form action="/searchby.php" method="post">
            <label for="type" >Choose a Type:</label>
  				<select name="type" id="type">
  					<option value="Grass">Grass</option>
  					<option value="Bug">Bug</option>
  					<option value="Dark">Dark</option>
  					<option value="Dragon">Dragon</option>
  					<option value="Electric">Electric</option>
  					<option value="Fairy">Fairy</option>
  					<option value="Fighting">Fighting</option>
  					<option value="Fire">Fire</option>
  					<option value="Flying">Flying</option>
  					<option value="Ghost">Ghost</option>
  					<option value="Ground">Ground</option>
  					<option value="Ice">Ice</option>
    				<option value="Normal">Normal</option>
    				<option value="Poison">Poison</option>
    				<option value="Psychic">Psychic</option>
    				<option value="Rock">Rock</option>
    				<option value="Steel">Steel</option>
    				<option value="Water">Water</option>    				
  				</select>
  			<label for="fm_name" >| Choose a Fast Move: </label>
  				<select name="fm_name" id="fm_name">
    				<option value="Acid">Acid</option>
    				<option value="Air Slash">Air Slash</option>
    				<option value="Astonish">Astonish</option>
    				<option value="Bite">Bite</option>
    				<option value="Bubble">Bubble</option>
    				<option value="Bug Bite">Bug Bite</option>
    				<option value="Bullet Punch">Bullet Punch</option>
    				<option value="Bullet Seed">Bullet Seed</option>
    				<option value="Charge Beam">Charge Beam</option>
    				<option value="Charm">Charm</option>
    				<option value="Confusion">Confusion</option>
    				<option value="Counter">Counter</option>
    				<option value="Cut">Cut</option>
    				<option value="Dragon Breath">Dragon Breath</option>
    				<option value="Dragon Tail">Dragon Tail</option>
    				<option value="Ember">Ember</option>
    				<option value="Extrasensory">Extrasensory</option>
    				<option value="Feint Attack">Feint Attack</option>
    				<option value="Fire Fang">Fire Fang</option>
    				<option value="Fire Spin">Fire Spin</option>
    				<option value="Frost Breath">Frost Breath</option>
    				<option value="Fury Cutter">Fury Cutter</option>
    				<option value="Gust">Gust</option>
    				<option value="Hex">Hex</option>
    				<option value="Hidden ower">Hidden ower</option>
    				<option value="Ice Fang">Ice Fang</option>
    				<option value="Ice Shard">Ice Shard</option>
    				<option value="Incinerate">Incinerate</option>
    				<option value="Infestation">Infestation</option>
    				<option value="Iron Tail">Iron Tail</option>
    				<option value="Karate Chop">Karate Chop</option>
    				<option value="Lick">Lick</option>
    				<option value="Lock On">Lock On</option>
    				<option value="Low Kick">Low Kick</option>
    				<option value="Metal Claw">Metal Claw</option>
    				<option value="Mud Shot">Mud Shot</option>
    				<option value="Mud Slap">Mud Slap</option>
    				<option value="Peck">Peck</option>
    				<option value="Poison Jab">Poison Jab</option>
    				<option value="Poison Sting">Poison Sting</option>
    				<option value="Pound">Pound</option>
    				<option value="Powder Snow">Powder Snow</option>
    				<option value="Present">Present</option>
    				<option value="Psycho Cut">Psycho Cut</option>
    				<option value="Quick Attack">Quick Attack</option>
    				<option value="Razor Leaf">Razor Leaf</option>
    				<option value="Rock Smash">Rock Smash</option>
    				<option value="Rock Throw">Rock Throw</option>
    				<option value="Scratch">Scratch</option>
    				<option value="Shadow Claw">Shadow Claw</option>
    				<option value="Smack Down">Smack Down</option>
    				<option value="Snarl">Snarl</option>
    				<option value="Spark">Spark</option>
    				<option value="Splash">Splash</option>
    				<option value="Steel Wing">Steel Wing</option>
    				<option value="Struggle Bug">Struggle Bug</option>
    				<option value="Sucker Punch">Sucker Punch</option>
    				<option value="Tackle">Tackle</option>
    				<option value="Take Down">Take Down</option>
    				<option value="Thunder Fang">Thunder Fang</option>
    				<option value="Thunder Shock">Thunder Shock</option>
    				<option value="Transform">Transform</option>
    				<option value="Vine Whip">Vine Whip</option>
    				<option value="Volt Switch">Volt Switch</option>
    				<option value="Water Gun">Water Gun</option>
    				<option value="Water Gun Blastoise">Water Gun Blastoise</option>
    				<option value="Waterfall">Waterfall</option>
    				<option value="Wing Attack">Wing Attack</option>				
  				</select>
  			<label for="andor" > | </label>
  				<select name="andor" id="andor">
    				<option value="OR">OR</option>
  					<option value="AND">AND</option>
    			</select>
  			<label for="cm_name" > | Choose a Charge Move: </label>
  				<select name="cm_name" id="cm_name">  					
    				<option value="Seed Bomb">Seed Bomb</option>
    				<option value="Acid Spray">Acid Spray</option>
    				<option value="Aerial Ace">Aerial Ace</option>
    				<option value="Aeroblast">Aeroblast</option>
    				<option value="Air Cutter">Air Cutter</option>
    				<option value="Ancient Power">Ancient Power</option>
    				<option value="Aqua Jet">Aqua Jet</option>
    				<option value="Aqua Tail">Aqua Tail</option>
    				<option value="Aura Sphere">Aura Sphere</option>
    				<option value="Aurora Beam">Aurora Beam</option>
    				<option value="Avalanche">Avalanche</option>
    				<option value="Blast Burn">Blast Burn</option>
    				<option value="Blaze Kick">Blaze Kick</option>
    				<option value="Blizzard">Blizzard</option>
    				<option value="Body Slam">Body Slam</option>
    				<option value="Bone Club">Bone Club</option>
    				<option value="Brave Bird">Brave Bird</option>
    				<option value="Brick Break">Brick Break</option>
    				<option value="Brine">Brine</option>
    				<option value="Bubble Beam">Bubble Beam</option>
    				<option value="Bug Buzz">Bug Buzz</option>
    				<option value="Bulldoze">Bulldoze</option>
    				<option value="Close Combat">Close Combat</option>
    				<option value="Crabhammer">Crabhammer</option>
    				<option value="Cross Chop">Cross Chop</option>
    				<option value="Cross Poison">Cross Poison</option>
    				<option value="Crunch">Crunch</option>
    				<option value="Crush Claw">Crush Claw</option>
    				<option value="Dark Pulse">Dark Pulse</option>
    				<option value="Dazzling Gleam">Dazzling Gleam</option>
    				<option value="Dig">Dig</option>
    				<option value="Disarming Voice">Disarming Voice</option>
    				<option value="Discharge">Discharge</option>
    				<option value="Doom Desire">Doom Desire</option>
    				<option value="Draco Meteor">Draco Meteor</option>
    				<option value="Dragon Claw">Dragon Claw</option>
    				<option value="Dragon Pulse">Dragon Pulse</option>
    				<option value="Drain Punch">Drain Punch</option>
    				<option value="Draining Kiss">Draining Kiss</option>
    				<option value="Drill Peck">Drill Peck</option>
    				<option value="Drill Run">Drill Run</option>
    				<option value="Dynamic Punch">Dynamic Punch</option>
    				<option value="Earth Power">Earth Power</option>
    				<option value="Earthquake">Earthquake</option>
    				<option value="Energy Ball">Energy Ball</option>
    				<option value="Fell Stinger">Fell Stinger</option>
    				<option value="Fire Blast">Fire Blast</option>
    				<option value="Fire Punch">Fire Punch</option>
    				<option value="Fissure">Fissure</option>
    				<option value="Flame Burst">Flame Burst</option>
    				<option value="Flame Charge">Flame Charge</option>
    				<option value="Flame Wheel">Flame Wheel</option>
    				<option value="Flamethrower">Flamethrower</option>
    				<option value="Flash Cannon">Flash Cannon</option>
    				<option value="Fly">Fly</option>
    				<option value="Flying Press">Flying Press</option>
    				<option value="Focus Blast">Focus Blast</option>
    				<option value="Foul Play">Foul Play</option>
    				<option value="Frenzy Plant">Frenzy Plant</option>
    				<option value="Frustration">Frustration</option>
    				<option value="Futuresight">Futuresight</option>
    				<option value="Giga Drain">Giga Drain</option>
    				<option value="Giga Impact">Giga Impact</option>
    				<option value="Grass Knot">Grass Knot</option>
    				<option value="Gunk Shot">Gunk Shot</option>
    				<option value="Gyro Ball">Gyro Ball</option>
    				<option value="Heart Stamp">Heart Stamp</option>
    				<option value="Heat Wave">Heat Wave</option>
    				<option value="Heavy Slam">Heavy Slam</option>
    				<option value="Horn Attack">Horn Attack</option>
    				<option value="Horn Drill">Horn Drill</option>
    				<option value="Hurricane">Hurricane</option>
    				<option value="Hydro Cannon">Hydro Cannon</option>
    				<option value="Hydro Pump">Hydro Pump</option>
    				<option value="Hydro Pump Blastoise">Hydro Pump Blastoise</option>
    				<option value="Hyper Beam">Hyper Beam</option>
    				<option value="Hyper Fang">Hyper Fang</option>
    				<option value="Ice Beam">Ice Beam</option>
    				<option value="Ice Punch">Ice Punch</option>
    				<option value="Icy Wind">Icy Wind</option>
    				<option value="Iron Head">Iron Head</option>
    				<option value="Last Resort">Last Resort</option>
    				<option value="Leaf Blade">Leaf Blade</option>
    				<option value="Leaf Tornado">Leaf Tornado</option>
    				<option value="Leech Life">Leech Life</option>
    				<option value="Low Sweep">Low Sweep</option>
    				<option value="Lunge">Lunge</option>
    				<option value="Magnet Bomb">Magnet Bomb</option>
    				<option value="Mega Drain">Mega Drain</option>
    				<option value="Megahorn">Megahorn</option>
    				<option value="Meteor Mash">Meteor Mash</option>
    				<option value="Mirror Coat">Mirror Coat</option>
    				<option value="Mirror Shot">Mirror Shot</option>
    				<option value="Moonblast">Moonblast</option>
    				<option value="Mud Bomb">Mud Bomb</option>
    				<option value="Muddy Water">Muddy Water</option>
    				<option value="Night Shade">Night Shade</option>
    				<option value="Night Slash">Night Slash</option>
    				<option value="Octazooka">Octazooka</option>
    				<option value="Ominous Wind">Ominous Wind</option>
    				<option value="Origin Pulse">Origin Pulse</option>
    				<option value="Outrage">Outrage</option>
    				<option value="Overheat">Overheat</option>
    				<option value="Parabolic Charge">Parabolic Charge</option>
    				<option value="Petal Blizzard">Petal Blizzard</option>
    				<option value="Play Rough">Play Rough</option>
    				<option value="Poison Fang">Poison Fang</option>
    				<option value="Power Gem">Power Gem</option>
    				<option value="Power Up Punch">Power Up Punch</option>
    				<option value="Power Whip">Power Whip</option>
    				<option value="Precipice Blades">Precipice Blades</option>
    				<option value="Psybeam">Psybeam</option>
    				<option value="Psychic">Psychic</option>
    				<option value="Psycho Boost">Psycho Boost</option>
    				<option value="Psyshock">Psyshock</option>
    				<option value="Psystrike">Psystrike</option>
    				<option value="Razor Shell">Razor Shell</option>
    				<option value="Rest">Rest</option>
    				<option value="Return">Return</option>
    				<option value="Rock Blast">Rock Blast</option>
    				<option value="Rock Slide">Rock Slide</option>
    				<option value="Rock Tomb">Rock Tomb</option>
    				<option value="Rock Wrecker">Rock Wrecker</option>
    				<option value="Sacred Sword">Sacred Sword</option>
    				<option value="Sand Tomb">Sand Tomb</option>
    				<option value="Scald">Scald</option>
    				<option value="Scald Blastoise">Scald Blastoise</option>
    				<option value="Shadow Ball">Shadow Ball</option>
    				<option value="Shadow Bone">Shadow Bone</option>
    				<option value="Shadow Punch">Shadow Punch</option>
    				<option value="Shadow Sneak">Shadow Sneak</option>
    				<option value="Signal Beam">Signal Beam</option>
    				<option value="Silver Wind">Silver Wind</option>
    				<option value="Skull Bash">Skull Bash</option>
    				<option value="Sky Attack">Sky Attack</option>
    				<option value="Sludge">Sludge</option>
    				<option value="Sludge Bomb">Sludge Bomb</option>
    				<option value="Sludge Wave">Sludge Wave</option>
    				<option value="Solar Beam">Solar Beam</option>
    				<option value="Stomp">Stomp</option>
    				<option value="Stone Edge">Stone Edge</option>
    				<option value="Struggle">Struggle</option>
    				<option value="Submission">Submission</option>
    				<option value="Super Power">Super Power</option>
    				<option value="Surf">Surf</option>
    				<option value="Swift">Swift</option>
    				<option value="Synchronoise">Synchronoise</option>
    				<option value="Thunder">Thunder</option>
    				<option value="Thunder Punch">Thunder Punch</option>
    				<option value="Thunderbolt">Thunderbolt</option>
    				<option value="Tri Attack">Tri Attack</option>
    				<option value="Twister">Twister</option>
    				<option value="V Create">V Create</option>
    				<option value="Vice Grip">Vice Grip</option>
    				<option value="Water Pulse">Water Pulse</option>
    				<option value="Weather Ball Fire">Weather Ball Fire</option>
    				<option value="Weather Ball Ice">Weather Ball Ice</option>
    				<option value="Weather Ball Rock">Weather Ball Rock</option>
    				<option value="Weather Ball Water">Weather Ball Water</option>
    				<option value="Wild Charge">Wild Charge</option>
    				<option value="Wrap">Wrap</option>
    				<option value="Wrap Green">Wrap Green</option>
    				<option value="Wrap Pink">Wrap Pink</option>
    				<option value="X Scissor">X Scissor</option>
    				<option value="Zap Cannon">Zap Cannon</option>
  				</select>
  				<br>
  				<input type="submit" value="Search!" style="font-size: 20px;">
                </form>
                <br>
        <h3>Some search may get an empty result, if there is no matched pokemon</h3>
        <h6>This query joins all 7 tables we have except Evolution.</h6>
        <h6>The default search is an working example.</h6>
    </div>
</div>
</div>
</body>
</html>