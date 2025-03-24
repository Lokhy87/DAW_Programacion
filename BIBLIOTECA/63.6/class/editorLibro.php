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

    public function getLibros() {
        return $this->libros;
    }
    public function getRevistas() {
        return $this->revistas;
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

    // Agregar publicacion
    public function agregarPublicacion($titulo, $autor, $año, $var) {
        if (gettype($var) == "integer") {
            $libro = new Libro($titulo, $autor, $año, $var);
            $this->libros[] = $libro;
            //$this->guardarLibros();
        } else {
            $revista = new Revista($titulo, $autor, $año, $var);
            $this->revistas[] = $revista;
        }
        $this->guardarPublicaciones();
    }


    // Guardar todas las publicaciones (libros y revistas) en el archivo JSON
    private function guardarPublicaciones() {
        $publicaciones = [];
    
        // Agregar libros al array de publicaciones
        foreach ($this->libros as $libro) {
            $publicaciones[] = $libro->toArray();
        }
    
        // Agregar revistas al array de publicaciones
        foreach ($this->revistas as $revista) {
            $publicaciones[] = $revista->toArray();
        }
    
        // Guardar en el archivo JSON
        file_put_contents($this->filePath, json_encode($publicaciones, JSON_PRETTY_PRINT));
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
            $this->guardarPublicaciones();
        }
  
    }

    public function eliminarRevista($indice){
        if (isset($this->revistas[$indice])){
            unset($this->revistas[$indice]);
            $this->revistas = array_values($this->revistas);
            $this->guardarPublicaciones();
        }
    }

    // Proceso de array de objetos a json
    // private function guardarLibros() {
    //     $jsonBiblio = [];
    //     foreach ($this->libros as $object) {
    //         $arrayLibro = $object->toArray();
    //         $jsonBiblio[] = $arrayLibro;
    //     }
    //     $jsonBiblio = json_encode($jsonBiblio, JSON_PRETTY_PRINT);
    //     file_put_contents($this->filePath, $jsonBiblio);
    // }

    // public function guardarRevistas() {
    //     $jsonBiblio = [];
    //     foreach ($this->revistas as $object) {
    //         $arrayRevista = $object->toArray();
    //         $jsonBiblio[] = $arrayRevista;
    //     }
    //     $jsonBiblio = json_encode($jsonBiblio, JSON_PRETTY_PRINT);
    //     file_put_contents($this->filePath, $jsonBiblio);

    // }

}

