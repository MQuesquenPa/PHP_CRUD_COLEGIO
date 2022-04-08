<?php 
session_start();
require_once ('../bd/conexion.php');
require_once ('../Models/Cursos.php');

if (isset($_GET['action'])){
    if ($_GET['action']=="insertar"){
        if(empty($_POST['nombre']) || empty($_POST['periodo']) || empty($_POST['precio'] )){
            echo 1;
        }else{
        
        Cursos::insertarCurso($_POST['nombre'],$_POST['periodo'],$_POST['precio']);
            echo 2;
        
        }  
    }else if($_GET['action']=="listar"){
        $datos = Cursos::selectCurso();
        print_r(json_encode($datos));

    }else if($_GET['action']=="consulta"){
        
        $datos = Cursos::Consulta($_POST['id']);
        print_r(json_encode($datos));

    }else if($_GET['action']=="editar"){   
        if(empty($_POST['nombre']) || empty($_POST['periodo']) || empty($_POST['precio']) || empty($_POST['id'])){
                echo 1;
            }else{
            $datos = Cursos::EditarCurso($_POST['id'], $_POST['nombre'],$_POST['periodo'],$_POST['precio'] );
                echo 2;
            }
    }else if($_GET['action']=="eliminar"){
        if(empty($_POST['id'])){
            echo 1;
        }else{
            Cursos::BorrarCurso($_POST['id']);
            echo 2;
        }
    }
}
else{
    echo "ninguna accion seleccionada";
}

?>

