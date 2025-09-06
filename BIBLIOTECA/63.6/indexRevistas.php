<?php
require_once("./class/editorLibro.php");

$biblioteca = new EditorLibros();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $indice = (int)($_POST['indice']);
    $biblioteca->eliminarRevista($indice);
    echo "<p>Revista eliminada correctamente.</p>";
}

$revistas = $biblioteca->getRevistas();
$totalRevistas = count($revistas);
$revistasPorPagina = 2;
$totalpaginas = ceil($totalRevistas / $revistasPorPagina);

// Que pagina mostrar 
$pagina= isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

$primerIndice = ($pagina - 1) * $revistasPorPagina;
$revistasMostrar = array_slice($revistas, $primerIndice, $revistasPorPagina);

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
        <?php foreach ($revistasMostrar as $indice => $revista): ?>
            <li>
                <?php echo "Titulo: " . $revista->getTitulo() . ", Autor: " . $revista->getAutor() . ", Año: " . $revista->getAño() . ", Tematica: " . $revista->getTematica(); ?>  
                    <form method="POST" class="delete-form">
                    <input type="hidden" name="indice" value="<?php echo $indice; ?>">
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
