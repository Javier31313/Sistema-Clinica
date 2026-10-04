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
    <link rel="stylesheet" href="/css/views/historial.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/views/app.css">


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
                <div>
                    <strong style="display: block; font-size: 0.9rem;"><?= $_SESSION['user'] ?></strong>
                    <span style="font-size: 0.75rem; color: var(--text-muted);">Medicina General</span>
                </div>
                <img class="imagen-avatar" src="img/blue_users_customers_clients_people_12438.png" alt="Avatar de usuario">
            </div>
    </header>

        <main class="p-4">
            <h1 class="h3 mb-4" style="color: #596070;">Historial Clínico</h1>

        <div class="divBtn">
            <button id="btnFormBoost" class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Agregar</button>
            <button id="btnFormBoostEditar" class="btn btn-primary" type="button">Editar</button>
            <button id="btnFormBoostEliminar" class="btn btn-primary" type="button" style="background: red">Eliminar</button>
            <select name="idSelect" id="idSelect">
                <option value="">Num de Expediente</option>
            </select>
        </div>

            <div class="card shadow-sm" style="background-color: #EAF1F1; border: none;">
            <div class="card-body">
                <table id="historial" class="table-info"></table>
                <div id="navhistorial"></div> <!-- Esto es la parte de abajo de la tabla-->
            </div>
            </div>
        </main> 
    
    </div>


<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">

    <h5 class="offcanvas-title" id="offcanvasRightLabel">SISTEMA CLINICA</h5>

    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <form id='formRegistro' class='form' method="POST">
      
      <input type="hidden" name="id_paciente" id="id_paciente_form">

      <label for="FUR" class="form-label">FECHA DE ULTIMA REGLA (FUR)</label> <br>
      <input type="date" id="FUR" name="FUR" class="form-control" required><br>

      <label for="AHF" class="form-label">ANTECEDENTES HEREDOFAMILIARES (AHF)</label><br>
      <input type="text" id="AHF" name="AHF" class="form-control" required><br>

      <label for="ANP" class="form-label">ANTECEDENTES NO PATOLÓGICOS (ANP)</label> <br>
      <input type="text" id="ANP" name="ANP" class="form-control" required><br>

      <label for="habitos" class="form-label">HABITOS</label> <br>
      <input type="text" id="habitos" name="habitos" class="form-control" required><br>

      <label for="alergias" class="form-label">ALERGIAS</label> <br>
      <input type="text" id="alergias" name="alergias" class="form-control" required><br>

      <label for="labClinico" class="form-label">LABORATORIO CLÍNICO</label><br>
      <input type="text" id="labClinico" name="labClinico" class="form-control" required><br>

      <label for="estudiosPrev" class="form-label">ESTUDIOS PREVIOS</label><br>
      <input type="text" id="estudiosPrev" name="estudiosPrev" class="form-control" required><br>

      <label for="indicMedicas" class="form-label">INDICACIONES MEDICAS</label> <br>
      <input type="text" id="indicMedicas" name="indicMedicas" class="form-control" required><br>

      <label for="recNoFarmacologicas" class="form-label">RECOMENDACIONES NO FARMACOLÓGICAS</label> <br>
      <input type="text" id="recNoFarmacologicas" name="recNoFarmacologicas" class="form-control" required><br>

      <label for="histVisitas" class="form-label">HISTORIAL DE VISITAS</label> <br>
      <input type="text" id="histVisitas" name="histVisitas" class="form-control" required><br>

      <label for="interconsultas" class="form-label">INTERCONSULTAS</label> <br>
      <input type="text" id="interconsultas" name="interconsultas" class="form-control" required><br>

      <label for="imgDiagnosticas" class="form-label">IMÁGENES DIAGNÓSTICAS</label> <br>
      <input type="text" id="imgDiagnosticas" name="imgDiagnosticas" class="form-control" required><br>

      <label for="examFiscSeg" class="form-label">EXAMEN FÍSICO SEGMENTARIO</label> <br>
      <input type="text" id="examFiscSeg" name="examFiscSeg" class="form-control" required><br>

      <label for="APP" class="form-label">ANTECEDENTES PATOLÓGICOS PERSONALES (APP)</label> <br>
      <input type="text" id="APP" name="APP" class="form-control" required><br>

      <label for="HEA" class="form-label">HISTORIAL DE LA ENFERMEDAD ACTUAL (HEA)</label> <br>
      <input type="text" id="HEA" name="HEA" class="form-control" required><br>

      <label for="motivo" class="form-label">MOTIVO DE CONSULTA</label> <br>
      <input type="text" id="motivo" name="motivo" class="form-control" required><br>

      <label for="antecGinecoObstetricos" class="form-label">ANTECEDENTES GINECO-OBSTÉTRICOS</label> <br>
      <input type="text" id="antecGinecoObstetricos" name="antecGinecoObstetricos" class="form-control" required><br>

      <label for="signosVitalesAct" class="form-label">SIGNOS VITALES ACTUALES</label> <br>
      <input type="text" id="signosVitalesAct" name="signosVitalesAct" class="form-control" required><br>

      <button type="submit" class="btn" id="btnGuardar" class="btn" data-bs-dismiss="offcanvas" aria-label="Close">Guardar</button>
      <button type="submit" class="btn" id="btnEditar" style="display: none;" class="btn" data-bs-dismiss="offcanvas" aria-label="Close">Editar</button>   
      <button type="button" id="btnCancelar" class="btn" data-bs-dismiss="offcanvas" aria-label="Close">Cancelar</button>
    </form>
  </div>
</div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/libs/jquery.min.js"></script>
    <script src="js/libs/grid.locale-es.js"></script>
    <script src="js/libs/jquery.jqgrid.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/views/app.js"></script>
    <script src="js/views/historial.js"></script>
</body>
</html>