// Login Page Flipbox control
$('.login-content [data-toggle="flip"]').click(function() {
    $('.login-box').toggleClass('flipped');
    return false;
});

var divLoading = document.querySelector('#divLoading');

$(document).ready(function(){


    // Login 
    if (document.querySelector("#login-form")) {
        let loginForm = document.querySelector("#login-form");
        loginForm.onsubmit = function(e){
            e.preventDefault();

            let strUser = document.querySelector('#txtUser').value;
            let strClave = document.querySelector('#txtClave').value;

            if (strUser == "" || strClave == "") {
                swal("Por favor", "Escribe usuario y contraseña.","error");
                return false;
            }else{
                divLoading.style.display = "flex";
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = base_url+'/Login/loginUser';
                var formData = new FormData(loginForm);
                request.open("POST",ajaxUrl,true);
                request.send(formData);

                request.onreadystatechange = function(){
                    if (request.readyState != 4) return;
                    if (request.status == 200) {
        
                        var objData = JSON.parse(request.responseText);
                        if (objData.status) {
                
                            window.location = base_url+'/usuarios/perfil'; // redireccion
        
                        }else{
                            swal("Error",objData.msg, "error");
                            document.querySelector('#txtClave').value = "";
                        }
        
                    }else{
                        swal("Atención","Error en el proceso.", "error");
                    }
                    divLoading.style.display = "none";

                    return false;
                }
            }
        }
    }

    // recuperar Contraseñas
    if (document.querySelector("#reset-form")) {
        let resetForm = document.querySelector("#reset-form");
        resetForm.onsubmit = function(e){
            e.preventDefault();

            let strEmail = document.querySelector('#txtEmailReset').value;

            if (strEmail == "") {
                swal("Por favor", "Escribe el Email viculada a su cuenta.","error");
                return false;

            }else{
                divLoading.style.display = "flex";
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = base_url+'/Login/resetPass';
                var formData = new FormData(resetForm);
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
                                confirmButtonText: "Aceptar",
                                closeOnConfirm: false,

                            }, function(isConfirm){
                                if (isConfirm) {
                                    window.location = base_url;
                                }
                            });
        
                        }else{
                            swal("Atención",objData.msg, "error");
                        }

                    }else{
                        swal("Atención","Error en el proceso.", "error");
                    }
                    divLoading.style.display = "none";
                    return false;
                }
            }
        }
    }

    // guardar nueva contraseña

    if (document.querySelector("#newPass-form")) {
        let newPassForm = document.querySelector("#newPass-form");
        newPassForm.onsubmit = function(e){
            e.preventDefault();

            let intIdUser = document.querySelector('#idUsuario').value;
            let strPass = document.querySelector('#txtClave').value;
            let strPass2 = document.querySelector('#txtClave2').value;

            if (intIdUser == "" || strPass == "" || strPass2 == "") {
                swal("Por favor", "Escribe las nuevas contraseñas.","error");
                return false;

            }else{
               if (strPass.length < 4) {
                swal("Atención", "La contraseña debe tener mínimo 4 caracteres.","info");
                return false;
               }
               if (strPass != strPass2) {
                swal("Atención", "Verifica que las contraseñas sean iguales.","error");
                return false;
               }

               divLoading.style.display = "flex";

               var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
               var ajaxUrl = base_url+'/Login/setPassword';
               var formData = new FormData(newPassForm);
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
                                confirmButtonText: "Iniciar Sessión",
                                closeOnConfirm: false,

                            }, function(isConfirm){
                                if (isConfirm) {
                                    window.location = base_url+'/login';
                                }
                            });
        
                        }else{
                            swal("Atención",objData.msg, "error");
                        }
                    }else{
                        swal("Atención","Error en el proceso.", "error");
                    }
                    divLoading.style.display = "none";
                    return false;
                }
            }
        }
    }



}, false);