<?php
require_once("entrenamiento.php");

class EditorEntrenamiento{
    private $ejercicios = [];
    private $filePath = 'totalEjercicios.json';

    public function __construct() {
        $this->cargarEntreno();
    }

    private function cargarEntreno() {
        $data = [];
        if (file_exists($this->filePath)) {
            $data = json_decode(file_get_contents($this->filePath), true);
        }
        if ($data != null && is_array($data)) {
            foreach ($data as $array) {
                $this->ejercicios [] = Entrenamiento::fromArray($array);
            }
        }
    }

    public function añadirEntreno($nombre, $musculo, $movimiento, $entrenamiento, $objetivo) {
        $ejercicio = new Entrenamiento($nombre, $musculo, $movimiento, $entrenamiento, $objetivo);
        $this->ejercicios[] = $ejercicio;
        $this->guardarEntreno();
    }


    public function eliminarEntreno($index) {
        if (isset($this->ejercicios[$index])) {
            unset($this->ejercicios[$index]);
            $this->ejercicios = array_values($this->ejercicios);
            $this->guardarEntreno();
        }
    }


    private function guardarEntreno(){
        $jsonRutina = [];
        foreach ($this->ejercicios as $object){
            $arrayEntreno = $object->toArray();
            $jsonRutina[] = $arrayEntreno;
        }
        $jsonRutina = json_encode($jsonRutina, JSON_PRETTY_PRINT);
        file_put_contents($this->filePath, $jsonRutina); 
    }


}