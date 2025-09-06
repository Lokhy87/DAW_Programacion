<?php
require_once("publicacion.php");

class Revista extends Publicacion {
    protected $tematica;

    function __construct($titulo, $autor, $año, $tematica){
        parent::__construct($titulo, $autor, $año);
        $this->tematica = $tematica;
    }

    // Getter
    public function getTematica(){
        return $this->tematica;
    }

    // Setter
    public function setTematica($tematica){
        $this->tematica = $tematica; 
    }

    // Convierte un objeto a un array
    public function toArray(): array {
        return [
            'titulo' => $this->titulo,
            'autor' => $this->autor,
            'año' => $this->año,
            'tematica' => $this->tematica
        ];
    }

    public static function fromArray(array $data): Revista {
        return new Revista($data['titulo'], $data['autor'], $data['año'], $data['tematica']);
    }

    public function print() {
        parent::print();
        echo "Tipo: $this->tematica<br>";
    }
        
}
