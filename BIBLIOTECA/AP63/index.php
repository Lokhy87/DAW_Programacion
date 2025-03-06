<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Publicación</title>
    <link rel="stylesheet" href="styleBiblio.css">
</head>
<body>
    <h1>GESTOR DE UNA BIBLIOTECA</h1>
    <form action="" method="post">
        <div>
            <label for="Titulo">Título:</label>
            <input type="text" id="Titulo" name="Titulo" required>
        </div>
        <div>
            <label for="Autor">Autor:</label>
            <input type="text" id="Autor" name="Autor" required>
        </div>
        <div>
            <label for="Año">Año:</label>
            <input type="number" id="Año" name="Año" required>
        </div>
        <div>
            <label for="var">Paginas de libro o Tematica de revista</label>
            <input type="text" id="var" name="var" required>
        </div>
        <div>
            <button type="submit">Agregar Publicación</button>
        </div>
    </form>

<?php
require_once("./class/editorLibro.php");

$biblioteca = new EditorLibros();

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $titulo = $_POST['Titulo'] ?? '';
    $autor = $_POST['Autor'] ?? '';
    $año = (int)($_POST['Año'] ?? 0);
    $var = $_POST['var']; 

    if (!empty($titulo) && !empty($autor) && !empty($var)) {
        $biblioteca->agregarPublicacion($titulo, $autor, $año, $var);
        echo "<p>Publicacion '$titulo' agregado correctamente.</p>";
    } else {
        echo "<p>Por favor, completa todos los campos.</p>";
    }
}
?>

</html>



