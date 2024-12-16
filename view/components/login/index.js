$(document).ready(function(){

    let form=$("#form_login");
    let validacion=true;
    form.on('submit', function(event) {
        event.preventDefault(); // Evita el envío normal del formulario

        $("#span_1").attr("hidden",true);
        $("#span_2").removeAttr("hidden",true);

        setTimeout(enviarFormulario, 1000);
        
        function enviarFormulario(){
            if(validacion==true){
    
                $.ajax({
                    url: 'procesar_formulario.php', // URL del script PHP
                    type: 'POST',
                    data: $(this).serialize(), // Serializa los datos del formulario
                    success: function(response) {
                        console.log("enviado");
                        $('#respuesta').html(response); // Muestra la respuesta del servidor
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
            
        }
    });
});
// script.js
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
