<?php
require_once("ejercicio.php");
class Entrenamiento extends Ejercicio {
    private $entrenamiento;
    private $objetivo;

    public function __construct($nombre, $musculo, $movimiento, $entrenamiento, $objetivo) {
        parent::__construct($nombre, $musculo, $movimiento);
        $this->entrenamiento = $entrenamiento;
        $this->objetivo = $objetivo;
    }

    // Getters
    public function getEntrenamiento(){
        return $this->entrenamiento;
    } 

    public function getObjetivo(){
        return $this->objetivo;
    } 

    // Setters
    public function setEntrenamiento ($entrenamiento){
        $this->entrenamiento = $entrenamiento;
    }

    public function setObjetivo ($objetivo) {
        $this->objetivo = $objetivo;
    }

    public function toArray() {
        return array_merge(parent::toArray(), [
            'entrenamiento' => $this->entrenamiento,
            'objetivo' => $this->objetivo
        ]);
    }

    public static function fromArray($data) {
        return new Entrenamiento($data['nombre'], $data['grupo_muscular'], $data['tipo_movimiento'], $data['entrenamiento'], $data['objetivo']);
    }




}
