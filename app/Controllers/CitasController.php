<?php

namespace App\Controllers;

use App\Models\CitasModel;
use App\Models\PacienteModel;

class CitasController extends Controller {

    protected $model;
    protected $modelPaciente;

    public function __construct() {
        session_start();
        $this->model = new CitasModel();
        $this->modelPaciente = new PacienteModel();
    }

    public function index() {
       return $this->view('citas');
    }
    
    public function obtener_citas() {
        $page = $_POST['page'];
        $limit = $_POST['rows'];
        $sidx = $_POST['sidx'];
        $sord = $_POST['sord'];
        $id_paciente = isset($_POST['id_paciente']) ? $_POST['id_paciente'] : null;

        if($id_paciente) {
            $registros = $this->model->where('id_paciente', '=', $id_paciente)->get();
            
        }else {
            $registros = $this->model->all();
        }

        if (!$sidx) $sidx = 1;

        $count = count($registros);

        $total_pages = $count > 0 ? ceil($count/$limit) : 0;

        if ($page > $total_pages) $page = $total_pages;
        $start = $limit * $page - $limit;
        if($start < 0) $start = 0;

        $responce = new \stdClass();
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;

        $i = 0;
        foreach($registros as $cita) {
            // El ID va AQUÍ (esto es lo que jqGrid usa para saber la fila seleccionada idlast)
            $responce->rows[$i]['id'] = $cita['id']; 

            // En cell van SOLO los 6 datos que la tabla muestra en pantalla:
            $responce->rows[$i]['cell'] = [
                $cita['id'],
                $cita['fecha'],         // Columna 2: FECHA
                $cita['hora'],          // Columna 3: HORA
                $cita['especialista'],   // Columna 4: ESPECIALISTA
                $cita['consultorio'],    // Columna 5: CONSULTORIO
                $cita['modalidad'],    // Columna 6: MODALIDAD
                $cita['id_paciente']    
            ];
            $i++;
        }
        
        echo json_encode($responce);
    }

    public function agregar() {
        $data = [
            'fecha'        => $_POST['fecha'],
            'hora'         => $_POST['hora'],
            'especialista' => $_POST['especialista'],
            'consultorio'  => $_POST['consultorio'],
            'modalidad'    => $_POST['modalidad'],
            'id_paciente'  => $_POST['id_paciente'],
        ];

        $this->model->create($data);
    }

   public function editar() {
        $id = $_POST['id'];

        $data = [
            'fecha'         => $_POST['fecha'],
            'hora'          => $_POST['hora'],
            'especialista'  => $_POST['especialista'],
            'consultorio'   => $_POST['consultorio'],
            'modalidad'     => $_POST['modalidad'],
        ];

        $this->model->update($id, $data);
    }

    public function eliminar() {
        $id = $_POST['id'];

        $this->model->delete($id);
    }

    public function nombrePaciente() {
        $sql = "SELECT nombre, id FROM fich_paciente";
        $nombrePaciente = $this->modelPaciente->query($sql)->get();
        echo json_encode($nombrePaciente);
    }

        public function generar_pdf() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            die('Error: ID de cita no especificado.');
        }

        $cita = $this->model->find($id);
        if (!$cita) {
            die('Error: Cita no encontrada.');
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
        $pdf->Cell(0, 8, $u('COMPROBANTE DE CITA MÉDICA'), 0, 1, 'C');
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetTextColor(100, 116, 139);
        $pdf->Cell(0, 4, $u('SISTEMA DE GESTIÓN CLÍNICA'), 0, 1, 'C');
        $pdf->Ln(4);
        $pdf->SetDrawColor(203, 213, 225);
        $pdf->Line(15, $pdf->GetY(), 201, $pdf->GetY());
        $pdf->Ln(6);

        // Detalles de la Cita
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(241, 245, 249);
        $pdf->SetTextColor(15, 23, 42);
        $pdf->Cell(0, 6, $u('  DETALLES DE LA CITACIÓN'), 0, 1, 'L', true);
        $pdf->Ln(3);

        $camposCita = [
            'ID de Cita' => $cita['id'] ?? 'N/A',
            'Fecha programada' => $cita['fecha'] ?? 'N/A',
            'Hora' => $cita['hora'] ?? 'N/A',
            'Especialista' => $cita['especialista'] ?? 'N/A',
            'Consultorio' => $cita['consultorio'] ?? 'N/A',
            'Modalidad' => $cita['modalidad'] ?? 'N/A',
            'ID Paciente' => $cita['id_paciente'] ?? 'N/A'
        ];

        foreach ($camposCita as $etiqueta => $valor) {
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetTextColor(71, 85, 105);
            $pdf->Cell(45, 6, $u($etiqueta . ':'), 0, 0);
            $pdf->SetFont('Arial', '', 9);
            $pdf->SetTextColor(0);
            $pdf->Cell(100, 6, $u($valor), 0, 1);
        }

        $pdf->Ln(15);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(0, 4, $u('Por favor, preséntese 15 minutos antes de su cita.'), 0, 1, 'C');

        if (ob_get_length()) ob_clean();
        $pdf->Output('I', 'Cita_' . ($cita['id'] ?? '0') . '.pdf');
        exit;
    }
}