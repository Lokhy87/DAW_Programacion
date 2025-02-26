<?php
require_once("publicacion.php");

class Libro extends Publicacion {
    protected $paginas;

    function __construct($titulo, $autor, $año, $paginas){
        parent::__construct($titulo, $autor, $año);
        $this->paginas = $paginas;
    }

    // Getter
    public function getPaginas(){
        return $this->paginas;
    }

    // Setter
    public function setPaginas($paginas){
        $this->paginas = $paginas; 
    }        

    // Convierte un objeto a un array
    public function toArray(): array {
        return [
            'titulo' => $this->titulo,
            'autor' => $this->autor,
            'año' => $this->año,
            'paginas' => $this->paginas
        ];
    }

    // Devuelve un objeto de un array
    public static function fromArray(array $data): Libro {
        return new Libro($data['titulo'], $data['autor'], $data['año'], $data['paginas']);
    }

}
