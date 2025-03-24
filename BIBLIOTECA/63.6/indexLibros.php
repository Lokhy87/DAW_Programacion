<?php
require_once("./class/editorLibro.php");

$biblioteca = new EditorLibros();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $indice = (int)($_POST['indice']);
    $biblioteca->eliminarLibro($indice);
    echo "<p>Libro eliminado correctamente.</p>";
}

$libros = $biblioteca->getLibros();
$totalLibros = count($libros);
$librosPorPagina = 2;
$totalpaginas = ceil($totalLibros / $librosPorPagina);

// Que pagina mostrar 
$pagina= isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

// Calcular indice inicial y final 
$primerIndice = ($pagina - 1) * $librosPorPagina;
$librosMostrar = array_slice($libros, $primerIndice, $librosPorPagina);

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
        <?php foreach ($librosMostrar as $indice => $libro): ?>
            <li>
                <?php echo "Titulo: " . $libro->getTitulo() . ", Autor: " . $libro->getAutor() . ", Año: " . $libro->getAño() . ", Paginas: " . $libro->getPaginas(); ?>  
                    <form method="POST" class="delete-form">
                    <input type="hidden" name="indice" value="<?php echo $primerIndice + $indice; ?>">
                    <button type="submit">Eliminar</button>
                </form>      
            </li>
        <?php endforeach; ?>
    </ul>
    <!-- // Paginacion -->
    <div>
        <?php if ($pagina > 1): ?>
            <a href="?pagina=1"><<</a>
            <a href="?pagina=<?php echo $pagina - 1; ?>"><</a>
        <?php endif; ?>
        <span>Pagina <?php echo $pagina; ?> de <?php echo $totalpaginas; ?></span>
        <?php if ($pagina < $totalpaginas): ?>
            <a href="?pagina=<?php echo $pagina + 1; ?>">></a>
            <a href="?pagina=<?php echo $totalpaginas; ?>">>></a>
        <?php endif; ?>
    </div>      
<?php endif; ?>

</html>
