<?php

$databaseHost = 'localhost';
$databaseName = 'db_uts';
$databaseUsername = 'root';
$databasePassword = '';

$conn = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 
 
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

?>
