$(document).ready(function(){

    let form=$("#form_login");
    let validacion=true;
    let responses_errors;

    // Obtener el archivo JSON// Usar $.ajax para obtener y guardar los datos
    $.ajax({
        url: '../../../config/app_responses.json',
        dataType: 'json',
        async:false,
        success: function(data) {
            responses_errors = data; // Guardar los datos en la variable]
        },error: function(xhr, status, error) {console.error(`Error al cargar el archivo JSON: ${error}`);}
    });

    console.log(responses_errors.PASSWORD_INCORRECTA.code);

    form.on('submit', function(event) {
        if (this.checkValidity()) {
            event.preventDefault(); // Evita el envío normal del formulario
            $(this).removeClass('was-validated');
            $(this).find('.is-valid, .is-invalid').each(function() {
                $(this).removeClass('is-valid is-invalid');
            });
        

            $("#span_1").attr("hidden",true); //Mostrar el spin del login
            $("#span_2").removeAttr("hidden",true); //Ocultar las letras originales del login

            //ENVIAR FORLMULARIO
            if(validacion==true){
                $.ajax({
                    data: form.serialize(),
                    url: '../../../controller/ControllerUsuario.php', // URL del script PHP,
                    type: 'post',
                    dataType:'json',
                    success: function(response) {


                        //RESULTA EXITOSA LA CONSULTA
                        if(responses_errors.RESPUESTA_EXITOSA.code === response.code){
                            $("#cedula").removeClass('is-invalid');
                            $("#password").removeClass('is-invalid');
                            $("#cedula").addClass('is-valid');
                            $("#password").addClass('is-valid');
                            location.reload();
                        }
                        //SI LA RESPUESTA NO ES POSITIVA, ES DECIR, OCURRIO UN ERROR
                        if(response.success != responses_errors.RESPUESTA_EXITOSA.code){
                            $("#span_1").removeAttr("hidden",true);
                            $("#span_2").attr("hidden",true);

                            if(responses_errors.USUARIO_INEXISTENTE.code === response.code){
                                $("#cedula").addClass('is-invalid');
                                $("#error_cedula").text("No existe un usuario con esta cédula");
                            }
                            
                            if(responses_errors.PASSWORD_INCORRECTA.code === response.code){
                                $("#password").addClass('is-invalid');
                                $("#error_password").text("Contraseña Incorrecta");
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
        }

        else{// Agregar la clase de error a los campos no válidos
            $(this).addClass('was-validated');
            $("#error_cedula").text("Este Campo es Obligatorio. Minímo 8 cáracteres");
            $("#error_password").text("Este Campo es Obligatorio. Minimo 8 cáracteres");
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