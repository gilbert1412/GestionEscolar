<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de Gestión Escolar">
    <meta name="author" content="">

    <title>Portal Académico - Sistema Escolar</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/sb-admin-2.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif !important;
            background-color: #f8fafc;
        }
        /* Personalización de la Barra Lateral */
        .bg-gradient-primary {
            background-color: #1e293b !important; /* Azul pizarra oscuro institucional */
            background-image: none !important;
        }
        .sidebar .nav-item .nav-link {
            font-weight: 500;
            color: rgba(255, 255, 255, 0.75) !important;
        }
        .sidebar .nav-item .nav-link:hover, .sidebar .nav-item.active .nav-link {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.05);
        }
        .sidebar .nav-item .nav-link i {
            color: rgba(255, 255, 255, 0.5) !important;
        }
        .sidebar .nav-item .nav-link:hover i, .sidebar .nav-item.active .nav-link i {
            color: #3b82f6 !important; /* Detalle azul brillante al pasar el cursor o estar activo */
        }
        .sidebar-brand {
            background-color: #0f172a !important; /* Encabezado de barra lateral más oscuro para contraste */
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        .sidebar-heading {
            color: rgba(255, 255, 255, 0.4) !important;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .collapse-inner {
            background-color: #1e293b !important; /* El submenú ahora combina con la barra lateral en lugar de ser blanco */
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .collapse-inner .collapse-item {
            color: rgba(255, 255, 255, 0.7) !important;
        }
        .collapse-inner .collapse-item:hover, .collapse-inner .collapse-item.active {
            background-color: rgba(255, 255, 255, 0.08) !important;
            color: #ffffff !important;
        }
        .collapse-inner .collapse-header {
            color: rgba(255, 255, 255, 0.4) !important;
            font-weight: 700;
        }
        /* Topbar y detalles */
        .topbar {
            border-bottom: 1px solid #e2e8f0;
        }
        /* Ajuste de transiciones suaves globales */
        .nav-link, .collapse-item, .btn, .dropdown-item {
            transition: all 0.15s ease-in-out !important;
        }
    </style>

</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center py-3" href="index.html">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-graduation-cap text-primary" style="font-size: 1.4rem;"></i>
                </div>
                <div class="sidebar-brand-text mx-3" style="font-size: 0.9rem; font-weight: 700; letter-spacing: 0.5px;">Portal Académico</div>
            </a>

            <hr class="sidebar-divider my-0" style="border-top: 1px solid rgba(255,255,255,0.05)">

            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <hr class="sidebar-divider" style="border-top: 1px solid rgba(255,255,255,0.05)">

            <div class="sidebar-heading">
                Administración
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-users-cog"></i>
                    <span>Usuarios</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="collapse-inner py-2 rounded-lg">
                        <h6 class="collapse-header">Gestión:</h6>
                        <a class="collapse-item" href="{{route('usuario')}}">Lista de Usuarios</a>
                        <a class="collapse-item" href="#">Roles y Permisos</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-book-reader"></i>
                    <span>Académico</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="collapse-inner py-2 rounded-lg">
                        <h6 class="collapse-header">Configuración escolar:</h6>
                        <a class="collapse-item" href="#">Secciones y Grados</a>
                        <a class="collapse-item" href="#">Asignaturas</a>
                        <a class="collapse-item" href="#">Horarios</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider" style="border-top: 1px solid rgba(255,255,255,0.05)">

            <div class="sidebar-heading">
                Reportes
            </div>

            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-line"></i>
                    <span>Estadísticas</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-file-invoice-dollar"></i>
                    <span>Finanzas / Pagos</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block" style="border-top: 1px solid rgba(255,255,255,0.05)">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle" style="background-color: rgba(255,255,255,0.08);"></button>
            </div>

        </ul>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow-sm">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars text-secondary"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block" style="border-right: 1px solid #e2e8f0;"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-slate-600 font-weight-500 small" style="color: #475569;">Prof. Douglas McGee</span>
                                <img class="img-profile rounded-circle border"
                                    src="img/undraw_profile.svg" style="border-color: #cbd5e1; width: 32px; height: 32px;">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow border-0 rounded-lg animated--grow-in"
                                aria-labelledby="userDropdown" style="font-size: 0.9rem;">
                                <a class="dropdown-item py-2" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-3 text-muted"></i>
                                    Mi Perfil
                                </a>
                                <a class="dropdown-item py-2" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-3 text-muted"></i>
                                    Ajustes
                                </a>
                                <div class="dropdown-divider" style="border-top: 1px solid #f1f5f9;"></div>
                                <a class="dropdown-item py-2 text-danger" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-3 text-danger"></i>
                                    Cerrar Sesión
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <div class="container-fluid">
                    
                    @yield('contenido')

                </div>
                </div>
            <footer class="sticky-footer bg-white border-top">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto text-muted small">
                        <span>Sistema Escolar &copy; Portal Académico 2026</span>
                    </div>
                </div>
            </footer>
            </div>
        </div>
    <a class="scroll-to-top rounded shadow-sm" href="#page-top" style="background-color: #1e293b; color: white;">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel" style="color: #0f172a;">¿Listo para salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close" style="outline: none;">
                        <span aria-hidden="true" style="font-size: 1.5rem;">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-muted py-3">Selecciona "Cerrar sesión" abajo si estás listo para dar por terminada tu sesión actual.</div>
                <div class="modal-footer border-0 bg-light rounded-bottom">
                    <button class="btn btn-link text-muted font-weight-500" type="button" data-dismiss="modal" style="text-decoration: none;">Cancelar</button>
                    <a class="btn btn-primary px-4 rounded-lg shadow-sm" href="login.html" style="background-color: #2563eb; border-color: #2563eb; font-weight: 500;">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>