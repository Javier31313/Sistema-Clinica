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
    <link rel="stylesheet" href="css/views/pacientes.css">
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
            <h1 class="h3 mb-4" style="color: #596070;">Ficha de Pacientes</h1>

        <div class="divBtn">
            <button id="btnFormBoost" class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Agregar</button>
            <button id="btnFormBoostEditar" class="btn btn-primary" type="button">Editar</button>
            <button id="btnFormBoostEliminar" class="btn btn-primary" type="button">Eliminar</button>
            <button type="button" class="btn btn-info btn-imprimir" id="btnImprimir">
            <i class="bi bi-printer-fill"></i> Imprimir Expediente
            </button>

        </div>

            <div class="card shadow-sm" style="background-color: #e6e7e7; border: none;">
            <div class="card-body">
                <table id="pacientes" class="table-info">
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

    <form id='formRegistro' class='form' >


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

      <label for="direcResidencial" class="form-label">DIRECCIÓN DE RESIDENCIA</label> <br>
      <input type="text" id="direcResidencial" name="direcResidencial" class="form-control" required><br>

      <label for="genero" class="form-label">GENERO</label> <br>
      <input type="text" id="genero" name="genero" class="form-control" required><br>

      <label for="ocupacion" class="form-label">OCUPACION</label> <br>
      <input type="text" id="ocupacion" name="ocupacion" class="form-control" required><br>

      <label for="correo" class="form-label">CORREO</label> <br>
      <input type="text" id="correo" name="correo" class="form-control" required><br>

      <label for="contacto_emergencia_parentesco" class="form-label">PARENTESCO DE CONTANTO DE EMERGENCIA</label> <br>
      <input type="text" id="contacto_emergencia_parentesco" name="contacto_emergencia_parentesco" class="form-control" required><br>

      <label for="sexoBiologico" class="form-label">SEXO BIOLÓGICO</label> <br>
      <input type="text" id="sexoBiologico" name="sexoBiologico" class="form-control" required><br>

      <label for="medUsoHabitual" class="form-label">MEDICAMENTOS DE USO HABITUAL</label> <br>
      <input type="text" id="medUsoHabitual" name="medUsoHabitual" class="form-control" required><br>

      <label for="antecFamiliares" class="form-label">ANTECEDENTES FAMILIARES</label> <br>
      <input type="text" id="antecFamiliares" name="antecFamiliares" class="form-control" required><br>

      <label for="antecPatologicos" class="form-label">ANTECEDENTES PATOLÓGICOS PERSONALES</label> <br>
      <input type="text" id="antecPatologicos" name="antecPatologicos" class="form-control" required><br>

      <label for="antecTrauma" class="form-label">ANTECEDENTES TRAUMÁTICOS</label> <br>
      <input type="text" id="antecTrauma" name="antecTrauma" class="form-control" required><br>

      <label for="antecQuirurgicos" class="form-label">ANTECEDENTES QUIRÚRGICOS</label> <br>
      <input type="text" id="antecQuirurgicos" name="antecQuirurgicos" class="form-control" required><br>

      <label for="fechaAtencion" class="form-label">FECHA DE ATENCIÓN</label> <br>
      <input type="date" id="fechaAtencion" name="fechaAtencion" class="form-control" required><br>

      <label for="horaAtencion" class="form-label">HORA DE ATENCIÓN</label> <br>
      <input type="time" id="horaAtencion" name="horaAtencion" class="form-control" required><br>

      <label for="signosVitales" class="form-label">SIGNOS VITALES</label> <br>
      <input type="text" id="signosVitales" name="signosVitales" class="form-control" required><br>

      <label for="planTratamiento" class="form-label">PLAN DE TRATAMIENTO</label> <br>
      <input type="text" id="planTratamiento" name="planTratamiento" class="form-control" required><br>

      <label for="direcResidencial" class="form-label">ASEGURADORA</label> <br>
      <input type="text" id="aseguradora" name="aseguradora" class="form-control" required><br>

      <button type="submit" class="btn" id="btnGuardar" class="btn" data-bs-dismiss="offcanvas" aria-label="Close">Guardar</button>
      <button type="submit" class="btn" id="btnEditar" style="display: none;" data-bs-dismiss="offcanvas" aria-label="Close">Editar</button>
      <button type="button"  id="btnCancelar" class="btn" data-bs-dismiss="offcanvas" aria-label="Close">Cancelar</button>
    </form>


  </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/libs/jquery.min.js"></script>
    <script src="js/libs/grid.locale-es.js"></script>
    <script src="js/libs/jquery.jqgrid.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/views/app.js"></script>
    <script src="js/views/pacientes.js"></script>
</body>
</html>