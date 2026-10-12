<?php

namespace App\Controllers;

use App\Models\CitasModel;
use App\Models\ClienteModel; // Instanciamos el modelo de pacientes si lo usas con ese nombre

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
            'id_paciente'   => $_POST['id_paciente']
        ];

        $this->model->update($id, $data);
    }

    public function eliminar() {
        $id = $_POST['id'];

        $this->model->delete($id);
    }

}