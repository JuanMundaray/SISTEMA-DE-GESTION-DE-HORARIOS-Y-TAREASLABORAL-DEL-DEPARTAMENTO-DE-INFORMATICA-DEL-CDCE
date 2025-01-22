$(document).ready(function(){

    let form=$("#form_login");
    let validacion=true;

    form.on('submit', function(event) {
        event.preventDefault(); // Evita el envío normal del formulario

        $("#span_1").attr("hidden",true); //Mostrar el spin del login
        $("#span_2").removeAttr("hidden",true); //Ocultar las letras originales del login

        //ENVIAR FORLMULARIO
        if(validacion==true){
            $.ajax({
                data: form.serialize(),
                url: '../../../controller/ControllerUsuario.php', // URL del script PHP,
                type: 'post',
                success: function(response) {

                    console.log(response.statuscode);

                    if(response==Array){

                    }

                    else{

                        if(response.statuscode === 201){
    
                            //TERMINAR ANIMACION DE SPIN
                            $("#span_1").removeAttr("hidden",true);
                            $("#span_2").attr("hidden",true);
                        }         
                    }


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error en la solicitud: ' + textStatus, errorThrown);
                    $("#span_1").removeAttr("hidden",true);
                    $("#span_2").attr("hidden",true);
                }
            });

        }

        else{

        }
    });
});


// ANIMACION DE ESCRIBIR LETRAS DEL LOGIN
document.addEventListener("DOMContentLoaded", function() {
    const text = "INICIAR SESIÓN";
    const typingText = document.getElementById("typing-text");
    let index = 0;

    function type() {
        if (index < text.length) {
            typingText.textContent += text.charAt(index);
            index++;
            setTimeout(type, 75); // Ajusta la velocidad de escritura aquí
        }
    }

    type();
});