<?php

    namespace App\Controllers;

    use App\Models\HistorialModel;
    use App\Models\PacienteModel;

    class HistorialController extends Controller {
        protected $model;
        protected $modelPaciente;

        public function __construct() {
            session_start();
            $this->model = new HistorialModel();
            $this->modelPaciente = new PacienteModel();
        }
        
        public function index() {
            return $this->view('historial');
        }

        public function obtener_historial() {
             // Colocamos el código PHP para realizar la preparación de los datos de la tabla dinámica
            // Variables enviadas por jqGrid
            $page = $_POST['page'];
            $limit = $_POST['rows'];
            $sidx = $_POST['sidx'];
            $sord = $_POST['sord'];
            $id_paciente = isset($_POST['id_paciente']) ? $_POST['id_paciente'] : null;

            if($id_paciente) {
                $registros = $this->model->where('id_paciente', '=', $id_paciente)->get();
            } else {
                $registros = $this->model->all();
            }

            if (!$sidx) $sidx = 1;

            // Realizamos la petición al modelo para obtener y contar la cantidad de registros de la tabla de historiales médicos
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
            foreach($registros as $historial) {
                $responce->rows[$i]['id'] = $historial['id'];
                $responce->rows[$i]['cell'] = 
                [
                $historial['id'],
                $historial['FUR'],
                $historial['AHF'], 
                $historial['ANP'],
                $historial['habitos'], 
                $historial['alergias'], 
                $historial['labClinico'], 
                $historial['estudiosPrev'], 
                $historial['indicMedicas'], 
                $historial['recNoFarmacologicas'],
                $historial['histVisitas'],
                $historial['interconsultas'],
                $historial['imgDiagnosticas'],
                $historial['examFiscSeg'],
                $historial['APP'],
                $historial['HEA'],
                $historial['motivo'],
                $historial['antecGinecoObstetricos'],
                $historial['signosVitalesAct'],
                $historial['id_paciente']
                ];
                $i++;
            }
            
            // Enviamos la respuesta en formato JSON
            echo json_encode($responce);
        }

        public function agregar() {

            $data = [
                'FUR' => $_POST['FUR'],
                'AHF' => $_POST['AHF'],
                'ANP' => $_POST['ANP'],
                'habitos' => $_POST['habitos'],
                'alergias' => $_POST['alergias'],
                'labClinico' => $_POST['labClinico'],
                'estudiosPrev' => $_POST['estudiosPrev'],
                'indicMedicas' => $_POST['indicMedicas'],
                'recNoFarmacologicas' => $_POST['recNoFarmacologicas'],
                'histVisitas' => $_POST['histVisitas'],
                'interconsultas' => $_POST['interconsultas'],
                'imgDiagnosticas' => $_POST['imgDiagnosticas'],
                'examFiscSeg' => $_POST['examFiscSeg'],
                'APP' => $_POST['APP'],
                'HEA' => $_POST['HEA'],
                'motivo' => $_POST['motivo'],
                'antecGinecoObstetricos' => $_POST['antecGinecoObstetricos'],
                'signosVitalesAct' => $_POST['signosVitalesAct'],
                'id_paciente' => $_POST['id_paciente']
            ];

            $this->model->create($data);
        }

        public function editar() {
            $id = $_POST['id'];

            $data = [
                'FUR' => $_POST['FUR'],
                'AHF' => $_POST['AHF'],
                'ANP' => $_POST['ANP'],
                'habitos' => $_POST['habitos'],
                'alergias' => $_POST['alergias'],
                'labClinico' => $_POST['labClinico'],
                'estudiosPrev' => $_POST['estudiosPrev'],
                'indicMedicas' => $_POST['indicMedicas'],
                'recNoFarmacologicas' => $_POST['recNoFarmacologicas'],
                'histVisitas' => $_POST['histVisitas'],
                'interconsultas' => $_POST['interconsultas'],
                'imgDiagnosticas' => $_POST['imgDiagnosticas'],
                'examFiscSeg' => $_POST['examFiscSeg'],
                'APP' => $_POST['APP'],
                'HEA' => $_POST['HEA'],
                'motivo' => $_POST['motivo'],
                'antecGinecoObstetricos' => $_POST['antecGinecoObstetricos'],
                'signosVitalesAct' => $_POST['signosVitalesAct'],
            ];

            $this->model->update($id,$data);

        }

        public function eliminar() {
            $id = $_POST['id'];

            $this->model->delete($id);
        }

        public function nombrePaciente() {
            $sql = "SELECT nombre , id FROM fich_paciente";
            $nombrePaciente = $this->modelPaciente->query($sql)->get();
            echo json_encode($nombrePaciente);
        }

    public function generar_pdf() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            die('Error: ID de historial no especificado.');
        }

        $historial = $this->model->find($id);
        if (!$historial) {
            die('Error: Registro de historial no encontrado.');
        }

        $u = function($texto) {
            return mb_convert_encoding($texto ?? '', 'ISO-8859-1', 'UTF-8');
        };

        require_once __DIR__ . '/../../lib/fpdf/fpdf.php';

        $pdf = new \FPDF('P', 'mm', 'Letter');
        $pdf->AddPage();
        $pdf->SetMargins(15, 15, 15);
        
        // Encabezado
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->SetTextColor(30, 41, 59);
        $pdf->Cell(0, 8, $u('REPORTE DE HISTORIAL CLÍNICO Y EVOLUCIÓN'), 0, 1, 'C');
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

        // 1. MOTIVO Y ENFERMEDAD ACTUAL
        $tituloSeccion('1. MOTIVO DE CONSULTA Y PADECIMIENTO');
        $pdf->SetFont('Arial', 'B', 8.5); $pdf->SetTextColor(71, 85, 105);
        $pdf->Cell(35, 5, $u('Motivo:'), 0, 0);
        $pdf->SetFont('Arial', '', 8.5); $pdf->SetTextColor(0);
        $pdf->MultiCell(151, 5, $u($historial['motivo'] ?? 'N/A'));

        $pdf->SetFont('Arial', 'B', 8.5); $pdf->SetTextColor(71, 85, 105);
        $pdf->Cell(35, 5, $u('HEA (Enf. Actual):'), 0, 0);
        $pdf->SetFont('Arial', '', 8.5); $pdf->SetTextColor(0);
        $pdf->MultiCell(151, 5, $u($historial['HEA'] ?? 'N/A'));
        $pdf->Ln(3);

        // 2. SIGNOS VITALES Y EXÁMENES
        $tituloSeccion('2. SIGNOS VITALES Y LABORATORIOS');
        $pdf->SetFont('Arial', 'B', 8.5); $pdf->SetTextColor(71, 85, 105);
        $pdf->Cell(35, 5, $u('Signos Vitales Act.:'), 0, 0);
        $pdf->SetFont('Arial', '', 8.5); $pdf->SetTextColor(0);
        $pdf->Cell(55, 5, $u($historial['signosVitalesAct'] ?? 'N/A'), 0, 0);

        $pdf->SetFont('Arial', 'B', 8.5); $pdf->SetTextColor(71, 85, 105);
        $pdf->Cell(35, 5, $u('Alergias:'), 0, 0);
        $pdf->SetFont('Arial', '', 8.5); $pdf->SetTextColor(0);
        $pdf->Cell(61, 5, $u($historial['alergias'] ?? 'N/A'), 0, 1);
        $pdf->Ln(3);

        // 3. INDICACIONES Y TRATAMIENTO
        $tituloSeccion('3. PLAN E INDICACIONES MÉDICAS');
        $pdf->SetFont('Arial', 'B', 8.5); $pdf->SetTextColor(71, 85, 105);
        $pdf->Cell(35, 5, $u('Indicaciones:'), 0, 0);
        $pdf->SetFont('Arial', '', 8.5); $pdf->SetTextColor(0);
        $pdf->MultiCell(151, 5, $u($historial['indicMedicas'] ?? 'N/A'));

        $pdf->SetFont('Arial', 'B', 8.5); $pdf->SetTextColor(71, 85, 105);
        $pdf->Cell(35, 5, $u('Rec. No Farmaco.:'), 0, 0);
        $pdf->SetFont('Arial', '', 8.5); $pdf->SetTextColor(0);
        $pdf->MultiCell(151, 5, $u($historial['recNoFarmacologicas'] ?? 'N/A'));

        if (ob_get_length()) ob_clean();
        $pdf->Output('I', 'Historial_' . ($historial['id'] ?? '0') . '.pdf');
        exit;
    }

}
