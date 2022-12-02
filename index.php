<?php



require("database.php");

$old_nome = "";
$old_cognome = "";
$where = "";
if (isset($_POST["nome"]) && isset($_POST["cognome"])) {
    $old_nome = $_POST["nome"];
    $old_cognome = $_POST["cognome"];
    $where = "WHERE calciatori.nome = '" . $_POST["nome"] . "' AND calciatori.cognome = '" . $_POST["cognome"] . "'";
}

$sql = "SELECT COUNT(fk_partite.id_partita) as part_p, calciatori.id as id_c, calciatori.nome as nome_c, calciatori.cognome as cog_c,calciatori.nazionalita as naz_c,squadre.nome as n_s
        FROM calciatori INNER JOIN fk_squadre ON calciatori.id = fk_squadre.id_calciatore
        INNER JOIN squadre ON squadre.id = fk_squadre.id_squadra
        INNER JOIN fk_partite ON squadre.id = fk_partite.id_squadra " . $where . "
        GROUP BY calciatori.id";
$lista = $conn->query($sql) or die($conn->error);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sofia Pegoraro</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1 class="text-center mb-5 mt-5">Lista giocatori/squadra</h1>
        <div class="row">
            <div class="col-6">
                <form class="form-inline" action="/index.php" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nome calciatore</label>
                        <input type="text" class="form-control" name="nome" placeholder="Nome" value="<?php echo $old_nome ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Cognome Calciatore</label>
                        <input type="text" class="form-control" name="cognome" placeholder="Cognome" value="<?php echo $old_cognome ?>">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Cerca</button>

                </form>
            </div>
            <div class="col-6">

            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Giocatore</th>
                    <th scope="col">Nazionalità</th>
                    <th scope="col">Squadra</th>
                    <th scope="col">Partite giocate</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($lista->num_rows > 0) {
                    $counter = 0;
                    // output data of each row
                    while ($row = $lista->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td scope="row">' .  $counter . '</td>';
                        echo '<td>' . $row["nome_c"] . ' ' . $row["cog_c"] . '</td>';
                        echo '<td>' . $row["naz_c"] . '</td>';
                        echo '<td>' . $row["n_s"] . '</td>';
                        echo '<td>' . $row["part_p"] . '</td>';
                        echo '</tr>';
                        $counter++;
                    }
                } else {
                    echo '<tr>';
                    echo '<td colspan="5">Nessun risultato trovato</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>


</body>

</html>