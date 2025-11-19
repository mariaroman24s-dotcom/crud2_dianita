<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Personas</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<div class="container">
    <h2>Gestión de Personas</h2>
    <button id="btn_agregar" onclick="abrirFormulario()">+ Nueva persona</button>

    <br><br>
    <h2>Listado de personas</h2>

    <?php
        include "personas_crud.php";
    ?>

</div>

<div id="modalPersona" class="modal">
    <div class="modal-content">
        <span class="cerrar">&times;</span>
        <h2 id="tituloPersona"></h2>
        <p><strong>Puesto:</strong> <span id="puestoPersona"></span></p>
        <p><strong>Salario:</strong> $<span id="salarioPersona"></span></p>
    </div>
</div>

<div id="modalFormulario" class="modal">
    <div class="modal-content">
        <span class="cerrarFormulario">&times;</span>
        <h2>Registrar persona</h2>

        <form method="post" action="index.php" id="formPersona">
            <input type="hidden" name="id" id="id">

            <label>Nombre:</label>
            <input type="text" name="nombre" required>

            <label>Puesto:</label>
            <input type="text" name="puesto" required>

            <label>Salario:</label>
            <input type="number" step="0.01" name="salario" required>

            <button type="submit" name="crear" id="btn-form">Guardar</button>
        </form>
    </div>
</div>


<script>
function mostrarPersona(nombre, puesto, salario) {
    document.getElementById("tituloPersona").textContent = nombre;
    document.getElementById("puestoPersona").textContent = puesto;
    document.getElementById("salarioPersona").textContent = salario;

    document.getElementById("modalPersona").style.display = "block";
}

document.querySelector(".cerrar").onclick = function() {
    document.getElementById("modalPersona").style.display = "none";
};

function abrirFormulario() {
    document.getElementById("modalFormulario").style.display = "block";
}

document.querySelector(".cerrarFormulario").onclick = function() {
    document.getElementById("modalFormulario").style.display = "none";
};


function editarPersona(id, nombre, puesto, salario) {
    document.querySelector("input[name='nombre']").value = nombre;
    document.querySelector("input[name='puesto']").value = puesto;
    document.querySelector("input[name='salario']").value = salario;
    document.getElementById("id").value = id;

    const boton = document.querySelector("button[name='crear']");
    boton.name = "actualizar";
    boton.textContent = "Actualizar";

    document.getElementById("modalFormulario").style.display = "block";
}
</script>

</body>
</html>
