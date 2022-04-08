<?php
class Docentes
{     
    public static function insertarDocente($nombre, $apellido, $dni, $correo, $telefono, $idCurso){
        $db=Db::getConnect();
        $insert=$db->prepare('INSERT INTO Docente VALUES(NULL,:Nombre,:Apellido,:dni, :correo, :telefono, :idCurso)');
        $insert->bindValue('Nombre',$nombre);
        $insert->bindValue('Apellido',$apellido);
        $insert->bindValue('dni',$dni);
        $insert->bindValue('correo',$correo);
        $insert->bindValue('telefono',$telefono);
        $insert->bindValue('idCurso',$idCurso);

        $insert->execute();
    }

    public static function BorrarDocente($id){
        $db=Db::getConnect();
        $sql=$db->prepare('DELETE FROM Docente WHERE idDocente  = :id');
        $sql->bindValue('id' , $id);
        $sql->execute();   
        
    }

    public static function Consulta($id){
            
            $db=Db::getConnect();
            $sql=$db->prepare('SELECT * FROM  Docente WHERE idDocente = :id');
            $sql->bindValue('id' , $id);
            $sql->execute();   
            $resultado = $sql->fetchAll();
            return $resultado;
        
    }
        
    public static function EditarDocente($id, $nombre, $apellido, $dni, $correo, $telefono, $idCurso){
        $db=Db::getConnect();
        $sql=$db->prepare('UPDATE  Docente SET nombre= :nombre, apellido=:apellido, dni=:dni , correo=:correo , telefono=:telefono, idCurso=:idCurso WHERE idDocente =:id');
        $sql->bindValue('nombre',$nombre);
        $sql->bindValue('apellido',$apellido);
        $sql->bindValue('dni',$dni);
        $sql->bindValue('correo',$correo);
        $sql->bindValue('telefono',$telefono);
        $sql->bindValue('idCurso',$idCurso);

        $sql->bindValue('id',$id);

        $sql->execute();   
    }
    
    public static function selectDocente(){
        $db=Db::getConnect();
        $sql=$db->prepare('SELECT d.idDocente, d.Nombre, d.Apellido, d.DNI, d.Correo, d.Telefono, c.Nombre as NombreCurso FROM docente d INNER JOIN curso c on d.idCurso = c.IdCurso');

        $sql->execute();   
    
        $resultado = $sql->fetchAll();
        return $resultado;
    }

    public static function ComboBoxCursos(){
        $db=Db::getConnect();
        $sql=$db->query('SELECT IdCurso,Nombre FROM curso');
        $sql->execute();        
        //Select1
        $cadena="<select id='txtCurso' name='txtCurso' class='form-control' '>".'<option value="0">Seleccionar el Curso</option>';
        while($row = $sql->fetch(PDO::FETCH_ASSOC)){	 
        $cadena=$cadena.'<option value='.$row['IdCurso'].'>'.($row['Nombre']).'</option>';
        }
        return $cadena=$cadena."</select>";           
	}
}
 
  
?>