<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clientes</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/libs/ui.jqgrid-bootstrap5.css">
  <link rel="stylesheet" href="/css/views/app.css">
</head>
<body style="background-color: #C9D9E6;">

  <div class="d-flex vh-100">

    <aside class="d-flex flex-column justify-content-between text-white p-3" style="width: 260px; background-color: #596070;">
      <div>
        <a href="#" class="d-flex align-items-center gap-2 text-white text-decoration-none mb-4">
          <span class="fw-bold">&lt;/&gt;</span>
          <span class="fs-5 fw-semibold">Sistema de Clínica</span>
        </a>

        <div class="text-uppercase small mb-2" style="color: #B2CDDF;">Navegación</div>

        <ul class="nav nav-pills flex-column gap-1">

          <li class="nav-item">
            <a href="#" class="nav-link text-white" style="background-color: #757F99;">
              <span class="me-2">📊</span>Dashboard
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link text-white-50" data-bs-toggle="collapse" data-bs-target="#menuProyectos">
              <span class="me-2">📦</span>Proyectos
            </a>
            <ul class="collapse nav flex-column ms-4" id="menuProyectos">
              <li><a href="#" class="nav-link text-white-50 py-1">Administración de Proyectos</a></li>
              <li><a href="#" class="nav-link text-white-50 py-1">Requerimientos Funcionales</a></li>
              <li><a href="#" class="nav-link text-white-50 py-1">Requerimientos No Funcionales</a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link text-white-50" data-bs-toggle="collapse" data-bs-target="#menuUsuarios">
              <span class="me-2">👥</span>Usuarios
            </a>
            <ul class="collapse nav flex-column ms-4" id="menuUsuarios">
              <li><a href="#" class="nav-link text-white-50 py-1">Administración de Usuarios</a></li>
              <li><a href="#" class="nav-link text-white-50 py-1">Permisos y Roles</a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link text-white-50">
              <span class="me-2">⚙️</span>Configuración
            </a>
          </li>

        </ul>
      </div>

      <a href="/logout" class="btn w-100 text-white" style="background-color: #94A9BE;">
        <span class="me-2">🚪</span>Cerrar Sesión
      </a>
    </aside>

    <div class="d-flex flex-column flex-grow-1 overflow-auto">

      <header class="d-flex justify-content-between align-items-center border-bottom p-3 shadow-sm" style="background-color: #EAF1F1;">
        <div class="input-group" style="max-width: 320px;">
          <span class="input-group-text" style="background-color: #EAF1F1;">🔍</span>
          <input type="text" class="form-control" placeholder="Buscar módulo o registro...">
        </div>

        <div class="d-flex align-items-center gap-2">
          <div class="text-end">
            <div class="fw-semibold"><?= $_SESSION['user'] ?></div>
            <div class="text-muted small">ejemplo@estudiante.edu</div>
          </div>
          <div class="rounded-circle text-white d-flex align-items-center justify-content-center" style="width:40px; height:40px; background-color: #757F99;">CM</div>
        </div>
      </header>

      <main class="p-4">
        <h1 class="h3 mb-4" style="color: #596070;">Administración de Clientes</h1>

        <div class="card shadow-sm" style="background-color: #EAF1F1; border: none;">
          <div class="card-body">
            <table id="clientes" class="table table-striped table-hover align-middle"></table>
            <div id="navclientes"></div>
          </div>
        </div>
      </main>

    </div>
  </div>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/libs/jquery.min.js"></script>
  <script src="js/libs/grid.locale-es.js"></script>
  <script src="js/libs/jquery.jqgrid.min.js"></script>
  <script src="js/views/app.js"></script>
  <script src="js/views/clientes.js"></script>
</body>
</html>
