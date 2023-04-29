<?php

//connect to database using PDO


$connString = "mysql:host=localhost;dbname=webproject"; //TODO: Enter your database name
$user = "root";
$pass = "";
$dbname = "webproject";


try {

    $conn = new PDO($connString, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}

?>
