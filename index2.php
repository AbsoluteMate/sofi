<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "sofi";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT studenti.nome as n_studente, studenti.cognome as c_studente, scuole.nome as n_scuole FROM studenti INNER JOIN scuole ON scuole.id = studenti.scuole_fk";
$listaStudenti = $conn->query($sql);

$sql2 = "SELECT * FROM scuole";
$listaScuole = $conn->query($sql2);
$conn->close();
?>

<!DOCTYPE html>
<html lang="ita">

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 75%;
            margin: 50px auto;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
    <title>Test</title>
</head>

<body>
    <h2 style="text-align:center;">Cerca un studente</h2>
    <form action="/search.php">
        <label for="fname">Nome:</label><br>
        <input type="text" id="fname" name="fname" value="John" required><br>
        <label for="lname">Cognome:</label><br>
        <input type="text" id="lname" name="lname" value="Doe" required><br><br>
        <input type="submit" value="Submit">
    </form>

    <h2 style="text-align:center;">Tabella studenti-scuola</h2>

    <table>
        <tr>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Scuola</th>
        </tr>
        <?php
        if ($listaStudenti->num_rows > 0) {
            // output data of each row
            while ($row = $listaStudenti->fetch_assoc()) {
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

    <h2 style="text-align:center;margin-top:50px;">Inserisci un nuovo studente</h2>
    <form action="/addStudente.php">
        <label for="fname">Nome:</label><br>
        <input type="text" id="fname" name="fname" value="John" required><br>
        <label for="lname">Cognome:</label><br>
        <input type="text" id="lname" name="lname" value="Doe" required><br><br>
        <input type="submit" value="Submit">
        <select name="scuola" id="scuola" required>
            <?php
            if ($listaScuole->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value=' + $row["id"] + '>' + $row["nome"] + '</option>';
                }
            } else {
                echo '<option disabled>Nessuna scuola registrata</option>';
            }
            ?>
        </select>
    </form>

    <h2 style="text-align:center;margin-top:50px;">Inserisci una nuova scuola</h2>
    <form action="/addScuola.php">
        <label for="scname">Nome:</label><br>
        <input type="text" id="scname" name="scname"><br>
        <input type="submit" value="Submit">
    </form>



</body>

</html>