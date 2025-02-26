<?php
require_once("./class/editorLibro.php");

// Biblioteca a partir de json

$biblioteca = new EditorLibros();

var_dump($biblioteca);
"<br>";

// Crear libros y añadirlos 
$biblioteca->agregarLibro("La caida de los gigantes", "Ken Follet", 2010, 1024);
$biblioteca->agregarLibro("El invierno del mundo", "Ken Follet", 2012, 944);
$biblioteca->agregarLibro("El umbral de la eternidad", "Ken Follet", 2014, 1040);

var_dump($biblioteca);


// // Eliminar 
// echo "Elminar libros y reondenar"; 

// $biblioteca->eliminarLibro(1);

// var_dump($biblioteca);
