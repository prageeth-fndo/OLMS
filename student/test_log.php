<?php 
session_start();
include 'inc/connection.php';

$request_uri = $_SERVER['REQUEST_URI'];

echo "<h3>Request URI: $request_uri</h3>";
?>

