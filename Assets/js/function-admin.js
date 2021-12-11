$(document).ready(function(){




     $(document).on("keyup",".validText", function(){
        
        let inputValue = this.value;
        if(!testText(inputValue)){
            this.classList.add('is-invalid');
        }else{
            this.classList.remove('is-invalid');
        }

    });

    $(document).on("keyup",".validNumber", function(){
        
        let inputValue = this.value;
        if(!testEntero(inputValue)){
            this.classList.add('is-invalid');
        }else{
            this.classList.remove('is-invalid');
        }
    });

    $(document).on("keyup",".validEmail", function(){
        
        let inputValue = this.value;
        if(!fntEmailValidate(inputValue)){
            this.classList.add('is-invalid');
        }else{
            this.classList.remove('is-invalid');
        }
    });


});



function controlTag(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 
    else if (tecla==0||tecla==9)  return true;
    patron =/[0-9\s]/;
    n = String.fromCharCode(tecla);
    return patron.test(n); 
}

function testText(txtString){
    var stringText = new RegExp(/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/);
    if(stringText.test(txtString)){
        return true;
    }else{
        return false;
    }
}

function testEntero(intCant){
    var intCantidad = new RegExp(/^([0-9])*$/);
    if(intCantidad.test(intCant)){
        return true;
    }else{
        return false;
    }
}

function fntEmailValidate(email){
    var stringEmail = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
    if (stringEmail.test(email) == false){
        return false;
    }else{
        return true;
    }
}
