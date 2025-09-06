<?php
require_once("./class/editorLibro.php");

$biblioteca = new EditorLibros();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $titulo = $_POST['Titulo'] ?? '';
                $autor = $_POST['Autor'] ?? '';
                $año = (int)($_POST['Año'] ?? 0);
                $var = $_POST['var'] ?? '';

                if (!empty($titulo) && !empty($autor) && !empty($var)) {
                    // Determinar si es un libro o una revista
                    if (is_numeric($var)) {
                        // Es un libro (var es un número)
                        $paginas = (int)$var;
                        $biblioteca->agregarPublicacion($titulo, $autor, $año, $paginas);
                        echo "<p>Libro '$titulo' agregado correctamente.</p>";
                    } else {
                        // Es una revista (var es un string)
                        $tematica = $var;
                        $biblioteca->agregarPublicacion($titulo, $autor, $año, $tematica);
                        echo "<p>Revista '$titulo' agregada correctamente.</p>";
                    }
                } else {
                    echo "<p>Por favor, completa todos los campos.</p>";
                }
                break;
            case 'delete':
                $indice = (int)($_POST['indice'] ?? -1);
                $var = ($_POST['var']);
                if ($indice >= 0) {
                    if (is_numeric($var)) {
                        $biblioteca->eliminarLibro($indice);
                        echo "<p>Libro eliminado correctamente</p>";
                    } else {
                        $biblioteca->eliminarRevista($indice);
                        echo "<p>Revista eliminada correctamente</p>";
                    }
                }
                break;    
        }
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
    <form method="post">
        <input type="hidden" name= "action" value="add"> 
        
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

<h2>Listado de Libros</h2>
<?php if (count($biblioteca->getLibros()) == 0): ?>
    <p>No hay libros registrados</p>
<?php else: ?>
    <ul>
        <?php foreach ($biblioteca->getLibros() as $indice => $libro): ?>
            <li>
                <?php echo "Titulo: " . $libro->getTitulo() . ", Autor: " . $libro->getAutor() . ", Año: " . $libro->getAño() . ", Paginas: " . $libro->getPaginas(); ?>  
                    <form method="POST" class="delete-form">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="indice" value="<?php echo $indice; ?>">
                    <input type="hidden" name="var" value="<?php echo $libro->getPaginas(); ?>">
                    <button type="submit">Eliminar</button>
                </form>      
            </li>
        <?php endforeach; ?>
    </ul>      
<?php endif; ?>

<h2>Listado de Revistas</h2>
<?php if (count($biblioteca->getRevistas()) == 0): ?>
    <p>No hay revistas registrados</p>
<?php else: ?>
    <ul>
        <?php foreach ($biblioteca->getRevistas() as $indice => $revista): ?>
            <li>
                <?php echo "Titulo: " . $revista->getTitulo() . ", Autor: " . $revista->getAutor() . ", Año: " . $revista->getAño() . ", Tematica: " . $revista->getTematica(); ?>  
                    <form method="POST" class="delete-form">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="indice" value="<?php echo $indice; ?>">
                    <input type="hidden" name="var" value="<?php echo $revista->getTematica(); ?>">
                    <button type="submit">Eliminar</button>
                </form>    
            </li>
        <?php endforeach; ?>
    </ul>      
<?php endif; ?>

</html>
