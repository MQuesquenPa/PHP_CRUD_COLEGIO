<?php
class Cursos
{     
    public static function insertarCurso($nombre, $periodo, $precio ){
        $db=Db::getConnect();
        $insert=$db->prepare('INSERT INTO Curso VALUES(NULL,:Nombre,:Periodo,:Precio, :Estado)');
        $insert->bindValue('Nombre',$nombre);
        $insert->bindValue('Periodo',$periodo);
        $insert->bindValue('Precio',$precio);
        $insert->bindValue('Estado', "ACTIVO");
        
        $insert->execute();
    }

    public static function BorrarCurso($id){
        $db=Db::getConnect();
        $sql=$db->prepare('DELETE FROM CURSO WHERE IdCurso = :id');
        $sql->bindValue('id' , $id);
        $sql->execute();   
        
    }

    public static function Consulta($id){
            
            $db=Db::getConnect();
            $sql=$db->prepare('SELECT * FROM  CURSO WHERE IdCurso = :id');
            $sql->bindValue('id' , $id);
            $sql->execute();   
            $resultado = $sql->fetchAll();
            return $resultado;
        
    }
        
    public static function EditarCurso($id, $nombre, $periodo, $precio){
        $db=Db::getConnect();
        $sql=$db->prepare('UPDATE  CURSO SET Nombre= :Nombre, Periodo=:Periodo, Precio=:Precio , Estado=:Estado WHERE IdCurso =:id');
        $sql->bindValue('Nombre',$nombre);
        $sql->bindValue('Periodo',$periodo);
        $sql->bindValue('Precio',$precio);
        $sql->bindValue('id',$id);
        $sql->bindValue('Estado','ACTIVO');
        $sql->execute();   
    }
    
    public static function selectCurso(){
        $db=Db::getConnect();
        $sql=$db->prepare('SELECT * FROM CURSO');
        $sql->execute();   
    
        $resultado = $sql->fetchAll();
        return $resultado;
    }
}
 
  
?>