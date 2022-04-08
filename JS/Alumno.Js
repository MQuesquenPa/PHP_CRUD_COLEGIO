function insertarAlumno(){
    
    var vNombre=$('#TxtNombre').val();
    var vApellido=$('#TxtApellido').val();
    var vDNI=$('#TxtDNI').val();
    var vCorreo=$('#TxtCorreo').val();
    var vTelefono=$('#TxtTelefono').val();


   
        $.ajax({
            method: "POST",
            url: "http://localhost/PruebaTrabajo/controllers/alumnos_controllers.php?action=insertar",
            data: { nombre : vNombre, apellido : vApellido, dni : vDNI, correo : vCorreo, telefono : vTelefono},
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

function selectAlumno(){
    $("#registrosAlumnos").empty();
    var alumnos=[];
    $.ajax({
        method: "GET",
        url: "http://localhost/PruebaTrabajo/controllers/alumnos_controllers.php?action=listar",
        data: null,
        success: function(data){

            let registros= JSON.parse(data);

            
            for(var i=0; i<registros.length; i++){
                var template = "<tr>";
                
                template += "<td>"+registros[i].idAlumno+"</td>";
                template += "<td>"+registros[i].Nombre+"</td>";
                template += "<td>"+registros[i].Apellido+"</td>";
                template += "<td>"+registros[i].DNI+"</td>";
                template += "<td>"+registros[i].Correo+"</td>";
                template += "<td>"+registros[i].Telefono+"</td>";

                template += '<td><input class="btn btn-primary" type="button" onclick="SeleccionarAlumno('+registros[i].idAlumno+')" value="Seleccionar" />';  
                template += '<input class="btn btn-danger" type="button" onclick="BorrarAlumno('+registros[i].idAlumno+')" value="Borrar" /></td>';
            template += "</tr>";
            alumnos.push(template);
            }
                $("#registrosAlumnos").append(alumnos.join(""));                       
                $('#tabla-alumnos').DataTable();


        },error: function(){
            alert("hubo un error");
        },
    })
}

function SeleccionarAlumno(id){
    
    $.ajax({
        method: "POST",
        url: "http://localhost/PruebaTrabajo/controllers/alumnos_controllers.php?action=consulta",
        data: {id: id},
        success: function(data){
            let registros = JSON.parse(data);
            console.log(data);
            $('#txtID').val(registros[0]['idAlumno']);
            $('#TxtNombre').val(registros[0]['Nombre']);
            $('#TxtApellido').val(registros[0]['Apellido']);
            $('#TxtDNI').val(registros[0]['DNI']);
            $('#TxtCorreo').val(registros[0]['Correo']);
            $('#TxtTelefono').val(registros[0]['Telefono']);

            
            $('#btnAgregar').addClass('disabled');
            $('#btnEditar').removeClass('disabled');
            $('#btnCancelar').removeClass('disabled');
        }

    });
}

function EditarAlumno(){
    var vId=$('#txtID').val();

    var vNombre=$('#TxtNombre').val();
    var vApellido=$('#TxtApellido').val();
    var vDNI=$('#TxtDNI').val();
    var vCorreo=$('#TxtCorreo').val();
    var vTelefono=$('#TxtTelefono').val();

    $.ajax({
        method: "POST",
        url: "http://localhost/PruebaTrabajo/controllers/alumnos_controllers.php?action=editar",
        data: {id: vId , nombre : vNombre, apellido : vApellido, dni : vDNI, correo : vCorreo, telefono : vTelefono},
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


function BorrarAlumno(vId){
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
                url: "http://localhost/PruebaTrabajo/controllers/alumnos_controllers.php?action=eliminar",
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
    
    $('#btnAgregar').removeClass('disabled');
    $('#btnEditar').addClass('disabled');
    $('#btnCancelar').addClass('disabled');
}

selectAlumno();