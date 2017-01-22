<?php
session_start();

$data = $_POST['data'];
$datedujour = new \DateTime();
$nom = $_SESSION['nom'];
$nom = (substr($nom, 0, 10));
$caracteres = array(
	'À' => 'a', 'Á' => 'a', 'Â' => 'a', 'Ä' => 'a', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ä' => 'a', '@' => 'a',
	'È' => 'e', 'É' => 'e', 'Ê' => 'e', 'Ë' => 'e', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', '€' => 'e',
	'Ì' => 'i', 'Í' => 'i', 'Î' => 'i', 'Ï' => 'i', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
	'Ò' => 'o', 'Ó' => 'o', 'Ô' => 'o', 'Ö' => 'o', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'ö' => 'o',
	'Ù' => 'u', 'Ú' => 'u', 'Û' => 'u', 'Ü' => 'u', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'µ' => 'u',
	'Œ' => 'oe', 'œ' => 'oe',
	'$' => 's');
$nom = strtr($nom, $caracteres);
$nom = trim(preg_replace('#[^A-Za-z0-9]+#', '-',$nom));
$file = "../images/download/".$nom.'_'.$datedujour->format('Ymj-His').'.png';

// remove "data:image/png;base64,"
$uri = substr($data,strpos($data,",")+1);


// save to file
file_put_contents($file, base64_decode($uri));

// return the filename
echo json_encode($file);
