<?php
    require("../plantillas/config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo NOMBRE_SISTEMA;?></title>
    <link rel="icon" type="image/x-icon" href="../../../favicon.ico">
    <link rel="stylesheet" href="../../css/bootstrap-5.1.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="../plantillas/cabecera/cabecera.css">
</head>
<body>

    <?php 
        session_start();
        if(isset($_SESSION['cedula'])){  
            header('location:../home/home.php');
            exit();
        }
    
        require_once("../plantillas/cabecera/cabecera.php") 
    ?>

    <div class="d-flex justify-content-center align-items-center login-father-container">

        <div class="bg-white pe-5 ps-5 pb-2 contenedor_login me-5 ms-5 mb-5 rounded-3">

            <div class="pb-5 pt-5 container">

                <form method="post" id="form_login" class="needs-validation" novalidate>

                    <div class="row gy-4 justify-content-center">

                        <div class="col-md-12 mb-1 d-flex flex-column justify-content-center align-items-center form_logo">
                            <img src="../../assets/logo/CDCE-logo-ministerio-de-educacion.png" />
                            <div class="typing-container"><h2 class="mt-1" id="typing-text"></h2></div>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <label class="form-label">Cédula:</label>
                            <input type="text" class="form-control form-control-lg rounded" name="cedula" id="cedula" placeholder="Documento de Identidad" required>
                            <div class="invalid-feedback" id="error_cedula">Este Campo es Obligatorio</div>

                        </div>

                        <div class="col-md-12 col-sm-12">
                            <label class="form-label">Contraseña:</label>
                            <input type="password" class="form-control form-control-lg rounded" name="password" id="password" maxlength="50" minlength="8"  placeholder="Contraseña" required>
                            <div class="invalid-feedback" id="error_password">>Este Campo es Obligatorio</div>

                        </div>

                        <input type="hidden" value="iniciar_sesion" name="option" id="option">

                        <div class="col-md-12 col-sm-7 mt-4 d-flex justify-content-center">
                            <button id="button_submit" class="btn btn-primary btn-lg w-50">
                                <span id="span_1">Iniciar Sesión</span>
                                <span id="span_2" hidden><span class="spinner-grow spinner-grow-sm me-1" role="status" aria-hidden="true"></span>Iniciando...</span>
                            </button>
                        </div>
                        <div class="col-md-12 recuperar_password">
                            <a href="/"><span>¿Olvido su contraseña?</span></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="../../css//bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script src="../../css//bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/jquery-3.7.1.js"></script>
    <script src="../../js/validationBoostrapForms.js"></script>
    <script src="./js/index.js"></script>
    
</body>
</html>