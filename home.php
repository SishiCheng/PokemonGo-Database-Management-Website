<!-- HomeIndex View for Group12's Final Project: Pokemon Go -->
<!-- Currently only provides the header navigation buttons -->
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//$username = 'group12';
//$password = 'pokemon';
//$host = 'CMPSC431-S3-G-12.vmhost.psu.edu';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Group 12: Pokemon Database Home Page</title>
    </head>
    <style>
    .button {
        border: none;
        color: white;
        padding: 4px 5px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 10px;
        margin: 1px -3px;
        cursor: pointer;
        border-style: solid;
        border-color: white;
    }
    wl:link, wl:visited {
        color: white;
        padding: 1px 1px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-family:verdana;
        font-weight: bold
    }
    .button1 {background-color: #2699fb;color: white;} 
    </style>

    <body>
    <div style="background-color:midnightblue;color:white;padding:2%;">
        <a href="http://cmpsc431-s3-g-12.vmhost.psu.edu/start.php"><button type="button" class="button button1">HOME PAGE</button></a>
        <a href="http://cmpsc431-s3-g-12.vmhost.psu.edu/login.php"><button type="button" class="button button1">USER LOGIN</button></a>
        <a href="http://cmpsc431-s3-g-12.vmhost.psu.edu/lookup.php"><button type="button" class="button button1">POKEMON LOOK UP</button></a>
        <a href="http://cmpsc431-s3-g-12.vmhost.psu.edu/modify.php"><button type="button" class="button button1">MODIFY POKEMON</button></a>
        <a href="http://cmpsc431-s3-g-12.vmhost.psu.edu/showevochain.php"><button type="button" class="button button1">SHOW EVOLUTION CHAINS</button></a>
        <a href="http://cmpsc431-s3-g-12.vmhost.psu.edu/add_evoChain.php"><button type="button" class="button button1">ADD EVOLUTION CHAINS</button></a>
        <a href="http://cmpsc431-s3-g-12.vmhost.psu.edu/delete_evoChain.php"><button type="button" class="button button1">DELETE EVOLUTION CHAINS</button></a>
        <a href="http://cmpsc431-s3-g-12.vmhost.psu.edu/modifyevolution.php"><button type="button" class="button button1">MODIFY EVOLUTION</button></a>
        <a href="http://cmpsc431-s3-g-12.vmhost.psu.edu/top15byFleeRate2.php"><button type="button" class="button button1">TOP 15 BY FLEE RATE!</button></a>
        <a href="http://cmpsc431-s3-g-12.vmhost.psu.edu/top15byChargeMove2.php"><button type="button" class="button button1">TOP 15 BY CHARGE MOVE!</button></a>
        <a href="http://cmpsc431-s3-g-12.vmhost.psu.edu/top15byFastMove2.php"><button type="button" class="button button1">TOP 15 BY FAST MOVE!</button></a>
        <a href="http://cmpsc431-s3-g-12.vmhost.psu.edu/logout.php"><button type="button" class="button button1">LOGOUT</button></a>
        <br>
    </body>
</html>
