<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control Clínico</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/libs/ui.jqgrid-bootstrap5.css">
    <link rel="stylesheet" href="css/views/citas.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="css/views/app.css">
</head>
<body>

    <!-- Sidebar Bar -->
    <aside class="sidebar">
        <div class="brand">
            <i class="fa-solid fa-user-nurse"></i>
            <span>MediCare</span>
        </div>
        <ul class="nav-list">
            <li class="nav-item active"><a href="/dashboard"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
            <li class="nav-item"><a href="/pacientes"><i class="fa-solid fa-hospital-user"></i> Pacientes</a></li>
            <li class="nav-item"><a href="/citas"><i class="fa-solid fa-calendar-check"></i> Citas Médicas</a></li>
            <li class="nav-item"><a href="#"><i class="fa-solid fa-stethoscope"></i> Consultas</a></li>
            <li class="nav-item"><a href="/historial"><i class="fa-solid fa-file-medical"></i>Historial Clínico</a></li>
            <li class="nav-item"><a href="#"><i class="fa-solid fa-gear"></i> Configuración</a></li>
            <li class="nav-item"><a href="/logout" class="btn w-100 text-white" style="background-color: #94A9BE;"><span class="me-2">🚪</span>Cerrar Sesión</a></li>
        </ul>
    </aside>

    <div class="main-content">
        <header>
            <div class="search-bar">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Buscar paciente por DUI o nombre...">
            </div>
            <div class="user-profile">
                <div class="user-info">
                    <strong style="display: block; font-size: 0.9rem;"><?= $_SESSION['user'] ?></strong>
                    <span style="font-size: 0.75rem; color: var(--text-muted);">Medicina General</span>
                </div>
                <img class="imagen-avatar" src="img/blue_users_customers_clients_people_12438.png" alt="Avatar de usuario">
            </div>
    </header>

        <main class="p-4">
            <h1 class="h3 mb-4" style="color: #0f0f0f;">Ficha de Citas</h1>

        <div class="divBtn">
            <button id="btnFormBoost" class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Agregar</button>
            <button id="btnFormBoostEditar" class="btn btn-primary" type="button">Editar</button>
            <button id="btnFormBoostEliminar" class="btn btn-primary" type="button">Eliminar</button>
        </div>

            <div class="card shadow-sm" style="background-color: #e6e7e7; border: none;">
            <div class="card-body">
                <table id="citas" class="table-info">
                </table>
                <div id="navpacientes"></div>
            </div>
            </div>
        </main>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">AGREGAR FICHA</h5>

    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>

  </div>

  <div class="offcanvas-body">

    <form id='formCitas' class='form' >

        <div class="mb-3">
            <label for="id" class="form-label">Número de Expediente</label>
            <select name="id" id="id" class="form-select" required>
                <option value="">Cargando pacientes...</option>
            </select>
        </div>

        <label for="fecha" class="form-label">FECHA</label> <br>
        <input type="date" id="fecha" name="fecha" class="form-control" required><br>

        <label for="hora" class="form-label">HORA</label><br>
        <input type="time" id="hora" name="hora" class="form-control" required><br>

        <label for="especialista" class="form-label">ESPECIALISTA</label> <br>
        <input type="text" id="especialista" name="especialista" class="form-control" required><br>

        <label for="consultorio" class="form-label">CONSULTORIO</label> <br>
        <input type="text" id="consultorio" name="consultorio" class="form-control" required><br>

        <label for="modalidad" class="form-label">MODALIDAD</label> <br>
        <select id="modalidad" name="modalidad" class="form-control">
    <!-- Los values DEBEN ser idénticos al ENUM de MySQL -->
    <option value="Presencial">Presencial</option>
    <option value="Telemedicina">Telemedicina</option>
</select>
        <button type="submit" class="btn" id="btnGuardar">Guardar</button>
        <button type="submit" class="btn" id="btnEditar" style="display: none;">Editar</button>
        <button type="button"  id="btnCancelar" class="btn" data-bs-dismiss="offcanvas" aria-label="Close">Cancelar</button>
    </form>


  </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/libs/jquery.min.js"></script>
    <script src="js/libs/grid.locale-es.js"></script>
    <script src="js/libs/jquery.jqgrid.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="js/views/citas.js"></script>
</body>
</html>