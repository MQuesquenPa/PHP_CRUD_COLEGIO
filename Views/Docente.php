<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap css v5   -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    
    <!-- JQuery cdn  v3.6   -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="../JS/Docente.js"></script>

    <title>MODULO DOCENTES</title>
</head>
<body>
    <?php  
    include "./Header.php";
    
    ?>
<div id="mensaje"></div></br>
    
    <div class="container">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header">
                    DOCENTES
                        </div>
                            <div class="card-body">
                
                            <form action="" method="post" >
                                <div class="mb-3">
                                  <label for="txtID"  class="form-label">ID</label>
                                  <input type="text" readOnly 
                                    class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="id">
                                </div>
                                
                                <div class="mb-3">
                                  <label for="TxtNombre" class="form-label">nombre</label>
                                  <input type="text"
                                    class="form-control" name="TxtNombre" id="TxtNombre" aria-describedby="helpId" placeholder="nombre del estudiante">
                                </div>

                                <div class="mb-3">
                                  <label for="TxtApellido" class="form-label">Apellido</label>
                                  <input type="text"
                                    class="form-control" name="TxtApellido" id="TxtApellido" aria-describedby="helpId" placeholder="Apellido">
                                  
                                </div>
                                <div class="mb-3">
                                  <label for="TxtDNI" class="form-label">DNI</label>
                                  <input type="number"
                                    class="form-control" name="TxtDNI" id="TxtDNI" aria-describedby="helpId" placeholder="DNI">
                                </div>

                                <div class="mb-3">
                                  <label for="TxtCorreo" class="form-label">Correo</label>
                                  <input type="email"
                                    class="form-control" name="TxtCorreo" id="TxtCorreo" aria-describedby="helpId" placeholder="Correo">
                                  
                                </div>
                                <div class="mb-3">
                                  <label for="TxtTelefono" class="form-label">Telefono</label>
                                  <input type="number"
                                    class="form-control" name="TxtTelefono" id="TxtTelefono" aria-describedby="helpId" placeholder="telefono">
                                  
                                </div>
                                <div class="mb-3" id="contentComboCurso">
                                  <label for="cboCurso" class="form-label">Curso</label>
                                    
                                </div>
                                <div class="btn-group" role="group" aria-label="">
                                    <button onclick="insertarDocente()" id="btnAgregar"  type="button" class="btn btn-success">Agregar</button>
                                    <button onclick="EditarDocente()" id="btnEditar"  type="button" class="btn btn-warning disabled">Actualizar</button>
                                    <button onclick= "Limpiar()" id="btnCancelar" type="button"  class="btn btn-primary disabled">Cancelar</button>
                                </div>
                            </form>            

                            </div>
                        <div class="card-footer text-muted">
                         
                    </div>  
                </div>
                
                
            </div>
            <div class= "col-7">
                <table class="table table-bordered" id="tabla-docentes">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>DNI</th>
                            <th>Correo</th>
                            <th>Telefono</th>
                            <th>Curso</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="registrosDocentes">
                        
                        
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
    <?php  
    include "./Footer.php";
    
    ?>

     
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

</body>
</html>