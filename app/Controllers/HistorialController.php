<?php

    namespace App\Controllers;

    use App\Models\HistorialModel;
    use App\Models\PacienteModel;

    class HistorialController extends Controller {
        protected $model;
        protected $modelPacientes;

        public function __construct() {
            session_start();
            $this->model = new HistorialModel();
            $this->modelPacientes = new PacienteModel;
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

            if (!$sidx) $sidx = 1;

            if($id_paciente) {
                $registros = $this->model->where('id_paciente', '=', $id_paciente)->get();
            }else {
                $registros = $this->model->all();
            }

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

        public function findId() {
            $sql = "SELECT id FROM fich_paciente";
            $idPacientes = $this->modelPacientes->query($sql)->get();
            echo json_encode($idPacientes);
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
    }
