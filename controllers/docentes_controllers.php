<?php 
session_start();
require_once ('../bd/conexion.php');
require_once ('../Models/Docentes.php');

if (isset($_GET['action'])){
    if ($_GET['action']=="insertar"){
        if(empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['dni']) || empty($_POST['correo'])|| empty($_POST['telefono'])|| empty($_POST['idCurso'])){
            echo 1;
        }else{
        
        Docentes::insertarDocente($_POST['nombre'],$_POST['apellido'],$_POST['dni'], $_POST['correo'], $_POST['telefono'], $_POST['idCurso'] );
            echo 2;
            
        } 
    }else if($_GET['action']=="listar"){
        $datos = Docentes::selectDocente();
        print_r(json_encode($datos));

    }else if($_GET['action']=="consulta"){
    
        $datos = Docentes::Consulta($_POST['id']);
        print_r(json_encode($datos));

    }else if($_GET['action']=="editar"){   
        if(empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['dni']) || empty($_POST['correo'])|| empty($_POST['telefono'])|| empty($_POST['idCurso'])){
                echo 1;
        }else{
            $datos = Docentes::EditarDocente($_POST['id'], $_POST['nombre'],$_POST['apellido'],$_POST['dni'], $_POST['correo'], $_POST['telefono'], $_POST['idCurso']  );
                echo 2;
        }
    }else if($_GET['action']=="eliminar"){
        if(empty($_POST['id'])){
            echo 1;
        }else{
            Docentes::BorrarDocente($_POST['id']);
            echo 2;
        }
    }else if($_GET['action']=="listar_cursos"){
        $datos = Docentes::ComboBoxCursos();
        echo $datos;
    }

}else{
    echo "ninguna accion seleccionada";
}

?>