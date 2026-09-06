<?php

    namespace App\Controllers;

    use App\Models\HistorialModel;

    class HistorialController extends Controller {
        protected $model;

        public function __construct() {
            session_start();
            $this->model = new HistorialModel();
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

            if (!$sidx) $sidx = 1;

            // Realizamos la petición al modelo para obtener y contar la cantidad de registros de la tabla de historiales médicos
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
            foreach($registros as $historial) {
                $responce->rows[$i]['id'] = $historial['id_historial'];
                $responce->rows[$i]['cell'] = 
                [$historial['FUR'], 
                $historial['AHF'], 
                $historial['ANP'],
                $historial['habitos'], 
                $historial['alergias'], 
                $historial['labClinico'], 
                $historial['estudiosPrev'], 
                $historial['indicMedicas'], 
                $historial['recNoFarmacologicas']
                ];
                $i++;
            }
            
            // Enviamos la respuesta en formato JSON
            echo json_encode($responce);
        }
    }
