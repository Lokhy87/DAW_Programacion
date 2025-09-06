<?php
require_once("./class/editorLibro.php");

$biblioteca = new EditorLibros();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $indice = (int)($_POST['indice']);
    $biblioteca->eliminarRevista($indice);
    echo "<p>Revista eliminada correctamente.</p>";
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

<h2>Listado de Revistas</h2>
<?php if (count($biblioteca->getRevistas()) == 0): ?>
    <p>No hay revistas registrados</p>
<?php else: ?>
    <ul>
        <?php foreach ($biblioteca->getRevistas() as $indice => $revista): ?>
            <li>
                <?php echo "Titulo: " . $revista->getTitulo() . ", Autor: " . $revista->getAutor() . ", Año: " . $revista->getAño() . ", Tematica: " . $revista->getTematica(); ?>  
                    <form method="POST" class="delete-form">
                    <input type="hidden" name="indice" value="<?php echo $indice; ?>">
                    <button type="submit">Eliminar</button>
                </form>    
            </li>
        <?php endforeach; ?>
    </ul>      
<?php endif; ?>

</html>
