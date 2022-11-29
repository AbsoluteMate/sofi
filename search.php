<?php

$n = $_POST["nome"];
$c = $_POST["cognome"];

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "sofi";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT studenti.nome as n_studente, studenti.cognome as c_studente, scuola.nome as n_scuola
        FROM studenti
        INNER JOIN scuole ON scuole.id = studenti.scuole_fk
        WHERE studenti.nome = '" . $n . "' AND studenti.cognome = '" . $c . "'";
$result = $conn->query($sql);
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ricerca Studente</title>
</head>

<body>
    <h2 style="text-align:center;">Ricerca Studente: <? $n . "" . $c ?></h2>

    <table>
        <tr>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Scuola</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' + $row["n_studente"] + '</td>';
                echo '<td>' + $row["c_studente"] + '</td>';
                echo '<td>' + $row["n_scuola"] + '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td colspan="3">Nessun risultato trovato</td>';
            echo '</tr>';
        }
        ?>
    </table>
    <a hreh="../">Torna alla pagina principale</a>
</body>

</html>