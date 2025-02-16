<?php
require_once("revista.php");

// Clase 
class Biblioteca{
    private array $libros = [];
    private array $revistas = [];

    // Agregar libros
    public function agregarLibro($titulo, $autor, $año, $paginas) {
        $libro = new Libro($titulo, $autor, $año, $paginas);
        $this->libros[] = $libro;
        echo "Libro $titulo agregado correctamente<br>";
    }

    // Leer libros
    public function leerLibro(){
        if (empty($this->libros)){
            echo "No se puede leer<br>";
            return;
        }
        echo "Listado de libros: <br>";
        foreach($this->libros as $indice => $libro) {
            echo ($indice + 1) . "- Libro: " . $libro->getTitulo() . " de " . $libro->getAutor() . " (" . $libro->getAño() . "), " . $libro->getPaginas() . " páginas.<br>";;
        }
    }

    // Modificar libros
    public function modificarLibro($indice, $nuevoTitulo, $nuevoAutor, $nuevoAño, $nuevasPaginas){
        if (!isset($this->libros[$indice])){
            echo "Este libro no existe<br>";
            return;
        }

        $libro = $this->libros[$indice];
        $libro->setTitulo($nuevoTitulo);
        $libro->setAutor($nuevoAutor);
        $libro->setAño($nuevoAño);
        $libro->setPaginas($nuevasPaginas);
        echo "Libro modificado correctamente<br>";
    }

    // Eliminar libros
    public function eliminarLibro($indice){
        if (!isset($this->libros[$indice])){
            echo "Este libro no existe<br>";
            return;
        }
        $libroEliminado = $this->libros[$indice]->getTitulo();
        unset($this->libros[$indice]);
        $this->libros = array_values($this->libros);
        echo "Libro '$libroEliminado' ha sido eliminado correctamente.<br>";
    }

    // Agregar revistas 
    public function agregarRevista($titulo, $autor, $año, $paginas, $tematica) {
        $revista = new Revista($titulo, $autor, $año, $paginas, $tematica);
        $this->revistas[] = $revista;
        echo "Revista $titulo agregado correctamente<br>";
    }
    
    // Leer Revistas
    public function leerRevista(){
        if (empty($this->revistas)){
            echo "No se puede leer<br>";
        }
        echo "Listado de Revistas: <br>";
        foreach($this->revistas as $indice => $revista) {
            echo ($indice + 1) . "- Revista: " . $revista->getTitulo() . " de " . $revista->getAutor() . " (" . $revista->getAño() . "), " . $revista->getPaginas() . " páginas, temática: " . $revista->getTematica() . ".<br>";
        }
    }

    // Modificar revistas
    public function modificarRevista($indice, $nuevoTitulo, $nuevoAutor, $nuevoAño, $nuevasPaginas, $nuevaTematica){
        if (!isset($this->revistas[$indice])){
            echo "Esta revista no existe<br>";
            return;
        }

        $revista = $this->revistas[$indice];
        $revista->setTitulo($nuevoTitulo);
        $revista->setAutor($nuevoAutor);
        $revista->setAño($nuevoAño);
        $revista->setPaginas($nuevasPaginas);
        $revista->setTematica($nuevaTematica);
        echo "Revista modificada correctamente<br>";
    }

    // Eliminar libros
    public function eliminarRevista($indice){
        if (!isset($this->revistas[$indice])){
            echo "Esta revista no existe<br>";
            return;
        }
        $revistaEliminada = $this->revistas[$indice]->getTitulo();
        unset($this->revistas[$indice]);
        $this->revistas = array_values($this->revistas);
        echo "Revista '$revistaEliminada' ha sido eliminado correctamente.<br>";
    }




}