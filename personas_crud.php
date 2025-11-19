<?php
$connection = pg_connect("host=localhost port=5432 user=postgres password=3312 dbname=CRUD");

if (!$connection) {
    die("Error de conexión a la base de datos");
}

/* CREATE */
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

/* READ */
$query = "SELECT id, nombre, puesto, salario FROM personas ORDER BY id DESC";
$result = pg_query($connection, $query);

if ($result && pg_num_rows($result) > 0) {

    echo "<table class='tabla-personas'>";
    echo "<tr>
            <th>Nombre</th>
            <th>Puesto</th>
            <th>Salario</th>
        </tr>";

    while ($row = pg_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($row['puesto']) . "</td>";
        echo "<td>$" . htmlspecialchars($row['salario']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>No hay personas registradas ❤️</p>";
}

/*DELETE */
if (isset($_POST["eliminar"])) {
    $id = $_POST["id"];

    $query = "DELETE FROM personas WHERE id = $1";
    pg_prepare($connection, "delete_persona", $query);
    pg_execute($connection, "delete_persona", [$id]);

    echo "<script>
        alert('Persona eliminada correctamente 💔');
        window.location.href='index.php';
    </script>";
}

/*UPDATE */
if (isset($_POST['actualizar'])) {

    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $puesto = $_POST["puesto"];
    $salario = $_POST["salario"];

    $query = "UPDATE personas 
              SET nombre=$1, puesto=$2, salario=$3 
              WHERE id=$4";

    pg_prepare($connection, "update_persona", $query);
    pg_execute($connection, "update_persona", [$nombre, $puesto, $salario, $id]);

    echo "<script>
            alert('Persona actualizada con éxito 💕');
            window.location.href='index.php';
        </script>";
}

pg_close($connection);
?>
