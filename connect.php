<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "dirkrhys15";
$dberror1 = "Could not connect to database";
$dberror2 = "Could not find the selected table";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die($dberror1);