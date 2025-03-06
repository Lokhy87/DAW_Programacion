<?php
require_once("revista.php");
require_once("libro.php");

// Clase 
class EditorLibros {
    private $libros = [];
    private $revistas = [];
    private $filePath = 'datos.json';

    public function __construct() {
        $this->cargarPublicacion();
    }
    
    // Comprobar que este datos.json y hace proceso desde json hasta array de objetos
    private function cargarPublicacion() {
        $data = [];
        if (file_exists($this->filePath)) {
            $data = json_decode(file_get_contents($this->filePath), true);
        }
        if ($data != null && is_array($data)) {
            foreach ($data as $array) {
                if (array_key_exists('paginas', $array)) {
                    $this->libros [] = Libro::fromArray($array);
                }
                if(array_key_exists('tematica', $array)) {
                    $this->revistas [] = Revista::fromArray($array); 
                }
            }
        }
    }

    // Agregar libros
    public function agregarPublicacion($titulo, $autor, $año, $var) {
        if (gettype($var) == "integer") {
            $libro = new Libro($titulo, $autor, $año, $var);
            $this->libros[] = $libro;
            $this->guardarLibros();
        } else {
            $revista = new Revista($titulo, $autor, $año, $var);
            $this->revistas[] = $revista;
            $this->guardarRevistas();
        }

    }

    public function imprimirPublicaciones() {
        foreach($this->libros as $object) {
            $object->print();
        }
        foreach ($this->revistas as $object) {
            $object->print();
        }
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

    public function eliminarRevista($indice){
        if (isset($this->libros[$indice])){
            unset($this->libros[$indice]);
            $this->libros = array_values($this->libros);
            $this->guardarRevistas();
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

    public function guardarRevistas() {
        $jsonBiblio = [];
        foreach ($this->revistas as $object) {
            $arrayRevista = $object->toArray();
            $jsonBiblio[] = $arrayRevista;
        }
        $jsonBiblio = json_encode($jsonBiblio, JSON_PRETTY_PRINT);
        file_put_contents($this->filePath, $jsonBiblio);

    }

}

