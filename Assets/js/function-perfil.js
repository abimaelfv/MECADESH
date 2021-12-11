var divLoading = document.querySelector('#divLoading2');


$(document).ready(function(){
    $(document).on("keyup",".validTextPerfil", function(){
        
        let inputValue = this.value;
        if(!testText(inputValue)){
            this.classList.add('alert-invalid');
        }else{
            this.classList.remove('alert-invalid');
        }

    });

    $(document).on("keyup",".validNumberPerfil", function(){
        
        let inputValue = this.value;
        if(!testEntero(inputValue)){
            this.classList.add('alert-invalid');
        }else{
            this.classList.remove('alert-invalid');
        }
    });

    $(document).on("keyup",".validEmailPerfil", function(){
        
        let inputValue = this.value;
        if(!fntEmailValidate(inputValue)){
            this.classList.add('alert-invalid');
        }else{
            this.classList.remove('alert-invalid');
        }
    });


    // actualizar perfil
    var formPerfil = document.querySelector("#formDataPersonal");
    formPerfil.onsubmit = function(e){
        e.preventDefault();

        var strIdentificacion = document.querySelector("#txtIdentificacion").value;
        var strNombre = document.querySelector("#txtName").value;
        var strApellido = document.querySelector("#txtApellido").value;
        var strProvincia = document.querySelector("#txtProvincia").value;
        var strGenero = document.querySelector("#txtGenero").value;

        if(strIdentificacion == '' || strNombre  == '' || strApellido  == '' || strProvincia  == '' || strGenero  == '' ){
            swal("", "Todos los campos son obligatorios.", "error");
            return false;
        }

        // validar valid
        let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++) { 
            if(elementsValid[i].classList.contains('alert-invalid')) { 
                swal("", "Por favor verifique los campos en rojo." , "error");
                return false;
            } 
        }

        swal({
            title: "",
            text: "¿Estas seguro de actualizar tus datos personales?",
            type: "info",
            showCancelButton: true,
            confirmButtonText: "Actualizar",
            cancelButtonText: "Cancelar"
        }, function(isConfirm) {
            
            if (isConfirm) 
            {
                divLoading.style.display = "flex";
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = base_url+'/Usuarios/setPerfil';
                var formData = new FormData(formPerfil);
                request.open("POST",ajaxUrl,true);
                request.send(formData);

                request.onreadystatechange = function(){
                    if (request.readyState != 4) return;
                    if (request.status == 200) {

                        var objData = JSON.parse(request.responseText);
                        if (objData.status) {
            
                            swal({
                                title: "",
                                text: objData.msg,
                                type: "success",
                                confirmButtonText: "Ok",
                            }, function(isConfirm) {
                                if(isConfirm){
                                    location.reload();
                                }
                            });

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
        });
    }


    // actualizar contactos
    var formContacto = document.querySelector("#formDataContacto");
    formContacto.onsubmit = function(e){
        e.preventDefault();

        var strEmail = document.querySelector("#txtEmail").value;
        var strTelefono = document.querySelector("#txtTelefono").value;

        if(strEmail  == '' || strTelefono  == ''){
            swal("", "Todos los campos son obligatorios.", "error");
            return false;
        }

        // validar validContacto
        let elementsValid = document.getElementsByClassName("validContacto");
        for (let i = 0; i < elementsValid.length; i++) { 
            if(elementsValid[i].classList.contains('alert-invalid')) { 
                swal("Atención", "Por favor verifique los campos en rojo." , "error");
                return false;
            } 
        }

        swal({
            title: "",
            text: "¿Estas seguro de actualizar tus datos de contacto?",
            type: "info",
            showCancelButton: true,
            confirmButtonText: "Actualizar",
            cancelButtonText: "Cancelar"
        }, function(isConfirm) {
            
            if (isConfirm) 
            {
                divLoading.style.display = "flex";
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = base_url+'/Usuarios/setContacto';
                var formData = new FormData(formContacto);
                request.open("POST",ajaxUrl,true);
                request.send(formData);

                request.onreadystatechange = function(){
                    if (request.readyState != 4) return;
                    if (request.status == 200) {

                        var objData = JSON.parse(request.responseText);
                        if (objData.status) {
            
                            swal({
                                title: "",
                                text: objData.msg,
                                type: "success",
                                confirmButtonText: "Ok",
                            }, function(isConfirm) {
                                if(isConfirm){
                                    location.reload();
                                }
                            });

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
        });
    }



    // actualizar fiscal
    var formFiscal = document.querySelector("#formDataFiscal");
    formFiscal.onsubmit = function(e){
        e.preventDefault();

        var strNit = document.querySelector("#txtNit").value;
        var strNombreFiscal = document.querySelector("#txtNombreFiscal").value;
        var strDireccionFiscal = document.querySelector("#txtDireccionFiscal").value;

        if(strNit == '' || strNombreFiscal  == '' || strDireccionFiscal  == ''){
            swal("", "Todos los campos son obligatorios.", "error");
            return false;
        }else{
            swal({
                title: "",
                text: "¿Estas seguro de actualizar tus datos fiscales?",
                type: "info",
                showCancelButton: true,
                confirmButtonText: "Actualizar",
                cancelButtonText: "Cancelar"
            }, function(isConfirm) {
                
                if (isConfirm) 
                {
                    divLoading.style.display = "flex";
                    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    var ajaxUrl = base_url+'/Usuarios/updateDataFiscal';
                    var formData = new FormData(formFiscal);
                    request.open("POST",ajaxUrl,true);
                    request.send(formData);

                    request.onreadystatechange = function(){
                        if (request.readyState != 4) return;
                        if (request.status == 200) {

                            var objData = JSON.parse(request.responseText);
                            if (objData.status) {
                                swal({
                                    title: "",
                                    text: objData.msg,
                                    type: "success",
                                    confirmButtonText: "Ok",
                                }, function(isConfirm) {
                                    if(isConfirm){
                                        location.reload();
                                    }
                                });

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
            });
        }

    }

    // Nueva contraseña
    var formClave = document.querySelector("#formNewClave");
    formClave.onsubmit = function(e){
        e.preventDefault();

        var strClaveActual = document.querySelector("#txtClaveActual").value;
        var strClaveNueva = document.querySelector("#txtClaveNueva").value;
        var strClaveConfirmar = document.querySelector("#txtClaveConfirmar").value;

        if(strClaveActual == '' || strClaveNueva  == '' || strClaveConfirmar  == ''){
            swal("", "Todos los campos son obligatorios.", "error");
            return false;
        }else{
            if (strClaveNueva.length < 4) {
            swal("", "La contraseña debe tener mínimo 4 caracteres.","error");
            return false;
            }

            if (strClaveNueva != strClaveConfirmar) {
            swal("", "Las nuevas contraseñas deben ser iguales.","error");
            return false;
            }

            swal({
                title: "",
                text: "¿Estas seguro de cambiar tu cantraseña?",
                type: "info",
                showCancelButton: true,
                confirmButtonText: "Si, cambiar",
                cancelButtonText: "Cancelar",
            }, function(isConfirm) {
                
                if (isConfirm) 
                {
                    divLoading.style.display = "flex";
                    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    var ajaxUrl = base_url+'/Usuarios/setClavePerfil';
                    var formData = new FormData(formClave);
                    request.open("POST",ajaxUrl,true);
                    request.send(formData);

                    request.onreadystatechange = function(){
                        if (request.readyState != 4) return;
                        if (request.status == 200) {

                            var objData = JSON.parse(request.responseText);
                            if (objData.status) {
                                swal({
                                    title: "",
                                    text: objData.msg,
                                    type: "success",
                                    confirmButtonText: "Ok",
                                }, function(confirmacion) {
                                    if(confirmacion){
                                        location.reload();
                                    }
                                });

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
            });
        }
    }

}, false);


SelectProvinciasPerfil();

function SelectProvinciasPerfil() {

    var ajaxUrl = base_url+'/Funcion/getProvinciasPerfil';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){
        if (request.readyState == 4 && request.status == 200) {
            document.querySelector('#txtProvincia').innerHTML = request.responseText;
        }
    }

}

