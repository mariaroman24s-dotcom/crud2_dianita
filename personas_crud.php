<?php
$connection = pg_connect("host=localhost port=5432 user=postgres password=3312 dbname=CRUD");

if (!$connection) {
    die("Error de conexión a la base de datos");
}


/*  CREATE */
if (isset($_POST['crear'])) {

    $nombre = $_POST['nombre'];
    $puesto = $_POST['puesto'];
    $salario = $_POST['salario'];

    $query = "INSERT INTO personas (nombre, puesto, salario) VALUES ($1, $2, $3)";
    pg_prepare($connection, "insert_persona", $query);
    $result = pg_execute($connection, "insert_persona", [$nombre, $puesto, $salario]);

    if ($result) {
        echo "<script>
            alert('Persona registrada correctamente 💗');
            window.location.href='index.php';
        </script>";
    }
}

pg_close($connection);
?>
