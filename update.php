<?php
include 'config.php';
/**
 * Obtiene la id por metodo GET
 */
$id = $_GET['id'];
$result = $connection->query("SELECT * FROM students WHERE id = $id"); //Obtiene el estudiante con la id correspondiente
$row = $result->fetch_assoc(); // Transforma el resultado en un array
/**
 * Detecta con que método se consulto al servidor
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    $sql = "UPDATE students SET fullname='$name', email='$email', age=$age WHERE id=$id";

    //Ejecuta la sentencia. Si resulta exitosa redirige al inicio
    if ($connection->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error al actualizar: " . $connection->error; //Informa error
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar estudiante</title>
    <link rel='stylesheet' href='style.css'>
</head>

<body class="w3-margin">
    <div class="w3-container w3-center">
        <h2>Editar Estudiante</h2>
        <!--<form method="post">--> <!--NO SE HACE si no especifo action, usa la url actual con el id por GET-->

        <!-- En el action se agrega el id de la fila que estoy editando-->
        <form class="w3-container w3-center form-container" action="update.php?id=<?= $row['id'] ?>" method="post">
            <table class="w3-table w3-border w3-round w3-margin table-edit">
                <tbody>
                    <tr>
                        <td rowspan="4" class="svg-container w3-text-gray">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="bi bi-person-circle svg-icon" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg>
                        </td>
                        <!-- Completa los campos del form con los datos de la fila obtenidos de la bd -->
                        <td style="width: 315px;">Nombre completo:</td>
                        <td><input type="text" name="fullname" value="<?= $row['fullname'] ?>" required></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input type="email" name="email" value="<?= $row['email'] ?>" required></td>
                    </tr>
                    <tr>
                        <td>Edad:</td>
                        <td><input type="number" name="age" value="<?= $row['age'] ?>" required></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input class="w3-btn w3-green w3-round w3-block" type="submit" value="Actualizar">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</body>

</html>