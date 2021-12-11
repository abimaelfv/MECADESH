let tableUsuarios;
let rowTable = "";
let divLoading = document.querySelector('#divLoading2');


$(document).ready(function(){

    tableUsuarios = $('#tableUsuarios').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Usuarios/getUsuarios",
            "dataSrc":""
        },
        "columns":[
            {"data":"idpersona"},
            {"data":"identificacion"},
            {"data":"nombres"},
            {"data":"apellidos"},
            {"data":"telefono"},
            {"data":"provincia"},
            {"data":"nombrerol"},
            {"data":"status"},
            {"data":"options"}
        ],
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr":"Copiar",
                "className": "btn-sm btn btn-secondary"
            },{
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr":"Esportar a Excel",
                "className": "btn-sm btn btn-success"
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Esportar a PDF",
                "className": "btn-sm btn btn-danger"
            },{
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr":"Esportar a CSV",
                "className": "btn-sm btn btn-info"
            }
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]
    });


    // ver
    $(document).on("click","button.btnViewUsuario", function(e){
        e.preventDefault();

        let idpersona = this.getAttribute("us");
        fntViewUsuario(idpersona);
    });

    // editar
    $(document).on("click","button.btnEditUsuario", function(e){
        e.preventDefault();

        let idpersona = this.getAttribute("us");
        fntEditUsuario(this,idpersona);
    });

    // eliminar
    $(document).on("click","button.btnDelUsuario", function(e){
        e.preventDefault();

        let idpersona = this.getAttribute("us");
        fntDelUsuario(idpersona);
    });
    

    // crear y actualizar Usuarios
    let formUsuario = document.querySelector("#formUsuario");
    formUsuario.onsubmit = function(e){
        e.preventDefault();
        intStatus = 1;
        let strIdentificacion = document.querySelector("#txtIdentificacion").value;
        let intRolid = document.querySelector("#txtRolid").value;
        let strNombre = document.querySelector("#txtName").value;
        let strApellido = document.querySelector("#txtApellido").value;
        let strEmail = document.querySelector("#txtEmail").value;
        let strTelefono = document.querySelector("#txtTelefono").value;
        let strProvincia = document.querySelector("#txtProvincia").value;
        let strGenero = document.querySelector("#txtGenero").value;
        if (document.querySelector("#listStatus")) {
            var intStatus = document.querySelector("#listStatus").value;
        }

        if(strIdentificacion == '' || intRolid  == '' || strNombre  == '' || strApellido  == '' || strEmail  == '' || strTelefono  == '' || strProvincia  == '' || strGenero  == '' ){
            swal("", "Todos los campos son obligatorios.", "error");
            return false;
        }

        // validar valid
        let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++) { 
            if(elementsValid[i].classList.contains('is-invalid')) { 
                swal("", "Por favor verifique los campos en rojo." , "error");
                return false;
            } 
        } 

        divLoading.style.display = "flex";
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/Usuarios/setUsuario';
        let formData = new FormData(formUsuario);
        request.open("POST",ajaxUrl,true);
        request.send(formData);

        request.onreadystatechange = function(){
            if (request.readyState == 4 && request.status == 200) {

                let objData = JSON.parse(request.responseText);
                if (objData.status) {

                    if (rowTable == "") {  // creando usuario
                        tableUsuarios.api().ajax.reload(function(){

                        });
                    }else{
                        htmlStatus = intStatus == 1 ?
                            '<span class="badge badge-success">Activo</span>' :
                            '<span class="badge badge-danger">Inactivo</span>'; 
                        rowTable.cells[1].textContent = strIdentificacion;
                        rowTable.cells[2].textContent = strNombre;
                        rowTable.cells[3].textContent = strApellido;
                        rowTable.cells[4].textContent = strTelefono;
                        rowTable.cells[5].textContent = strProvincia;
                        rowTable.cells[6].textContent = document.querySelector("#txtRolid").selectedOptions[0].text;
                        rowTable.cells[7].innerHTML = htmlStatus; // integrar
                    }
                    
                    $('#modalFormUsuario').modal("hide"); //cierre modal
                    formUsuario.reset();
                    swal("", objData.msg ,"success");


                }else{
                    swal("Error",objData.msg, "error");
                }

            }else{
                swal("Atención","Error en el proceso.", "error");
            }
            divLoading.style.display = "none";
            return false;
        }
    }


}, false);


window.addEventListener('load', function(){
    SelectRolesUsuario();
    SelectProvinciasUsuario();  
});


function SelectProvinciasUsuario() {
    let ajaxUrl = base_url+'/Funcion/getSelectProvincias';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send();


    request.onreadystatechange = function(){
        if (request.readyState == 4 && request.status == 200) {
            document.querySelector('#txtProvincia').innerHTML = request.responseText;
            $('#txtProvincia').selectpicker('render');
        }
    }

}

