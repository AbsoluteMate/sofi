<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$n = $_POST["nome"];
$c = $_POST["cognome"];
$d = $_POST["scuola"];

$sql = "INSERT INTO studenti (nome, cognome, scuola_fk)
VALUES ('" . $n . "', '" . $c . "' , '" . $d . "')";

if ($conn->query($sql) === true) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    die();
}

$conn->close();
header("Location: /");
