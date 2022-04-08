<?php
class Inscripciones
{     
    public static function insertarInscripcion($IdAlumno, $IdCurso, $IdDocente){
        $db=Db::getConnect();
        $insert=$db->prepare('INSERT INTO Inscripcion VALUES(NULL,:IdAlumno,:IdCurso,:IdDocente)');
        $insert->bindValue('IdAlumno',$IdAlumno);
        $insert->bindValue('IdCurso',$IdCurso);
        $insert->bindValue('IdDocente',$IdDocente);
        $insert->execute();
    }

    public static function BorrarInscripcion($id){
        $db=Db::getConnect();
        $sql=$db->prepare('DELETE FROM Inscripcion WHERE IdInscripcion  = :id');
        $sql->bindValue('id' , $id);
        $sql->execute();   
        
    }

    public static function Consulta($id){
            
            $db=Db::getConnect();
            $sql=$db->prepare('SELECT * FROM  Inscripcion WHERE IdInscripcion = :id');
            $sql->bindValue('id' , $id);
            $sql->execute();   
            $resultado = $sql->fetchAll();
            return $resultado;
        
    }
        
    public static function EditarInscripcion($id, $IdAlumno, $IdCurso, $IdDocente){
        $db=Db::getConnect();
        $sql=$db->prepare('UPDATE  Inscripcion SET IdAlumno= :IdAlumno, IdCurso=:IdCurso, IdDocente=:IdDocente  WHERE IdInscripcion =:id');
        $sql->bindValue('IdAlumno',$IdAlumno);
        $sql->bindValue('IdCurso',$IdCurso);
        $sql->bindValue('IdDocente',$IdDocente);
        
        $sql->bindValue('id',$id);

        $sql->execute();   
    }
    
    public static function selectInscripcion(){
        $db=Db::getConnect();
        
         $sql=$db->prepare('SELECT i.IdInscripcion, a.Nombre, a.Apellido, a.Correo, c.Nombre as NombreCurso, c.Precio, d.Nombre as NombreDocente, d.Apellido as ApellidoDocente FROM alumno a INNER JOIN inscripcion i on a.idAlumno = i.IdAlumno INNER JOIN docente d on i.IdDocente = d.idDocente INNER JOIN curso c on i.idCurso = c.IdCurso');


        $sql->execute();   
    
        $resultado = $sql->fetchAll();
        return $resultado;
    }

    public static function ComboBoxAlumnos(){
        $db=Db::getConnect();
        $sql=$db->query('SELECT idAlumno, Nombre FROM Alumno');
        $sql->execute();        
        $cadena="<select id='txtAlumno' name='txtAlumno' class='form-control' '>".'<option value="0">Seleccionar el Alumno</option>';
        while($row = $sql->fetch(PDO::FETCH_ASSOC)){	 
        $cadena=$cadena.'<option value='.$row['idAlumno'].'>'.($row['Nombre']).'</option>';
        }
        return $cadena=$cadena."</select>";           
	}

    public static function ComboBoxCursos(){
        $db=Db::getConnect();
        $sql=$db->query('SELECT IdCurso,Nombre FROM curso');
        $sql->execute();        
        $cadena="<select id='txtCurso' name='txtCurso' class='form-control' '>".'<option value="0">Seleccionar el Curso</option>';
        while($row = $sql->fetch(PDO::FETCH_ASSOC)){	 
        $cadena=$cadena.'<option value='.$row['IdCurso'].'>'.($row['Nombre']).'</option>';
        }
        return $cadena=$cadena."</select>";           
	}
    public static function ComboBoxDocente(){
        $db=Db::getConnect();
        $sql=$db->query('SELECT idDocente, Nombre FROM docente');
        $sql->execute();        
        $cadena="<select id='txtDocente' name='txtDocente' class='form-control' '>".'<option value="0">Seleccionar el Docente</option>';
        while($row = $sql->fetch(PDO::FETCH_ASSOC)){	 
        $cadena=$cadena.'<option value='.$row['idDocente'].'>'.($row['Nombre']).'</option>';
        }
        return $cadena=$cadena."</select>";           
	}
}
 
  
?>