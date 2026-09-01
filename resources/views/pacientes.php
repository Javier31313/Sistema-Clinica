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
    <link rel="stylesheet" href="/css/views/pacientes.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
</head>
<body>

    

    <aside class="sidebar">
        <div class="brand">
            <i class="fa-solid fa-user-nurse"></i>
            <span>MediCare</span>
        </div>
        <ul class="nav-list">
            <li class="nav-item active"><a href="/dashboard"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
            <li class="nav-item"><a href="/pacientes"><i class="fa-solid fa-hospital-user"></i> Pacientes</a></li>
            <li class="nav-item"><a href="#"><i class="fa-solid fa-calendar-check"></i> Citas Médicas</a></li>
            <li class="nav-item"><a href="#"><i class="fa-solid fa-stethoscope"></i> Consultas</a></li>
            <li class="nav-item"><a href="/historial"><i class="fa-solid fa-file-medical"></i>Historial Clínico</a></li>
            <li class="nav-item"><a href="#"><i class="fa-solid fa-gear"></i> Configuración</a></li>
        </ul>
    </aside>

    

    <div class="main-content">
        <header>
            <div class="search-bar">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Buscar paciente por DUI o nombre...">
            </div>
            <div class="user-profile">
                <div>
                    <strong style="display: block; font-size: 0.9rem;"><?= $_SESSION['user'] ?></strong>
                    <span style="font-size: 0.75rem; color: var(--text-muted);">Medicina General</span>
                </div>
                <div class="avatar"><img class="imagen-avatar" src="img/blue_users_customers_clients_people_12438.png" alt=""></div>
            </div>
    </header>

    <div class="divBtn">
    <button id="btnAgregar" type="button" class="btnReal"></button>
    </div>

    <!-- <div class="divBtn">
    <button id="btnEditar" type="button" class="btnReal"></button>
    </div>

    <div class="divBtn">
    <button id="btnEliminar" type="button" class="btnReal"></button>
    </div> -->
    

    <!-- <form action="/pacientes/eliminar" method="POST" id="formEliminar" style="display:none;">
        <input type="hidden" id="id_eliminar" name="id">
    </form> -->

        <main class="p-4">
            <h1 class="h3 mb-4" style="color: #596070;">Ficha de Pacientes</h1>
            <div class="card shadow-sm" style="background-color: #EAF1F1; border: none;">
            <div class="card-body">
                <table id="pacientes" class="table-info">
                    <thead class="table-dark"></thead>
                </table>
                <div id="navpacientes"></div>
            </div>
            </div>
        </main> 
    
    </div>


<dialog id="dialog">
    <i class="fa-solid fa-xmark btn-cerrar-modal" id="btnX"></i>
    <form id='formRegistro' class='form' method="POST" action="/pacientes/agregar">
      <h2>SISTEMA CLINICA</h2>

      <label for="nombre" class="form-label">NOMBRE</label> <br>
      <input type="text" id="nombre" name="nombre" class="form-control" required><br>

      <label for="fecha_nacimiento" class="form-label">FECHA DE NACIMIENTO</label><br>
      <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" required><br>

      <label for="edad" class="form-label">EDAD</label> <br>
      <input type="text" id="edad" name="edad" class="form-control" required><br>

      <label for="doc_identidad" class="form-label">DOCUMENTO DE IDENTIDAD</label> <br>
      <input type="text" id="doc_identidad" name="doc_identidad" class="form-control" required><br>

      <label for="telefonos" class="form-label">TELEFONOS</label> <br>
      <input type="text" id="telefonos" name="telefonos" class="form-control" required><br>

      <label for="contacto_emergencia_nombre" class="form-label">NOMBRE DE CONTACTO DE EMERGENCIA</label><br>
      <input type="text" id="contacto_emergencia_nombre" name="contacto_emergencia_nombre" class="form-control" required><br>

      <label for="contacto_emergencia_telefono" class="form-label">TELEFONO DE CONTACTO DE EMERGENCIA</label><br>
      <input type="text" id="contacto_emergencia_telefono" name="contacto_emergencia_telefono" class="form-control" required><br>

      <label for="direcResidencial" class="form-label">DIRECCION DE RESIDENCIA</label> <br>
      <input type="text" id="direcResidencial" name="direcResidencial" class="form-control" required><br>

      <button type="submit" class="btn" id="btnGuardar">Guardar</button>
      <button type="button" class="btn" id="btnCancelar">Cancelar</button>
    </form>
</dialog>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/libs/jquery.min.js"></script>
    <script src="js/libs/grid.locale-es.js"></script>
    <script src="js/libs/jquery.jqgrid.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/views/app.js"></script>
    <script src="js/views/pacientes.js"></script>
</body>
</html>