<?php

namespace App\Controllers;

use App\Models\PersonalModel;

class PersonalController extends Controller
{
    private $personalModel;

    public function __construct()
    {  
        session_start();
        $this->personalModel = new PersonalModel();
    }

    public function index()
    {
        return $this->view('personal');
    }

    public function obtener_personal() {
        $registros = $this->personalModel->all();
        $count = count($registros);

        $responce = new \stdClass();
        $responce->page = 1;
        $responce->total = 1;
        $responce->records = $count;

        $i = 0;
        foreach ($registros as $personal) {
            $responce->rows[$i]['id'] = $personal['id_personal'];
            $responce->rows[$i]['cell'] = [
                $personal['id_personal'],
                $personal['nombre'],
                $personal['apellido'],
                $personal['especialidad'],
                $personal['telefono'],
                $personal['correo'],
                $personal['horario_atencion']
            ];
            $i++;
        }
        echo json_encode($responce);
    }

    public function agregar() {
        $data = [
            'nombre'           => $_POST['nombre'],
            'apellido'         => $_POST['apellido'],
            'especialidad'     => $_POST['especialidad'],
            'telefono'         => $_POST['telefono'],
            'correo'           => $_POST['correo'],
            'horario_atencion' => $_POST['horario_atencion'],
        ];

        $this->personalModel->create($data);
    }

    public function editar() {
        $id_personal = $_POST['id_personal'];

        $data = [
            'nombre'           => $_POST['nombre'],
            'apellido'         => $_POST['apellido'],
            'especialidad'     => $_POST['especialidad'],
            'telefono'         => $_POST['telefono'],
            'correo'           => $_POST['correo'],
            'horario_atencion' => $_POST['horario_atencion'],
        ];

        $this->personalModel->update($id_personal, $data);
    }

    public function eliminar() {
        $id = $_POST['id_personal'];

        $this->personalModel->delete($id);
    }

    public function generar_pdf() {
    $id = $_GET['id'] ?? null;
    if (!$id) {
        die('Error: ID de personal no especificado.');
    }

    // En lugar de usar find(), usamos where() para buscar por id_personal
    $registros = $this->personalModel->where('id_personal', '=', $id)->get();
    $personal = $registros[0] ?? null; // Obtenemos el primer registro del arreglo

    if (!$personal) {
        die('Error: Personal no encontrado.');
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
    $pdf->Cell(0, 8, $u('FICHA DE PERSONAL MÉDICO'), 0, 1, 'C');
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetTextColor(100, 116, 139);
    $pdf->Cell(0, 4, $u('SISTEMA DE GESTIÓN CLÍNICA'), 0, 1, 'C');
    $pdf->Ln(4);
    $pdf->SetDrawColor(203, 213, 225);
    $pdf->Line(15, $pdf->GetY(), 201, $pdf->GetY());
    $pdf->Ln(6);

    // Detalles del Personal
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(241, 245, 249);
    $pdf->SetTextColor(15, 23, 42);
    $pdf->Cell(0, 6, $u('  DETALLES DEL PERSONAL'), 0, 1, 'L', true);
    $pdf->Ln(3);

    $camposPersonal = [
        'ID de Personal' => $personal['id_personal'] ?? 'N/A',
        'Nombre'         => $personal['nombre'] ?? 'N/A',
        'Apellido'       => $personal['apellido'] ?? 'N/A',
        'Especialidad'   => $personal['especialidad'] ?? 'N/A',
        'Teléfono'       => $personal['telefono'] ?? 'N/A',
        'Correo'         => $personal['correo'] ?? 'N/A',
        'Horario'        => $personal['horario_atencion'] ?? 'N/A'
    ];

    foreach ($camposPersonal as $etiqueta => $valor) {
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetTextColor(71, 85, 105);
        $pdf->Cell(45, 6, $u($etiqueta . ':'), 0, 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetTextColor(0);
        $pdf->Cell(100, 6, $u($valor), 0, 1);
    }

    $pdf->Ln(15);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(0, 4, $u('Generado por el Sistema de Gestión Clínica.'), 0, 1, 'C');

    if (ob_get_length()) ob_clean();
    $pdf->Output('I', 'Personal_' . ($personal['id_personal'] ?? '0') . '.pdf');
    exit;
}
    
}
