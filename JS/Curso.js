function insertarCurso(){
    
    var vNombre=$('#TxtNombre').val();
    var vPeriodo=$('#TxtPeriodo').val();
    var vPrecio=$('#TxtPrecio').val();
   
        $.ajax({
            method: "POST",
            url: "http://localhost/PruebaTrabajo/controllers/cursos_controllers.php?action=insertar",
            data: { nombre : vNombre, periodo : vPeriodo, precio : vPrecio},
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
    
function selectCurso(){
    $("#registrosCursos").empty();
    var cursos=[];
    $.ajax({
        method: "GET",
        url: "http://localhost/PruebaTrabajo/controllers/cursos_controllers.php?action=listar",
        data: null,
        success: function(data){

            let registros= JSON.parse(data);

            
            for(var i=0; i<registros.length; i++){
                var template = "<tr>";
                
                template += "<td>"+registros[i].IdCurso+"</td>";
                template += "<td>"+registros[i].Nombre+"</td>";
                template += "<td>"+registros[i].Periodo+"</td>";
                template += "<td>"+registros[i].Precio+"</td>";
                template += "<td>"+registros[i].Estado+"</td>";
                template += '<td><input class="btn btn-primary" type="button" onclick="SeleccionarCurso('+registros[i].IdCurso+')" value="Seleccionar" />';  
                template += '<input class="btn btn-danger" type="button" onclick="BorrarCurso('+registros[i].IdCurso+')" value="Borrar" /></td>';
                template += "</tr>";
                cursos.push(template);
            }
                $("#registrosCursos").append(cursos.join(""));                       
                $('#tabla-cursos').DataTable();


        },error: function(){
            alert("hubo un error");
        },
    })
}

function SeleccionarCurso(id){
    
    $.ajax({
        method: "POST",
        url: "http://localhost/PruebaTrabajo/controllers/cursos_controllers.php?action=consulta",
        data: {id: id},
        success: function(data){
            let registros = JSON.parse(data);
            console.log(data);
            $('#txtID').val(registros[0]['IdCurso']);
            $('#TxtNombre').val(registros[0]['Nombre']);
            $('#TxtPeriodo').val(registros[0]['Periodo']);
            $('#TxtPrecio').val(registros[0]['Precio']);

            $('#btnAgregar').addClass('disabled');
            $('#btnEditar').removeClass('disabled');
            $('#btnCancelar').removeClass('disabled');
        }

    });
}

function EditarCurso(){
    var vId=$('#txtID').val();
    var vNombre=$('#TxtNombre').val();

    var vPeriodo=$('#TxtPeriodo').val();
    var vPrecio=$('#TxtPrecio').val();
    $.ajax({
        method: "POST",
        url: "http://localhost/PruebaTrabajo/controllers/cursos_controllers.php?action=editar",
        data: { id: vId, nombre : vNombre, periodo : vPeriodo, precio : vPrecio },
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

function BorrarCurso(vId){
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
                url: "http://localhost/PruebaTrabajo/controllers/cursos_controllers.php?action=eliminar",
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
    document.getElementById("TxtPeriodo").value = "";
    document.getElementById("TxtPrecio").value = "";

    
    $('#btnAgregar').removeClass('disabled');
    $('#btnEditar').addClass('disabled');
    $('#btnCancelar').addClass('disabled');
}


selectCurso();




