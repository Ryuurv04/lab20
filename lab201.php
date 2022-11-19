<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio 20</title>
</head>
<body>
    <form action="" method="post">
        Nombre: <input type="text" name="nombre" require><br>
        Apellido: <input type="text" name="apellido" require><br>
        Email. <input type="email" name="emaio"><br>
        Edad: <input type="number" name="edad"><br>
        <input type="submit" value="Guardar datos" name="guardar"> 
    </form>
    <?php
    include("usuariosmdb.php");
    $usrs=new usuariomdb();

    if(array_key_exists('guardar',$_POST)){
        $usrs->insertarRegistro($_REQUEST['nombre'],$_REQUEST['apellido'],$_REQUEST['email'],$_REQUEST['edad']);
        echo"Registro insertado exitosamente <br><br>";
    }
    echo"Registros en la coleccion usuarios: <br>";
    $usrs->obtenerRegistros();

    ?>
</body>
</html>