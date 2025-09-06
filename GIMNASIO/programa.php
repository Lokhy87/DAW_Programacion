<?php
require_once("editorEntrenamiento.php");

// $ejercicio1 = new Entrenamiento("Pres de banca", "Pectoral", "Empuje", "Hipertrofia", "Aumentar volumen muscular");
// $ejercicio2 = new Entrenamiento("Dominada", "Espalda", "Traccion", "Fuerza", "Fuerza maxima");

// echo "EJERCICIO 1<br>";
// // Acceder a los atributos 
// echo "Nombre del ejercicio: " . $ejercicio1->getNombre() . "<br>";
// echo "Músculo trabajado: " . $ejercicio1->getMusculo() . "<br>";
// echo "Tipo de movimiento: " . $ejercicio1->getMovimiento() . "<br>";
// echo "Tipo de entrenamiento: " . $ejercicio1->getEntrenamiento() . "<br>";
// echo "Objetivo: " . $ejercicio1->getObjetivo() . "<br>";

// echo "<br>";

// echo "EJERCICIO 2<br>";
// // Acceder a los atributos 
// echo "Nombre del ejercicio: " . $ejercicio2->getNombre() . "<br>";
// echo "Músculo trabajado: " . $ejercicio2->getMusculo() . "<br>";
// echo "Tipo de movimiento: " . $ejercicio2->getMovimiento() . "<br>";
// echo "Tipo de entrenamiento: " . $ejercicio2->getEntrenamiento() . "<br>";
// echo "Objetivo: " . $ejercicio2->getObjetivo() . "<br>";


// Ejemplo creacion RUTINA 
$rutina = new EditorEntrenamiento();

echo "<pre>";
print_r($rutina);
echo "</pre>";

// Añadir
$rutina->añadirEntreno("Pres militar", "Hombro", "Empuje", "Hipertrofia", "Aumentar volumen muscular");
$rutina->añadirEntreno("Burpees", "Global", "Empuje y salto", "Metabolico", "Perdida de grasa");

echo "<pre>";
print_r($rutina);
echo "</pre>";

// Eliminar
echo "ELIMINAMOS UN LIBRO POR ÍNDICE";
$rutina->eliminarEntreno(1);

echo "<pre>";
print_r($rutina);
echo "</pre>";