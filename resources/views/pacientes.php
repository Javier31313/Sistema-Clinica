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
            <li class="nav-item"><a href="/historial"><i class="fa-solid fa-file-medical"></i>Historial Clínico</a></li>
            <li class="nav-item"><a href="/personal"><i class="fa-solid fa-user-doctor"></i>Personal</a></li>
            <li class="nav-item"><a href="/logout" class="btn w-100 text-white" style="background-color: #94A9BE;"><span class="me-2">🚪</span>Cerrar Sesión</a></li>
        </ul>
    </aside>

    <div class="main-content">
        <header>
            <div class="search-bar">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="buscarID" name="buscarID" placeholder="Buscar paciente por DUI o nombre...">
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
    <form id="formRegistro" class="form">

    <!-- SECCIÓN 1: DATOS PERSONALES Y CONTACTO -->
  <div class="form-section-title" style="grid-column: 1 / 3;">
    <i class="fa-solid fa-id-card"></i> 1. Información Personal y de Contacto
  </div>

  <div class="one">
    <label for="nombre" class="form-label">NOMBRE COMPLETO</label>
    <input type="text" id="nombre" name="nombre" class="form-control" required>

    <label for="fecha_nacimiento" class="form-label">FECHA DE NACIMIENTO</label>
    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" required>

    <label for="edad" class="form-label">EDAD</label>
    <input type="text" id="edad" name="edad" class="form-control" required>

    <label for="doc_identidad" class="form-label">DOCUMENTO DE IDENTIDAD (DUI)</label>
    <input type="text" id="doc_identidad" name="doc_identidad" class="form-control" required>

    <label for="telefonos" class="form-label">TELÉFONOS DE CONTACTO</label>
    <input type="text" id="telefonos" name="telefonos" class="form-control" required>

    <label for="correo" class="form-label">CORREO ELECTRÓNICO</label>
    <input type="email" id="correo" name="correo" class="form-control" required>
  </div>

  <div class="two">
    <label for="genero" class="form-label">GÉNERO</label>
    <input id="genero" list="listaGenero" name="genero" class="form-control" placeholder="Seleccione o escriba género" required>
    <datalist id="listaGenero">
      <option value="Femenino">
      <option value="Masculino">
    </datalist>

    <label for="sexoBiologico" class="form-label">SEXO BIOLÓGICO</label>
    <input type="text" id="sexoBiologico" name="sexoBiologico" class="form-control" required>

    <label for="ocupacion" class="form-label">OCUPACIÓN</label>
    <input type="text" id="ocupacion" name="ocupacion" class="form-control" required>

    <label for="direcResidencial" class="form-label">DIRECCIÓN DE RESIDENCIA</label>
    <input type="text" id="direcResidencial" name="direcResidencial" class="form-control" required>

    <label for="aseguradora" class="form-label">ASEGURADORA</label>
    <input type="text" id="aseguradora" name="aseguradora" class="form-control" required>
  </div>


  <!-- SECCIÓN 2: CONTACTO DE EMERGENCIA -->
  <div class="form-section-title" style="grid-column: 1 / 3;">
    <i class="fa-solid fa-phone-flip"></i> 2. Contacto de Emergencia
  </div>

  <div class="one">
    <label for="contacto_emergencia_nombre" class="form-label">NOMBRE DE CONTACTO</label>
    <input type="text" id="contacto_emergencia_nombre" name="contacto_emergencia_nombre" class="form-control" required>

    <label for="contacto_emergencia_telefono" class="form-label">TELÉFONO DE CONTACTO</label>
    <input type="text" id="contacto_emergencia_telefono" name="contacto_emergencia_telefono" class="form-control" required>
  </div>

  <div class="two">
    <label for="contacto_emergencia_parentesco" class="form-label">PARENTESCO</label>
    <input type="text" id="contacto_emergencia_parentesco" name="contacto_emergencia_parentesco" class="form-control" required>
  </div>


  <!-- SECCIÓN 3: REGISTRO DE ATENCIÓN Y SIGNOS VITALES -->
  <div class="form-section-title" style="grid-column: 1 / 3;">
    <i class="fa-solid fa-notes-medical"></i> 3. Datos de Atención
  </div>

  <div class="one">
    <label for="fechaAtencion" class="form-label">FECHA DE ATENCIÓN</label>
    <input type="date" id="fechaAtencion" name="fechaAtencion" class="form-control" required>

    <label for="horaAtencion" class="form-label">HORA DE ATENCIÓN</label>
    <input type="time" id="horaAtencion" name="horaAtencion" class="form-control" required>
  </div>

  <div class="two">
    <label for="signosVitales" class="form-label">SIGNOS VITALES</label>
    <input list="datalistSignos" type="text" id="signosVitales" name="signosVitales" class="form-control" placeholder="PA, FC, FR, Temp, SpO2..." required>
    <datalist id="datalistSignos">
      <option value="">Temperatura corporal</option>
      <option value="">Saturación de oxígeno en sangre</option>
      <option value="">Color de piel</option>
      <option value="">Tono muscular</option>
      <option value="">Reflejos neurológicos</option>
      <option value="">Dolor</option>
    </datalist>
  </div>


  <!-- SECCIÓN 4: ANTECEDENTES Y PLAN CLÍNICO -->
  <div class="form-section-title" style="grid-column: 1 / 3;">
    <i class="fa-solid fa-file-waveform"></i> 4. Antecedentes Médicos y Plan de Tratamiento
  </div>

  <div class="one">
    <label for="medUsoHabitual" class="form-label">MEDICAMENTOS DE USO HABITUAL</label>
    <textarea class="form-control" name="medUsoHabitual" id="medUsoHabitual" rows="2" placeholder="Describa los medicamentos..."></textarea>

    <label for="antecFamiliares" class="form-label">ANTECEDENTES FAMILIARES</label>
    <textarea class="form-control" name="antecFamiliares" id="antecFamiliares" rows="2" placeholder="Describa patologías familiares..."></textarea>

    <label for="antecPatologicos" class="form-label">ANTECEDENTES PATOLÓGICOS PERSONALES</label>
    <textarea class="form-control" name="antecPatologicos" id="antecPatologicos" rows="2" placeholder="Enfermedades previas..."></textarea>
  </div>

  <div class="two">
    <label for="antecTrauma" class="form-label">ANTECEDENTES TRAUMÁTICOS</label>
    <textarea class="form-control" name="antecTrauma" id="antecTrauma" rows="2" placeholder="Traumas o accidentes..."></textarea>

    <label for="antecQuirurgicos" class="form-label">ANTECEDENTES QUIRÚRGICOS</label>
    <textarea class="form-control" name="antecQuirurgicos" id="antecQuirurgicos" rows="2" placeholder="Cirugías previas..."></textarea>

    <label for="planTratamiento" class="form-label">PLAN DE TRATAMIENTO</label>
    <textarea class="form-control" name="planTratamiento" id="planTratamiento" rows="2" placeholder="Indicaciones y medicamentos recetados..."></textarea>
  </div>


  <!-- PIE DE FORMULARIO CON BOTONES -->
  <div class="five" style="grid-column: 1 / 3; display: flex; gap: 10px; justify-content: flex-end; margin-top: 25px; border-top: 1px solid #e2e8f0; padding-top: 15px;">
    <button type="submit" class="btn" id="btnGuardar" data-bs-dismiss="offcanvas" aria-label="Close">Guardar</button>
    <button type="button" class="btn" id="btnEditar" style="display: none;" data-bs-dismiss="offcanvas" aria-label="Close">Guardar Cambios</button>
    <button type="button" id="btnCancelar" class="btn" data-bs-dismiss="offcanvas" aria-label="Close">Cancelar</button>
  </div>

      <!-- <div class="one">      
        <label for="nombre" class="form-label">NOMBRE</label>
        <input type="text" id="nombre" name="nombre" class="form-control" required>

        <label for="fecha_nacimiento" class="form-label">FECHA DE NACIMIENTO</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" required>

        <label for="edad" class="form-label">EDAD</label>
        <input type="text" id="edad" name="edad" class="form-control" required>

        <label for="doc_identidad" class="form-label">DOCUMENTO DE IDENTIDAD</label>
        <input type="text" id="doc_identidad" name="doc_identidad" class="form-control" required>

        <label for="telefonos" class="form-label">TELÉFONOS</label>
        <input type="text" id="telefonos" name="telefonos" class="form-control" required>

        <label for="contacto_emergencia_nombre" class="form-label">NOMBRE DE CONTACTO DE EMERGENCIA</label>
        <input type="text" id="contacto_emergencia_nombre" name="contacto_emergencia_nombre" class="form-control" required>

        <label for="contacto_emergencia_telefono" class="form-label">TELÉFONO DE CONTACTO DE EMERGENCIA</label>
        <input type="text" id="contacto_emergencia_telefono" name="contacto_emergencia_telefono" class="form-control" required>

        <label for="direcResidencial" class="form-label">DIRECCIÓN DE RESIDENCIA</label>
        <input type="text" id="direcResidencial" name="direcResidencial" class="form-control" required>
      </div>

      <div class="two">
        <label for="genero" class="form-label">GÉNERO</label>
        <input id="genero" list="listaGenero" name="genero" class="form-control"  placeholder="Seleccione o escriba genero" required>
        <datalist id="listaGenero">
          <option value="Femenino">
          <option value="Masculino">
        </datalist>

        <label for="ocupacion" class="form-label">OCUPACIÓN</label>
        <input type="text" id="ocupacion" name="ocupacion" class="form-control" required>

        <label for="correo" class="form-label">CORREO</label>
        <input type="text" id="correo" name="correo" class="form-control" required>

        <label for="contacto_emergencia_parentesco" class="form-label">PARENTESCO DE CONTACTO DE EMERGENCIA</label>
        <input type="text" id="contacto_emergencia_parentesco" name="contacto_emergencia_parentesco" class="form-control" required>

        <label for="sexoBiologico" class="form-label">SEXO BIOLÓGICO</label>
        <input type="text" id="sexoBiologico" name="sexoBiologico" class="form-control" required>

        <label for="medUsoHabitual" class="form-label">MEDICAMENTOS DE USO HABITUAL</label>
        <input class="form-control" name="medUsoHabitual" id="medUsoHabitual" rows="2" placeholder="Escribe aquí..."></input>

        <label for="antecFamiliares" class="form-label">ANTECEDENTES FAMILIARES</label>
        <input class="form-control" name="antecFamiliares" id="antecFamiliares" rows="2" placeholder="Escribe aquí..."></input>
        
        <label for="antecPatologicos" class="form-label">ANTECEDENTES PATOLÓGICOS PERSONALES</label>
        <input class="form-control" name="antecPatologicos" id="antecPatologicos" rows="2" placeholder="Escribe aquí..."></input>
      </div>

      <div class="tree">
        <label for="antecTrauma" class="form-label">ANTECEDENTES TRAUMÁTICOS</label>
        <input class="form-control" name="antecTrauma" id="antecTrauma" rows="2" placeholder="Escribe aquí..."></input>

        <label for="antecQuirurgicos" class="form-label">ANTECEDENTES QUIRÚRGICOS</label>
        <input class="form-control" name="antecQuirurgicos" id="antecQuirurgicos" rows="2" placeholder="Escribe aquí..."></input>

        <label for="fechaAtencion" class="form-label">FECHA DE ATENCIÓN</label>
        <input type="date" id="fechaAtencion" name="fechaAtencion" class="form-control" required>

        <label for="horaAtencion" class="form-label">HORA DE ATENCIÓN</label>
        <input type="time" id="horaAtencion" name="horaAtencion" class="form-control" required>
      </div>

      <div class="four">
        <label for="signosVitales" class="form-label">SIGNOS VITALES</label>
        <input type="text" id="signosVitales" name="signosVitales" class="form-control" required>

        <label for="planTratamiento" class="form-label">PLAN DE TRATAMIENTO</label>
        <input class="form-control" name="planTratamiento" id="planTratamiento" rows="2" placeholder="Escribe aquí..."></input>

        <label for="aseguradora" class="form-label">ASEGURADORA</label>
        <input type="text" id="aseguradora" name="aseguradora" class="form-control" required>
      </div> 

      <div class="five" style="grid-column: 1 / 3; display: flex; gap: 10px; justify-content: flex-end; margin-top: 10px;">
        <button type="submit" class="btn" id="btnGuardar" data-bs-dismiss="offcanvas" aria-label="Close">Guardar</button>
        <button type="button" class="btn" id="btnEditar" style="display: none;" data-bs-dismiss="offcanvas" aria-label="Close">Guardar Cambios</button>
        <button type="button" id="btnCancelar" class="btn" data-bs-dismiss="offcanvas" aria-label="Close">Cancelar</button>
      </div> -->

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