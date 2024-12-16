<?php
    require("../plantillas/config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo NOMBRE_SISTEMA;?></title>
    <link rel="stylesheet" href="../../css//style.css">
    <link rel="icon" type="image/x-icon" href="../../../favicon.ico">
    <link rel="stylesheet" href="../../css/bootstrap-5.1.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="home.css">
</head>
<body class="d-flex flex-column">

    <?php require_once("../plantillas/cabecera/cabecera.php") ?>

    <div class="d-flex h-100">

        <?php require_once("../plantillas/sidebar/sidebar.php") ?>
        
        <main>
            <h1>MARCAR ASISTENCIA</h1>
        </main>
    </div>
    
    
    <script src="../../css//bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script src="../../css//bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"></script>
</body>
</html>