<?php 
session_start();
require_once ('../bd/conexion.php');
require_once ('../Models/Alumnos.php');

if (isset($_GET['action'])){
    if ($_GET['action']=="insertar"){
        if(empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['dni']) || empty($_POST['correo'])|| empty($_POST['telefono'])){
            echo 1;
        }else{
        
        Alumnos::insertarAlumno($_POST['nombre'],$_POST['apellido'],$_POST['dni'], $_POST['correo'], $_POST['telefono'] );
            echo 2;
            
        } 
    }else if($_GET['action']=="listar"){
        $datos = Alumnos::selectAlumno();
        print_r(json_encode($datos));

    }else if($_GET['action']=="consulta"){
    
        $datos = Alumnos::Consulta($_POST['id']);
        print_r(json_encode($datos));

    }else if($_GET['action']=="editar"){   
        if(empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['dni']) || empty($_POST['correo'])|| empty($_POST['telefono'])){
                echo 1;
        }else{
            $datos = Alumnos::EditarAlumno($_POST['id'], $_POST['nombre'],$_POST['apellido'],$_POST['dni'], $_POST['correo'], $_POST['telefono'] );
                echo 2;
        }
    }else if($_GET['action']=="eliminar"){
        if(empty($_POST['id'])){
            echo 1;
        }else{
            Alumnos::BorrarAlumno($_POST['id']);
            echo 2;
        }
    }

}else{
    echo "ninguna accion seleccionada";
}

?>