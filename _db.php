<?php

$hostname="localhost";
$dbUser="root";
$dbPassword="";
$dbName="safebit";
// $conn = mysqli_connect('localhost', 'swifbxyt_swiftblock', 'swiftblockadmin123', 'swifbxyt_swiftblock');
$conn = mysqli_connect($hostname, $dbUser, $dbPassword, $dbName);

if(!$conn){
    die("something went wrong, check your network");
}