<?php
require_once("./class/editorLibro.php");

$biblioteca = new EditorLibros();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['Titulo'] ?? '';
    $autor = $_POST['Autor'] ?? '';
    $año = (int)($_POST['Año'] ?? 0);
    $var = $_POST['var'] ?? '';
    // $biblioteca->agregarPublicacion($titulo, $autor, $año, $var);

    // Verificar si el valor de 'var' es un número (para libros) o una palabra (para revistas)
    if (is_numeric($var)) {
        // Si es un número, se interpreta como un libro (número de páginas)
        $paginas = (int)$var;
        $biblioteca->agregarPublicacion($titulo, $autor, $año, $paginas);  // Llama a la función para agregar un libro
        
    } else {
        // Si no es un número, se interpreta como una revista (temática)
        $tematica = $var;
        $biblioteca->agregarPublicacion($titulo, $autor, $año, $tematica);  // Llama a la función para agregar una revista
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Publicación</title>
    <link rel="stylesheet" href="stylobiblioteca.css">
</head>
<body>
    <h1>GESTOR DE  BIBLIOTECA</h1>

    <a href="indexLibros.php"><button>Listado de libros</button></a>
    <a href="indexRevistas.php"><button>Listado de revistas</button></a>

    <h2>Añadir publicacion</h2>

    <form method="post">
        
        <label for="Titulo">Título:</label>
        <input type="text" id="Titulo" name="Titulo" required>
       
        <label for="Autor">Autor:</label>
        <input type="text" id="Autor" name="Autor" required>
        
        <label for="Año">Año:</label>
        <input type="number" id="Año" name="Año" required>
        
        <label for="var">Paginas de libro o Tematica de revista</label>
        <input type="text" id="var" name="var" required>
        
        <button type="submit">Agregar Publicación</button>     
    </form>

</html>
