<?php
include 'config.php';
/**
 * Obtiene el id por método GET
 */
$id = $_GET['id'];

/**
 * Elimina de la bd el estudiante con la id solicitada
 */
$sql = "DELETE FROM students WHERE id = $id";

/**
 * Ejecuta la sentencia. Si resulta exitosa redirige al inicio
 */
if ($connection->query($sql) === TRUE) {
    header("Location: index.php");
    exit;
} else {
    echo "Error al borrar: " . $connection->error; //Informa error
}
?>
