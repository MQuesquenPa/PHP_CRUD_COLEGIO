function insertarInscripcion(){
    
    var vIdAlumno=$('#txtAlumno').val();
    var vIdCurso=$('#txtCurso').val();
    var vIdDocente=$('#txtDocente').val();


        $.ajax({
            method: "POST",
            url: "http://localhost/PruebaTrabajo/controllers/inscripciones_controllers.php?action=insertar",
            data: { IdAlumno : vIdAlumno, IdCurso : vIdCurso, IdDocente : vIdDocente},
            success: function(data){
               if(data==1){
                alert("DEBES COMPLETAR EL FORMULARIO")
                
               }else if(data==2){
                location.reload();
               }
            },error: function(){
                alert("hubo un error");
            },
        })
}

function selectInscripcion(){
    $("#registrosInscripciones").empty();
    var inscripciones=[];
    $.ajax({
        method: "GET",
        url: "http://localhost/PruebaTrabajo/controllers/inscripciones_controllers.php?action=listar",
        data: null,
        success: function(data){

            let registros= JSON.parse(data);

            
            for(var i=0; i<registros.length; i++){
                var template = "<tr>";
                
                template += "<td>"+registros[i].IdInscripcion+"</td>";
                template += "<td>"+registros[i].Nombre+"</td>";
                template += "<td>"+registros[i].Apellido+"</td>";
                template += "<td>"+registros[i].Correo+"</td>";
                template += "<td>"+registros[i].NombreCurso+"</td>";
                template += "<td>"+registros[i].Precio+"</td>";
                template += "<td>"+registros[i].NombreDocente+"</td>";
                template += "<td>"+registros[i].ApellidoDocente +"</td>";


                template += '<td><input class="btn btn-primary" type="button" onclick="SeleccionarInscripcion('+registros[i].IdInscripcion+')" value="Seleccionar" />';  
                template += '<input class="btn btn-danger" type="button" onclick="BorrarInscripcion('+registros[i].IdInscripcion+')" value="Borrar" /></td>';
            template += "</tr>";
            inscripciones.push(template);
            }
                $("#registrosInscripciones").append(inscripciones.join(""));                       
                $('#tabla-inscripciones').DataTable();
        },error: function(){
            alert("hubo un error");
        },
    })
}

function SeleccionarInscripcion(id){
    
    $.ajax({
        method: "POST",
        url: "http://localhost/PruebaTrabajo/controllers/inscripciones_controllers.php?action=consulta",
        data: {id: id},
        success: function(data){
            let registros = JSON.parse(data);
            console.log(data);
            $('#txtID').val(registros[0]['IdInscripcion']);
            $('#txtAlumno').val(registros[0]['IdAlumno']);
            $('#txtCurso').val(registros[0]['IdCurso']);
            $('#txtDocente').val(registros[0]['IdDocente']);
            
            
            $('#btnAgregar').addClass('disabled');
            $('#btnEditar').removeClass('disabled');
            $('#btnCancelar').removeClass('disabled');
            console.log(registros);

        }

    });
}

function EditarInscripcion(){
    var vId=$('#txtID').val();
   
    var vIdAlumno=$('#txtAlumno').val();
    var vIdCurso=$('#txtCurso').val();
    var vIdDocente=$('#txtDocente').val();

    $.ajax({
        method: "POST",
        url: "http://localhost/PruebaTrabajo/controllers/inscripciones_controllers.php?action=editar",
        data: {id: vId ,IdAlumno : vIdAlumno, IdCurso : vIdCurso, IdDocente : vIdDocente},
        success: function(data){
            console.log(data);
            if(data==1){
                alert("DEBES COMPLETAR EL FORMULARIO")
               }else if(data==2){
                location.reload();
               }
            },error: function(){
                alert("hubo un error");
        }

    });
}


function BorrarInscripcion(vId){
    Swal.fire({
        title: 'Estas seguro?',
        text: "No podras revertir esta acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "POST",
                url: "http://localhost/PruebaTrabajo/controllers/inscripciones_controllers.php?action=eliminar",
                data: { id: vId},
                success: function(data){
                    console.log(data);
                    if(data==1){
                        Swal.fire(
                            'Error!',
                            'Ocurrió un error interno inténtalo nuevamente.',
                            'error'
                        )
                    }else if(data==2){
                        location.reload();
                    }
                },error: function(){
                    alert("hubo un error");
                }
            })
          
        }
    })
}

function Limpiar(){

    $('#txtID').val("");
    $('#txtAlumno').val("");
    $('#txtCurso').val("");
    $('#TxtIdDocente').val("");

    
    $('#btnAgregar').removeClass('disabled');
    $('#btnEditar').addClass('disabled');
    $('#btnCancelar').addClass('disabled');
}

function recargarComboBoxAlumnos(){
    $.ajax({
        method: "GET",
        url: "http://localhost/PruebaTrabajo/controllers/inscripciones_controllers.php?action=listar_alumnos",
        success: function(data){
          $('#contentComboAlumno').append(data);
        },error: function(){
            alert("En estos Momentos ha suscedido algo inesperado y no se pudo Completar el registro");
        },
    });
}

function recargarComboBoxCursos(){
    $.ajax({
        method: "GET",
        url: "http://localhost/PruebaTrabajo/controllers/inscripciones_controllers.php?action=listar_cursos",
        success: function(data){
          $('#contentComboCurso').append(data);
        },error: function(){
            alert("En estos Momentos ha suscedido algo inesperado y no se pudo Completar el registro");
        },
    });
}

function recargarComboBoxDocentes(){
    $.ajax({
        method: "GET",
        url: "http://localhost/PruebaTrabajo/controllers/inscripciones_controllers.php?action=listar_docentes",
        success: function(data){
          $('#contentComboDocente').append(data);
        },error: function(){
            alert("En estos Momentos ha suscedido algo inesperado y no se pudo Completar el registro");
        },
    });
}

selectInscripcion();
recargarComboBoxDocentes();
recargarComboBoxAlumnos();
recargarComboBoxCursos();