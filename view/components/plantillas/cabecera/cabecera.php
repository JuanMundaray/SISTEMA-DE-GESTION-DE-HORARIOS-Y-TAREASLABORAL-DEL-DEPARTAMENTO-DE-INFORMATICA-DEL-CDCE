<header class="container shadow p-0 m-0 mw-100 z-3">
       
    <div class="bg-secondary" style="height: 10px;"></div>

    <div class="ps-4 pe-4 d-flex align-content-center title-space-header">
        
        <div class="d-flex w-100">
            
            <div class="logo d-flex align-content-center">
                <img class="me-4" src="../../assets/logo/CDCE-logo-ministerio-de-educacion.png"/>
                <a href="/" title="logo"> SISTEMA DE GESTION LABORAL </a>
            </div>

            <?php 
                if(isset($_SESSION['cedula'])){ 
                    echo '
                        <div class="w-100 d-flex align-self-center justify-content-end menu_dropdown_usuario"> 
                            <div class="dropdown text-end">

                                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span>'. $_SESSION['cedula'] .'</span>
                                    <img src="" alt="mdo" class="rounded-circle">
                                </a>

                                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                                    <li><a class="dropdown-item" href="#">Configuración</a></li>
                                    <li><a class="dropdown-item" href="#">Perfil</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="../../../controller/ControllerUsuario.php?option=cerrar_sesion">Cerrar Sesión</a></li>
                                </ul>
                            </div>
                        </div>';
                }
            ?>
            
        </div>
    </div>
</header>