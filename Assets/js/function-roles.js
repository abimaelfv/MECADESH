var divLoading = document.querySelector('#divLoading2');
var tableRoles;

$(document).ready(function(){

	tableRoles = $('#tableRoles').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Roles/getRoles",
            "dataSrc":""
        },
        "columns":[
            {"data":"idrol"},
            {"data":"nombrerol"},
            {"data":"descripcion"},
            {"data":"status"},
            {"data":"options"}
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"asc"]]  
    });


    // Asignar permiso
    $(document).on("click","button.btnPermisosRol", function(e){
        e.preventDefault();

        var idrol = this.getAttribute("rl");
        fntPermisos(idrol);
    });

    // editar
    $(document).on("click","button.btnEditRol", function(e){
        e.preventDefault();

        var idrol = this.getAttribute("rl");
        fntEditRol(idrol);
    });

    // eliminar
    $(document).on("click","button.btnDelRol", function(e){
        e.preventDefault();

        var idrol = this.getAttribute("rl");
        fntDelRol(idrol);
    });

    //NUEVO ROL y UPDATE
    var formRol = document.querySelector("#formRol");
    formRol.onsubmit = function(e) {
        e.preventDefault();

        var intIdRol = document.querySelector('#idRol').value;
        var strNombre = document.querySelector('#txtNombre').value;
        var strDescripcion = document.querySelector('#txtDescripcion').value;
        var intStatus = document.querySelector('#listStatus').value; 

        if(strNombre == '' || strDescripcion == '' || intStatus == ''){
            swal("", "Todos los campos son obligatorios." , "error");
            return false;

        }else{
            divLoading.style.display = "flex";
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Roles/setRol'; 
            var formData = new FormData(formRol);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
               if(request.readyState == 4 && request.status == 200){
                    
                    var objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        $('#modalFormRol').modal("hide");
                        formRol.reset();
                        swal("", objData.msg ,"success");
                        tableRoles.api().ajax.reload(function(){ 
     
                        });
                    }else{
                        swal("Error", objData.msg , "error");
                    }              
                }else{

                }
                divLoading.style.display = "none";
                return false;
            }
        }     
    }
});

$('#tableRoles').DataTable();

function openModal(){

    document.querySelector('#idRol').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Rol";
    document.querySelector("#formRol").reset();
	$('#modalFormRol').modal('show');
}


function fntEditRol(idrol){

    document.querySelector('#titleModal').innerHTML ="Actualizar Rol";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/Roles/getRol/'+idrol;
    request.open("GET",ajaxUrl ,true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                document.querySelector("#idRol").value = objData.data.idrol;
                document.querySelector("#txtNombre").value = objData.data.nombrerol;
                document.querySelector("#txtDescripcion").value = objData.data.descripcion;

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
            
}


function fntDelRol(idrol){

    swal({
        title: "",
        text: "¿Realmente quiere eliminar el Rol?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "Cancelar"
    }, function(isConfirm) {
        
        if (isConfirm) {
            divLoading.style.display = "flex";

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Roles/delRol/';
            var strData = "idrol="+idrol;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("", objData.msg , "success");
                        tableRoles.api().ajax.reload(function(){

                        });
                    }else{
                        swal("Atención!", objData.msg , "error");
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


function fntPermisos(idrol){

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Permisos/getPermisosRol/'+idrol;
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            document.querySelector('#contentAjax').innerHTML = request.responseText;
            $('.modalPermisos').modal('show');
            document.querySelector('#formPermisos').addEventListener('submit',fntSavePermisos,false);
        }
    }
}


function fntSavePermisos(evnet){
    evnet.preventDefault();

    divLoading.style.display = "flex";
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Permisos/setPermisos'; 
    var formElement = document.querySelector("#formPermisos");
    var formData = new FormData(formElement);
    request.open("POST",ajaxUrl,true);
    request.send(formData);

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                swal("", objData.msg ,"success");
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


