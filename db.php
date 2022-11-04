<?php
$hostName = 'localhost';
$userName = 'root';
$password = '';
$dbName = 'blogs_db';

$_conn = mysqli_connect($hostName, $userName, $password, $dbName) or die("could not connect");