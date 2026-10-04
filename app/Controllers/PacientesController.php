<?php

    namespace App\Controllers;

    use App\Models\PacienteModel;

    class PacientesController extends Controller {

        protected $model;

        public function __construct() {
            session_start();
            $this->model = new PacienteModel();
        }

        public function index() {
           return $this->view('pacientes');
        }

        public function obtener_pacientes() {
            // Colocamos el código PHP para realizar la preparación de los datos de la tabla dinámica
            // Variables enviadas por jqGrid
            $page = $_POST['page'];
            $limit = $_POST['rows'];
            $sidx = $_POST['sidx'];
            $sord = $_POST['sord'];

            if (!$sidx) $sidx = 1;

            // Realizamos la petición al modelo para obtener y contar la cantidad de registros de la tabla clientes
            $registros = $this->model->all();
            $count = count($registros);

            // Formula para determinar la cantidad de páginas
            $total_pages = $count > 0 ? ceil($count/$limit) : 0;

            // Condición para verificar si no hay mas de 1 página
            if ($page > $total_pages) $page = $total_pages;
            $start = $limit * $page - $limit;
            if($start < 0) $start = 0;

            // Creamos un objeto utilizando el método stdClass89
            $responce = new \stdClass();

            // Agregamos las siguientes propiedades al objeto $responce
            // valores necesarios en el jqGrid
            $responce->page = $page;
            $responce->total = $total_pages;
            $responce->records = $count;

            // Preparamos los datos que se mostraran en la tabla dinamica
            $i = 0;
            foreach($registros as $cliente) {
                $responce->rows[$i]['id'] = $cliente['id'];
                $responce->rows[$i]['cell'] = 
                [$cliente['id'],
                $cliente['nombre'],
                $cliente['fecha_nacimiento'],
                $cliente['edad'], 
                $cliente['doc_identidad'], 
                $cliente['telefonos'], 
                $cliente['contacto_emergencia_nombre'], 
                $cliente['contacto_emergencia_telefono'], 
                $cliente['direcResidencial'],
                $cliente['genero'],
                $cliente['ocupacion'],
                $cliente['correo'],
                $cliente['contacto_emergencia_parentesco'],
                $cliente['sexoBiologico'],
                $cliente['medUsoHabitual'],
                $cliente['antecFamiliares'],
                $cliente['antecPatologicos'],
                $cliente['antecTrauma'],
                $cliente['antecQuirurgicos'],
                $cliente['fechaAtencion'],
                $cliente['horaAtencion'],
                $cliente['signosVitales'],
                $cliente['planTratamiento'],
                $cliente['aseguradora']
                ];
                $i++;
            }
            
            // Enviamos la respuesta en formato JSON
            echo json_encode($responce);
        }

        public function agregar() {
            $data = [
                'nombre' => $_POST['nombre'],
                'fecha_nacimiento' => $_POST['fecha_nacimiento'],
                'edad' => $_POST['edad'],
                'doc_identidad' => $_POST['doc_identidad'],
                'telefonos' => $_POST['telefonos'],
                'contacto_emergencia_nombre' => $_POST['contacto_emergencia_nombre'],
                'contacto_emergencia_telefono' => $_POST['contacto_emergencia_telefono'],
                'direcResidencial' => $_POST['direcResidencial'],
            ];

            $this->model->create($data);
        }

        public function editar() {

            $id = $_POST['id'];
            
            $data = [
                'nombre' => $_POST['nombre'],
                'fecha_nacimiento' => $_POST['fecha_nacimiento'],
                'edad' => $_POST['edad'],
                'doc_identidad' => $_POST['doc_identidad'],
                'telefonos' => $_POST['telefonos'],
                'contacto_emergencia_nombre' => $_POST['contacto_emergencia_nombre'],
                'contacto_emergencia_telefono' => $_POST['contacto_emergencia_telefono'],
                'direcResidencial' => $_POST['direcResidencial'],
                'genero' => $_POST['genero']
            ];

            $this->model->update($id,$data);
        }

        public function eliminar() {
            $id = $_POST['id'];

            $this->model->delete($id);

        }

        public function generar_pdf() {
    // Acepta id o numExpediente por parámetro GET
    $id = $_GET['id'] ?? $_GET['numExpediente'] ?? null;

    if (!$id) {
        die('Error: Número de expediente no especificado.');
    }

    // Intenta usar el método personalizado o la búsqueda estándar del modelo
    $p = method_exists($this->model, 'obtenerExpedienteCompleto') 
        ? $this->model->obtenerExpedienteCompleto($id) 
        : $this->model->find($id);

    if (!$p) {
        die('Error: Expediente no encontrado.');
    }

    // Helper para convertir codificación a ISO-8859-1 (FPDF no soporta UTF-8 directamente)
    $u = function($texto) {
        return mb_convert_encoding($texto ?? '', 'ISO-8859-1', 'UTF-8');
    };

    // Ruta a la librería FPDF
    require_once __DIR__ . '/../../lib/fpdf/fpdf.php';

    $pdf = new \FPDF('P', 'mm', 'Letter');
    $pdf->AddPage();
    $pdf->SetMargins(15, 15, 15);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->SetTextColor(30, 41, 59);
    $pdf->Cell(0, 8, $u('EXPEDIENTE CLÍNICO DEL PACIENTE'), 0, 1, 'C');
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetTextColor(100, 116, 139);
    $pdf->Cell(0, 4, $u('SISTEMA DE GESTIÓN CLÍNICA'), 0, 1, 'C');
    $pdf->Ln(4);
    $pdf->SetDrawColor(203, 213, 225);
    $pdf->Line(15, $pdf->GetY(), 201, $pdf->GetY());
    $pdf->Ln(6);

    $tituloSeccion = function($texto) use ($pdf, $u) {
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(241, 245, 249);
        $pdf->SetTextColor(15, 23, 42);
        $pdf->Cell(0, 6, $u('  ' . $texto), 0, 1, 'L', true);
        $pdf->Ln(2);
    };

    // 1. DATOS DE IDENTIFICACIÓN
    $tituloSeccion('1. DATOS DE IDENTIFICACIÓN Y ADMINISTRATIVOS');
    $pdf->SetFont('Arial', 'B', 8.5); $pdf->SetTextColor(71, 85, 105);
    $pdf->Cell(35, 5, $u('N° Expediente:'), 0, 0);
    $pdf->SetFont('Arial', '', 8.5); $pdf->SetTextColor(0);
    $pdf->Cell(55, 5, $u($p['id'] ?? $p['numExpediente'] ?? 'N/A'), 0, 0);
    
    $pdf->SetFont('Arial', 'B', 8.5); $pdf->SetTextColor(71, 85, 105);
    $pdf->Cell(35, 5, $u('Doc. Identidad:'), 0, 0);
    $pdf->SetFont('Arial', '', 8.5); $pdf->SetTextColor(0);
    $pdf->Cell(61, 5, $u($p['doc_identidad'] ?? 'N/A'), 0, 1);

    $pdf->SetFont('Arial', 'B', 8.5); $pdf->SetTextColor(71, 85, 105);
    $pdf->Cell(35, 5, $u('Nombre Completo:'), 0, 0);
    $pdf->SetFont('Arial', '', 8.5); $pdf->SetTextColor(0);
    $pdf->Cell(55, 5, $u($p['nombre'] ?? 'N/A'), 0, 0);

    $pdf->SetFont('Arial', 'B', 8.5); $pdf->SetTextColor(71, 85, 105);
    $pdf->Cell(35, 5, $u('F. Nacimiento / Edad:'), 0, 0);
    $pdf->SetFont('Arial', '', 8.5); $pdf->SetTextColor(0);
    $pdf->Cell(61, 5, $u(($p['fecha_nacimiento'] ?? 'N/A') . ' (' . ($p['edad'] ?? '-') . ' años)'), 0, 1);

    $pdf->SetFont('Arial', 'B', 8.5); $pdf->SetTextColor(71, 85, 105);
    $pdf->Cell(35, 5, $u('Género / Sexo Bio:'), 0, 0);
    $pdf->SetFont('Arial', '', 8.5); $pdf->SetTextColor(0);
    $pdf->Cell(55, 5, $u(($p['genero'] ?? 'N/A') . ' / ' . ($p['sexoBiologico'] ?? 'N/A')), 0, 0);

    $pdf->SetFont('Arial', 'B', 8.5); $pdf->SetTextColor(71, 85, 105);
    $pdf->Cell(35, 5, $u('Ocupación:'), 0, 0);
    $pdf->SetFont('Arial', '', 8.5); $pdf->SetTextColor(0);
    $pdf->Cell(61, 5, $u($p['ocupacion'] ?? 'N/A'), 0, 1);
    $pdf->Ln(3);

    // 2. CONTACTO Y EMERGENCIA
    $tituloSeccion('2. INFORMACIÓN DE CONTACTO Y EMERGENCIA');
    $pdf->SetFont('Arial', 'B', 8.5); $pdf->SetTextColor(71, 85, 105);
    $pdf->Cell(35, 5, $u('Dirección:'), 0, 0);
    $pdf->SetFont('Arial', '', 8.5); $pdf->SetTextColor(0);
    $pdf->Cell(151, 5, $u($p['direcResidencial'] ?? 'N/A'), 0, 1);

    $pdf->SetFont('Arial', 'B', 8.5); $pdf->SetTextColor(71, 85, 105);
    $pdf->Cell(35, 5, $u('Teléfono / Correo:'), 0, 0);
    $pdf->SetFont('Arial', '', 8.5); $pdf->SetTextColor(0);
    $pdf->Cell(151, 5, $u(($p['telefonos'] ?? 'N/A') . ' | ' . ($p['correo'] ?? 'N/A')), 0, 1);

    $pdf->SetFont('Arial', 'B', 8.5); $pdf->SetTextColor(71, 85, 105);
    $pdf->Cell(35, 5, $u('Contacto Emergencia:'), 0, 0);
    $pdf->SetFont('Arial', '', 8.5); $pdf->SetTextColor(0);
    $contactoStr = ($p['contacto_emergencia_nombre'] ?? 'N/A') . ' (' . ($p['contacto_emergencia_parentesco'] ?? '-') . ') - Tel: ' . ($p['contacto_emergencia_telefono'] ?? '-');
    $pdf->Cell(151, 5, $u($contactoStr), 0, 1);

    $pdf->SetFont('Arial', 'B', 8.5); $pdf->SetTextColor(71, 85, 105);
    $pdf->Cell(35, 5, $u('Aseguradora:'), 0, 0);
    $pdf->SetFont('Arial', '', 8.5); $pdf->SetTextColor(0);
    $pdf->Cell(151, 5, $u($p['aseguradora'] ?? 'N/A'), 0, 1);
    $pdf->Ln(3);

    // 3. ANTECEDENTES
    $tituloSeccion('3. ANTECEDENTES MÉDICOS (ANAMNESIS)');
    $pdf->SetFont('Arial', 'B', 8.5); $pdf->SetTextColor(71, 85, 105);
    $pdf->Cell(35, 5, $u('Antec. Patológicos:'), 0, 0);
    $pdf->SetFont('Arial', '', 8.5); $pdf->SetTextColor(0);
    $pdf->MultiCell(151, 5, $u($p['antecPatologicos'] ?? 'Ninguno'));

    $pdf->SetFont('Arial', 'B', 8.5); $pdf->SetTextColor(71, 85, 105);
    $pdf->Cell(35, 5, $u('Quirúrgicos / Trauma:'), 0, 0);
    $pdf->SetFont('Arial', '', 8.5); $pdf->SetTextColor(0);
    $pdf->MultiCell(151, 5, $u(($p['antecQuirurgicos'] ?? 'N/A') . ' / ' . ($p['antecTrauma'] ?? 'N/A')));

    $pdf->SetFont('Arial', 'B', 8.5); $pdf->SetTextColor(71, 85, 105);
    $pdf->Cell(35, 5, $u('Med. Uso Habitual:'), 0, 0);
    $pdf->SetFont('Arial', '', 8.5); $pdf->SetTextColor(0);
    $pdf->MultiCell(151, 5, $u($p['medUsoHabitual'] ?? 'Ninguno'));

    $pdf->SetFont('Arial', 'B', 8.5); $pdf->SetTextColor(71, 85, 105);
    $pdf->Cell(35, 5, $u('Antec. Familiares:'), 0, 0);
    $pdf->SetFont('Arial', '', 8.5); $pdf->SetTextColor(0);
    $pdf->MultiCell(151, 5, $u($p['antecFamiliares'] ?? 'Ninguno'));
    $pdf->Ln(3);

    // 4. CONSULTA ACTUAL
    $tituloSeccion('4. REGISTRO DE LA CONSULTA ACTUAL');
    $pdf->SetFont('Arial', 'B', 8.5); $pdf->SetTextColor(71, 85, 105);
    $pdf->Cell(35, 5, $u('Fecha / Hora:'), 0, 0);
    $pdf->SetFont('Arial', '', 8.5); $pdf->SetTextColor(0);
    $pdf->Cell(55, 5, $u(($p['fechaAtencion'] ?? date('Y-m-d')) . ' ' . ($p['horaAtencion'] ?? '')), 0, 0);

    $pdf->SetFont('Arial', 'B', 8.5); $pdf->SetTextColor(71, 85, 105);
    $pdf->Cell(35, 5, $u('Signos Vitales:'), 0, 0);
    $pdf->SetFont('Arial', '', 8.5); $pdf->SetTextColor(0);
    $pdf->Cell(61, 5, $u($p['signosVitales'] ?? 'N/A'), 0, 1);

    $pdf->SetFont('Arial', 'B', 8.5); $pdf->SetTextColor(71, 85, 105);
    $pdf->Cell(35, 5, $u('Diagnóstico:'), 0, 0);
    $pdf->SetFont('Arial', '', 8.5); $pdf->SetTextColor(0);
    $pdf->MultiCell(151, 5, $u($p['diagnostico'] ?? 'Pendiente'));

    $pdf->SetFont('Arial', 'B', 8.5); $pdf->SetTextColor(71, 85, 105);
    $pdf->Cell(35, 5, $u('Plan Tratamiento:'), 0, 0);
    $pdf->SetFont('Arial', '', 8.5); $pdf->SetTextColor(0);
    $pdf->MultiCell(151, 5, $u($p['planTratamiento'] ?? 'Sin indicación farmacológica'));

    // FIRMAS
    $pdf->Ln(15);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(93, 4, '________________________________________', 0, 0, 'C');
    $pdf->Cell(93, 4, '________________________________________', 0, 1, 'C');
    $pdf->Cell(93, 4, $u('Firma del Profesional: ' . ($p['fdProf'] ?? 'Médico Tratante')), 0, 0, 'C');
    $pdf->Cell(93, 4, $u('Sello / Registro: ' . ($p['selloProf'] ?? 'N/A')), 0, 1, 'C');

    // Limpia el búfer de salida para prevenir errores de PDF corrupto
    if (ob_get_length()) {
        ob_clean();
    }

    $pdf->Output('I', 'Expediente_' . ($p['id'] ?? $p['numExpediente'] ?? '0') . '.pdf');
    exit;
    
}

    }


    
