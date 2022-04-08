<?php
class Alumnos
{     
    public static function insertarAlumno($nombre, $apellido, $dni, $correo, $telefono){
        $db=Db::getConnect();
        $insert=$db->prepare('INSERT INTO Alumno VALUES(NULL,:Nombre,:Apellido,:dni, :correo, :telefono)');
        $insert->bindValue('Nombre',$nombre);
        $insert->bindValue('Apellido',$apellido);
        $insert->bindValue('dni',$dni);
        $insert->bindValue('correo',$correo);
        $insert->bindValue('telefono',$telefono);
        
        $insert->execute();
    }

    public static function BorrarAlumno($id){
        $db=Db::getConnect();
        $sql=$db->prepare('DELETE FROM Alumno WHERE idAlumno  = :id');
        $sql->bindValue('id' , $id);
        $sql->execute();   
        
    }

    public static function Consulta($id){
            
            $db=Db::getConnect();
            $sql=$db->prepare('SELECT * FROM  Alumno WHERE idAlumno = :id');
            $sql->bindValue('id' , $id);
            $sql->execute();   
            $resultado = $sql->fetchAll();
            return $resultado;
        
    }
        
    public static function EditarAlumno($id, $nombre, $apellido, $dni, $correo, $telefono){
        $db=Db::getConnect();
        $sql=$db->prepare('UPDATE  Alumno SET nombre= :nombre, apellido=:apellido, dni=:dni , correo=:correo , telefono=:telefono WHERE idAlumno =:id');
        $sql->bindValue('nombre',$nombre);
        $sql->bindValue('apellido',$apellido);
        $sql->bindValue('dni',$dni);
        $sql->bindValue('correo',$correo);
        $sql->bindValue('telefono',$telefono);
        $sql->bindValue('id',$id);

        $sql->execute();   
    }
    
    public static function selectAlumno(){
        $db=Db::getConnect();
        $sql=$db->prepare('SELECT * FROM Alumno');
        $sql->execute();   
    
        $resultado = $sql->fetchAll();
        return $resultado;
    }
}
 
  
?>