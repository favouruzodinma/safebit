<?php

$hostname="localhost";
$dbUser="root";
$dbPassword="";
$dbName="safebit";
$conn = mysqli_connect('localhost', 'safedapl_server', '!@#admin!@#', 'safedapl_server');
// $conn = mysqli_connect($hostname, $dbUser, $dbPassword, $dbName);

if(!$conn){ 
    die("something went wrong, check your network");
}