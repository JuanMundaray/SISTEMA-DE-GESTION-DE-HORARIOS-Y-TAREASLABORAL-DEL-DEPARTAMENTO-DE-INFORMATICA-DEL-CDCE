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

    <?php require_once("../plantillas/cabecera/cabecera.php") ?>

    <div class="d-flex justify-content-center align-items-center login-father-container">
        <div class="bg-white pe-5 ps-5 pb-2 contenedor_login me-5 ms-5 mb-5">
            <div class="pb-5 pt-5 container">
                <form method="post" id="form_login">
                    <div class="row gy-4 justify-content-center">
                        <div class="col-md-12 mb-4 d-flex flex-column justify-content-center align-items-center form_logo">
                            <img src="../../assets/logo/CDCE-logo-ministerio-de-educacion.png" />
                            <div class="typing-container"><h2 class="mt-3" id="typing-text"></h2></div>
                        </div>

                        <div class="col-md-12 col-sm-12 form-floating mb-3">
                            <div></div>
                            <div class="input-group-prepend input-group-lg d-flex">
                                <span class="input-group-text" id="basic-addon1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="24" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                                    </svg>                          
                                </span>
                                <input type="text" class="form-control form-control-lg" placeholder="Documento de Identidad">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 form-floating">
                            <div class="input-group-prepend input-group-lg d-flex">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="24" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                                        <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5"/>
                                        <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                    </svg>
                                </span>
                                <input type="password" class="form-control form-control-lg"  placeholder="Contraseña">
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-7 mt-5 d-flex justify-content-center">
                            <button id="button_submit" class="btn btn-primary btn-lg w-50">
                                <span id="span_1">Iniciar Sesión</span>
                                <span id="span_2" hidden><span class="spinner-grow spinner-grow-sm me-1" role="status" aria-hidden="true"></span>Iniciando...</span>
                            </button>
                        </div>
                        <div class="col-md-12">
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
    <script src="./index.js"></script>
    
</body>
</html>