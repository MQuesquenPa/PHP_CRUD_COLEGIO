<?php 
session_start();
require_once ('../bd/conexion.php');
require_once ('../Models/Inscripciones.php');

if (isset($_GET['action'])){
    if ($_GET['action']=="insertar"){
        if(empty($_POST['IdAlumno']) ||  empty($_POST['IdCurso']) ||  empty($_POST['IdDocente']) ){
            echo 1;
        }else{
        
        Inscripciones::insertarInscripcion($_POST['IdAlumno'],$_POST['IdCurso'],$_POST['IdDocente'] );
            echo 2;
            
        } 
    }else if($_GET['action']=="listar"){
        $datos = Inscripciones::selectInscripcion();
        print_r(json_encode($datos));

    }else if($_GET['action']=="consulta"){
    
        $datos = Inscripciones::Consulta($_POST['id']);
        print_r(json_encode($datos));

    }else if($_GET['action']=="editar"){   
        if(empty($_POST['IdAlumno']) ||  empty($_POST['IdCurso']) ||  empty($_POST['IdDocente']) ){
                echo 1;
        }else{
            $datos = Inscripciones::EditarInscripcion($_POST['id'], $_POST['IdAlumno'],$_POST['IdCurso'],$_POST['IdDocente'] );
                echo 2;
        }
    }else if($_GET['action']=="eliminar"){
        if(empty($_POST['id'])){
            echo 1;
        }else{
            Inscripciones::BorrarInscripcion($_POST['id']);
            echo 2;
        }
    }else if($_GET['action']=="listar_alumnos"){
        $datos = Inscripciones::ComboBoxAlumnos();
        echo $datos;
    }else if($_GET['action']=="listar_cursos"){
        $datos = Inscripciones::ComboBoxCursos();
        echo $datos;
    }else if($_GET['action']=="listar_docentes"){
        $datos = Inscripciones::ComboBoxDocente();
        echo $datos;
    }


}else{
    echo "ninguna accion seleccionada";
}

?>