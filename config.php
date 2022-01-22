<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'CMPSC431-S3-G-12.vmhost.psu.edu');
define('DB_USERNAME', 'group12');
define('DB_PASSWORD', 'pokemon');
define('DB_NAME', 'group12_431W');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>