<?php

include_once 'conexion.php';
$objecto = new Conexion();
$conexion = $objecto->Conectar();

//para recibir parametros con axios
$_POST = json_decode(file_get_contents("php://input"), true);

// recepcion de los datos enviados mediante POST desde main.js 
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$marca = (isset($_POST['marca'])) ? $_POST['marca'] : '';
$modelo = (isset($_POST['modelo'])) ? $_POST['modelo'] : '';
$stock = (isset($_POST['stock'])) ? $_POST['stock'] : '';

    switch($opcion){
        case 1:
            $consulta = "INSERT INTO moviles (marca, modelo, stock) VALUES('$marca', '$modelo', '$stock')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
        break;
        case 2:
            $consulta = "UPDATE moviles SET marca='$marca', modelo='$modelo', stock='$stock' WHERE id='$id' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        case 3:
            $consulta = "DELETE FROM moviles WHERE id='$id' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
        break;
        case 4:
            $consulta = "SELECT id, marca, modelo, stock FROM moviles";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
            
    }

    //Se envia el array final en en formato json a js 
    print json_encode($data, JSON_UNESCAPED_UNICODE);
    $conexion = NULL;