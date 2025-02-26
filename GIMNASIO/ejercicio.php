<?php
class Ejercicio {
    private $nombre;
    private $musculo;
    private $movimiento;

    // Constructor
    public function __construct($nombre, $musculo, $movimiento) {
        $this->nombre = $nombre;
        $this->musculo = $musculo;
        $this->movimiento = $movimiento;

    }

    // Getters
    public function getNombre () {
        return $this->nombre;
    }

    public function getMusculo () {
        return $this->musculo;
    }

    public function getMovimiento () {
        return $this->movimiento;
    }

    // Setters
    public function setNombre ($nombre) {
        $this->nombre = $nombre;
    }

    public function setMusculo ($musculo) {
        $this->musculo = $musculo;
    }

    public function setMovimiento ($movimiento) {
        $this->movimiento = $movimiento;
    }

    public function toArray() {
        return [
            'nombre' => $this->nombre,
            'grupo_muscular' => $this->musculo,
            'tipo_movimiento' => $this->movimiento
        ];
    }



}