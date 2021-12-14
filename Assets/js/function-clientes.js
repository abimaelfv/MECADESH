

function openModal() {
 
    document.querySelector('#idUsuario').value="";
    document.querySelector('#txtMensaje').innerHTML = 'Todos los campos son obligatorios.';
    document.querySelector('.nuevorow').innerHTML = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate","headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info","btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Cliente";
    document.querySelector('#formCliente').reset();
    $('#modalFormCliente').modal('show');
}
