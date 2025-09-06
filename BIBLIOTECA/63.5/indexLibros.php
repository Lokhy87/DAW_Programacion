<?php
require_once("./class/editorLibro.php");

$biblioteca = new EditorLibros();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $indice = (int)($_POST['indice']);
    $biblioteca->eliminarLibro($indice);
    echo "<p>Libro eliminado correctamente.</p>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Biblioteca</title>
    <link rel="stylesheet" href="stylobiblioteca.css">
</head>
<body>
    <h1>Listado de Biblioteca</h1>
    <a href="form.php"><button>Gestor de Libros y Revistas</button></a>


<h2>Listado de Libros</h2>
<?php if (count($biblioteca->getLibros()) == 0): ?>
    <p>No hay libros registrados</p>
<?php else: ?>
    <ul>
        <?php foreach ($biblioteca->getLibros() as $indice => $libro): ?>
            <li>
                <?php echo "Titulo: " . $libro->getTitulo() . ", Autor: " . $libro->getAutor() . ", Año: " . $libro->getAño() . ", Paginas: " . $libro->getPaginas(); ?>  
                    <form method="POST" class="delete-form">
                    <input type="hidden" name="indice" value="<?php echo $indice; ?>">
                    <button type="submit">Eliminar</button>
                </form>      
            </li>
        <?php endforeach; ?>
    </ul>      
<?php endif; ?>

</html>
