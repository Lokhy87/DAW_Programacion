<?php
require_once("revista.php");

// Clase 
class EditorLibros {
    private $libros = [];
    private $filePath = 'datos.json';

    public function __construct() {
        $this->cargarLibros();
    }
    
    // Comprobar que este datos.json y hace proceso desde json hasta array de objetos
    private function cargarLibros() {
        $data = [];
        if (file_exists($this->filePath)) {
            $data = json_decode(file_get_contents($this->filePath), true);
        }
        if ($data != null && is_array($data)) {
            foreach ($data as $array) {
                $this->libros[] = Libro::fromArray($array); 
            }
        }
    }

    // Agregar libros
    public function agregarLibro($titulo, $autor, $año, $paginas) {
        $libro = new Libro($titulo, $autor, $año, $paginas);
        $this->libros[] = $libro;
        $this->guardarLibros();
    }


    // Leer libros
    public function leerLibros(): array {
        return $this->libros;
    }

    public function eliminarLibro($indice){
        if (isset($this->libros[$indice])){
            unset($this->libros[$indice]);
            $this->libros = array_values($this->libros);
            $this->guardarLibros();
        }
  
    }

    // Proceso de array de objetos a json
    private function guardarLibros() {
        $jsonBiblio = [];
        foreach ($this->libros as $object) {
            $arrayLibro = $object->toArray();
            $jsonBiblio[] = $arrayLibro;
        }
        $jsonBiblio = json_encode($jsonBiblio, JSON_PRETTY_PRINT);
        file_put_contents($this->filePath, $jsonBiblio);
    }

}



    // // Agregar revistas 
    // public function agregarRevista($titulo, $autor, $año, $paginas, $tematica) {
    //     $revista = new Revista($titulo, $autor, $año, $paginas, $tematica);
    //     $this->revistas[] = $revista;
    //     echo "Revista $titulo agregado correctamente<br>";
    // }
    
    // // Leer Revistas
    // public function leerRevista(){
    //     if (empty($this->revistas)){
    //         echo "No se puede leer<br>";
    //     }
    //     echo "Listado de Revistas: <br>";
    //     foreach($this->revistas as $indice => $revista) {
    //         echo ($indice + 1) . "- Revista: " . $revista->getTitulo() . " de " . $revista->getAutor() . " (" . $revista->getAño() . "), " . $revista->getPaginas() . " páginas, temática: " . $revista->getTematica() . ".<br>";
    //     }
    // }

    // // Modificar revistas
    // public function modificarRevista($indice, $nuevoTitulo, $nuevoAutor, $nuevoAño, $nuevasPaginas, $nuevaTematica){
    //     if (!isset($this->revistas[$indice])){
    //         echo "Esta revista no existe<br>";
    //         return;
    //     }

    //     $revista = $this->revistas[$indice];
    //     $revista->setTitulo($nuevoTitulo);
    //     $revista->setAutor($nuevoAutor);
    //     $revista->setAño($nuevoAño);
    //     $revista->setPaginas($nuevasPaginas);
    //     $revista->setTematica($nuevaTematica);
    //     echo "Revista modificada correctamente<br>";
    // }

    // // Eliminar libros
    // public function eliminarRevista($indice){
    //     if (!isset($this->revistas[$indice])){
    //         echo "Esta revista no existe<br>";
    //         return;
    //     }
    //     $revistaEliminada = $this->revistas[$indice]->getTitulo();
    //     unset($this->revistas[$indice]);
    //     $this->revistas = array_values($this->revistas);
    //     echo "Revista '$revistaEliminada' ha sido eliminado correctamente.<br>";
    // }