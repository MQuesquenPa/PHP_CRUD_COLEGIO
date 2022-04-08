function insertarDocente(){
    
    var vNombre=$('#TxtNombre').val();
    var vApellido=$('#TxtApellido').val();
    var vDNI=$('#TxtDNI').val();
    var vCorreo=$('#TxtCorreo').val();
    var vTelefono=$('#TxtTelefono').val();
    var vIdCurso=$('#txtCurso').val();
   
        $.ajax({
            method: "POST",
            url: "http://localhost/PruebaTrabajo/controllers/docentes_controllers.php?action=insertar",
            data: { nombre : vNombre, apellido : vApellido, dni : vDNI, correo : vCorreo, telefono : vTelefono, idCurso : vIdCurso},
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

function selectDocente(){
    $("#registrosDocentes").empty();
    var docentes=[];
    $.ajax({
        method: "GET",
        url: "http://localhost/PruebaTrabajo/controllers/docentes_controllers.php?action=listar",
        data: null,
        success: function(data){

            let registros= JSON.parse(data);

            
            for(var i=0; i<registros.length; i++){
                var template = "<tr>";
                
                template += "<td>"+registros[i].idDocente+"</td>";
                template += "<td>"+registros[i].Nombre+"</td>";
                template += "<td>"+registros[i].Apellido+"</td>";
                template += "<td>"+registros[i].DNI+"</td>";
                template += "<td>"+registros[i].Correo+"</td>";
                template += "<td>"+registros[i].Telefono+"</td>";
                template += "<td>"+registros[i].NombreCurso+"</td>";


                template += '<td><input class="btn btn-primary" type="button" onclick="SeleccionarDocente('+registros[i].idDocente+')" value="Seleccionar" />';  
                template += '<input class="btn btn-danger" type="button" onclick="BorrarDocente('+registros[i].idDocente+')" value="Borrar" /></td>';
            template += "</tr>";
            docentes.push(template);
            }
                $("#registrosDocentes").append(docentes.join(""));                       
                $('#tabla-docentes').DataTable();
        },error: function(){
            alert("hubo un error");
        },
    })
}

function SeleccionarDocente(id){
    
    $.ajax({
        method: "POST",
        url: "http://localhost/PruebaTrabajo/controllers/docentes_controllers.php?action=consulta",
        data: {id: id},
        success: function(data){
            let registros = JSON.parse(data);
            console.log(data);
            $('#txtID').val(registros[0]['idDocente']);
            $('#TxtNombre').val(registros[0]['Nombre']);
            $('#TxtApellido').val(registros[0]['Apellido']);
            $('#TxtDNI').val(registros[0]['DNI']);
            $('#TxtCorreo').val(registros[0]['Correo']);
            $('#TxtTelefono').val(registros[0]['Telefono']);
            $('#txtCurso').val(registros[0]['idCurso']);


            
            $('#btnAgregar').addClass('disabled');
            $('#btnEditar').removeClass('disabled');
            $('#btnCancelar').removeClass('disabled');
        }

    });
}

function EditarDocente(){
    var vId=$('#txtID').val();

    var vNombre=$('#TxtNombre').val();
    var vApellido=$('#TxtApellido').val();
    var vDNI=$('#TxtDNI').val();
    var vCorreo=$('#TxtCorreo').val();
    var vTelefono=$('#TxtTelefono').val();
    var vIdCurso=$('#txtCurso').val();

    $.ajax({
        method: "POST",
        url: "http://localhost/PruebaTrabajo/controllers/docentes_controllers.php?action=editar",
        data: {id: vId , nombre : vNombre, apellido : vApellido, dni : vDNI, correo : vCorreo, telefono : vTelefono, idCurso: vIdCurso},
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


function BorrarDocente(vId){
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
                url: "http://localhost/PruebaTrabajo/controllers/docentes_controllers.php?action=eliminar",
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
    document.getElementById("txtID").value = "";
    document.getElementById("TxtNombre").value = "";
    document.getElementById("TxtApellido").value = "";
    document.getElementById("TxtDNI").value = "";
    document.getElementById("TxtCorreo").value = "";
    document.getElementById("TxtTelefono").value = "";
    document.getElementById("txtCurso").value = "";

    
    $('#btnAgregar').removeClass('disabled');
    $('#btnEditar').addClass('disabled');
    $('#btnCancelar').addClass('disabled');
}

function recargarComboBoxCursos(){
    $.ajax({
        method: "GET",
        url: "http://localhost/PruebaTrabajo/controllers/docentes_controllers.php?action=listar_cursos",
        success: function(data){
          $('#contentComboCurso').append(data);
        },error: function(){
            alert("En estos Momentos ha suscedido algo inesperado y no se pudo Completar el registro");
        },
    });
}

selectDocente();
recargarComboBoxCursos();