function SelectRolesUsuario() {
    let ajaxUrl = base_url+'/Funcion/getSelectRoles';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send();


    request.onreadystatechange = function(){
        if (request.readyState == 4 && request.status == 200) {
            document.querySelector('#txtRolid').innerHTML = request.responseText;
            $('#txtRolid').selectpicker('render');
        }
    }

}

function fntViewUsuario(idpersona){
    
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Usuarios/getUsuario/'+idpersona;
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){

        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
                let estadoUsuario = objData.data.status == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">inactivo</span>';
                
                let sexo = objData.data.genero == 'M' ? 'Masculino' : 'Femenino';

                document.querySelector('#celIdentificacion').innerHTML = objData.data.identificacion;
                document.querySelector('#celNombre').innerHTML = objData.data.nombres;
                document.querySelector('#celApellido').innerHTML = objData.data.apellidos;
                document.querySelector('#celTelefono').innerHTML = objData.data.telefono;
                document.querySelector('#celEmail').innerHTML = objData.data.email;
                document.querySelector('#celProvincia').innerHTML = objData.data.provincia;
                document.querySelector('#celGenero').innerHTML = sexo;
                document.querySelector('#celTipoUsuario').innerHTML = objData.data.nombrerol;
                document.querySelector('#celEstado').innerHTML = estadoUsuario;
                document.querySelector('#celFechaRegistro').innerHTML = objData.data.fechaRegistro;

                $('#modalViewUser').modal('show');
            }else{
                swal("Error", objData.smg, "error");
            }
        }
    }
}

function openModal() {
    rowTable = "";
    document.querySelector('#txtMensaje').innerHTML = 'Todos los campos son obligatorios.';
    document.querySelector('.nuevorow').innerHTML = "";
    document.querySelector('#idUsuario').value="";
    document.querySelector('.modal-header').classList.replace("headerUpdate","headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info","btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Usuario";
    document.querySelector('#formUsuario').reset();
    $('#modalFormUsuario').modal('show');
}

function fntEditUsuario(element,idpersona){
    rowTable = element.parentNode.parentNode.parentNode;

    //console.log(rowTable);
    // rowTable.cells[2].textContent = "46";
    document.querySelector('#txtMensaje').innerHTML = '';
    document.querySelector('.modal-header').classList.replace("headerRegister","headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary","btn-info");
    document.querySelector('#titleModal').innerHTML = "Actualizar Usuario";
    document.querySelector('#btnText').innerHTML = "Actualizar";
    document.querySelector('.nuevorow').innerHTML = ' <div class="form-row"><div class="form-group col-md-6"><label for="exampleSelect1">Estado</label><select class="form-control selectpicker" id="listStatus" name="listStatus" required=""><option value="1">Activo</option><option value="2">Inactivo</option></select></div><div class="form-group col-md-6"><label for="txtClave">Clave</label><input class="form-control" type="password" name="txtClave" id="txtClave" autocomplete="on"></div></div>';
    $('.nuevorow').selectpicker('render');
    
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl  = base_url+'/Usuarios/getUsuario/'+idpersona;
    request.open("GET",ajaxUrl ,true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            
            let objData = JSON.parse(request.responseText);

            if(objData.status)
            {
                document.querySelector("#idUsuario").value = objData.data.idpersona;
                document.querySelector("#txtIdentificacion").value = objData.data.identificacion;
                document.querySelector("#txtRolid").value = objData.data.idrol;
                $('#txtRolid').selectpicker('render');
                document.querySelector("#txtName").value = objData.data.nombres;
                document.querySelector("#txtApellido").value = objData.data.apellidos;
                document.querySelector("#txtEmail").value = objData.data.email;
                document.querySelector("#txtTelefono").value = objData.data.telefono;
                document.querySelector("#txtProvincia").value = objData.data.provincia;
                $('#txtProvincia').selectpicker('render');
                document.querySelector("#txtGenero").value = objData.data.genero;
                $('#txtGenero').selectpicker('render');

                if(objData.data.status == 1)
                        {
                            document.querySelector("#listStatus").value = 1;
                        }else{
                            document.querySelector("#listStatus").value = 2;
                        }

                $('#listStatus').selectpicker('render');

                
                $('#modalFormRol').modal('show');

            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }

    $('#modalFormUsuario').modal('show');
}


function fntDelUsuario(idpersona){
    
    swal({
        title: "",
        text: "¿Estas seguro de eliminar el Usuario?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "cancelar!"
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Usuarios/delUsuario/';
            let strData = "idUsuario="+idpersona;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);

            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("", objData.msg , "success");
                        tableUsuarios.api().ajax.reload(function(){

                        });
                    }else{
                        swal("Error", objData.msg , "error");
                    }
                }else{
                    swal("Atención","Error en el proceso.", "error");
                }
                divLoading.style.display = "none";
                return false;
            }
        }

    });

}

