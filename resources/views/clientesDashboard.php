<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/libs/ui.jqgrid-bootstrap5.css">
    <link rel="stylesheet" href="css/app.css">
</head>
<body>

    <!-- Figuras decorativas, mismas del login -->
    <div class="shape shape-blue"></div>
    <div class="shape shape-orange"></div>

    <div class="layout">

        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-logo">
                <span class="logo-text">&lt;/&gt; MVC</span>
            </div>

            <nav class="sidebar-nav">
                <a href="#" class="nav-item active">
                    <i class="fa-solid fa-gauge"></i>
                    <span>Resumen</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fa-solid fa-users"></i>
                    <span>Usuarios</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fa-solid fa-box"></i>
                    <span>Productos</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    <span>Ventas</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Reportes</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fa-solid fa-gear"></i>
                    <span>Configuración</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <a href="/logout" class="nav-item">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Cerrar sesión</span>
                </a>
            </div>
        </aside>

        <!-- CONTENIDO -->
        <div class="main">

                <h1 class="page-title">Administración de Clientes</h1>
                <table id="clientes"></table>
                <div id="navclientes"></div>
            </header>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/libs/jquery.min.js"></script>
    <script src="js/libs/grid.locale-es.js"></script>
    <script src="jquery.jqgrid.min.js"></script>
    <script src="js/views/app.js"></script>
    <script src="js/views/dashboard.js"></script>


</body>
</html>