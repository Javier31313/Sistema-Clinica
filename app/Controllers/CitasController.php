<?php

namespace App\Controllers;

use App\Models\CitasModel;
use App\Models\PacienteModel; // Instanciamos el modelo de pacientes si lo usas con ese nombre

class CitasController extends Controller {

    protected $model;

    public function __construct() {
        session_start();
        $this->model = new CitasModel();
    }

    public function index() {
       return $this->view('citas');
    }
    
    public function obtener_citas() {
        $page = $_POST['page'] ?? 1;
        $limit = $_POST['rows'] ?? 10;
        $sidx = $_POST['sidx'] ?? 1;
        $sord = $_POST['sord'] ?? 'asc';

        if (!$sidx) $sidx = 1;

        $registros = $this->model->all();
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
            $responce->rows[$i]['id'] = $cita['id_cita']; 

            // En cell van SOLO los 6 datos que la tabla muestra en pantalla:
            $responce->rows[$i]['cell'] = [
                $cita['id'], // Columna 1: EXPEDIENTE
                $cita['fecha'],         // Columna 2: FECHA
                $cita['hora'],          // Columna 3: HORA
                $cita['especialista'],   // Columna 4: ESPECIALISTA
                $cita['consultorio'],    // Columna 5: CONSULTORIO
                $cita['modalidad']      // Columna 6: MODALIDAD
            ];
            $i++;
        }
        
        echo json_encode($responce);
    }

    public function agregar() {
        $data = [
            'id' => $_POST['id'],
            'fecha'        => $_POST['fecha'],
            'hora'         => $_POST['hora'],
            'especialista' => $_POST['especialista'],
            'consultorio'  => $_POST['consultorio'],
            'modalidad'    => $_POST['modalidad'],
        ];

        $this->model->create($data);
    }

   public function editar() {
        $id_cita = $_POST['id_cita'];

        $data = [
            'id' => $_POST['id'],
            'fecha'         => $_POST['fecha'],
            'hora'          => $_POST['hora'],
            'especialista'  => $_POST['especialista'],
            'consultorio'   => $_POST['consultorio'],
            'modalidad'     => $_POST['modalidad'],
        ];

        $this->model->update($id_cita, $data);
    }

    public function eliminar() {
        if (isset($_POST['id_cita'])) {
            $id = $_POST['id_cita'];
        } else {
            $id = $_POST['id'];
        }

        $this->model->delete($id);
    }

    public function obtener_pacientes() {
        $pacientesModel = new PacienteModel(); 
        $pacientes = $pacientesModel->all();
        
        echo json_encode($pacientes);
    }

}