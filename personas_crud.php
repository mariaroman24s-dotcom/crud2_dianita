<?php
$connection = pg_connect("host=localhost port=5432 user=postgres password=3312 dbname=crud2");

if (!$connection) {
    die("Error de conexión a la base de datos");
}
 ?>