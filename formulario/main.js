const nombre = document.getElementById("nombre");
const email = document.getElementById("email");
const telephone = document.getElementById("telephone");
const texto = document.getElementById("texto");
const form = document.getElementById("form");
const parrafo = document.getElementById("warnings");


form.addEventListener('submit', e=>{
    e.preventDefault()
    let warnings = ""
    let entrar = false
    let regexEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    parrafo.innerHTML = "" 
    let datos = new FormData(form);
    
    if(nombre.value.length <=0) {
        warnings += "El Nombre no es valido <br>"
        entrar = true
    }
    
    if(!regexEmail.test(email.value)){
        warnings += "El Email no es valido <br>"
        entrar = true
        
    } if(telephone.value.length <= 9){ //arreglar el numero de telefono asi poder validar sus cantidades de caracteres
        warnings +="Telefono inválido <br>"
        entrar = true
        
    }
    if(texto.value.length >= 350){
        warnings +="Es demasiado texto"
        entrar = true
        
    }
    if(texto.value.length <= 0) {
        warnings += "Dejanos un mensaje"
        entrar= true
    }

    if(entrar){
        parrafo.innerHTML = warnings
        
    }

    
    let peticion = {
        method:'POST',
        body:datos,
    }

    fetch('recibir-datos.php',peticion)
    .then(respuesta => respuesta.json())
    .then(respuesta => {
        if(respuesta['respuesta']) {
            swal("Bien Hecho", "Tu mensaje ha sido enviado, te vamos a responder a la brevedad", "success").then((value) => {
                location.reload();
            });
        }else{
            swal("MAL!", "Tu mensaje no ha sido enviado, por favor revisar que los datos esten ingresados correctamente", "error");
        }


    }).catch(error => console.log("error", error));

});
