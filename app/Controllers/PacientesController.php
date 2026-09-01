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
                $responce->rows[$i]['cell'] = [$cliente['nombre'], $cliente['fecha_nacimiento'], $cliente['edad'], $cliente['doc_identidad'], $cliente['telefonos'], $cliente['contacto_emergencia_nombre'], $cliente['contacto_emergencia_telefono'], $cliente['direcResidencial'], $cliente['id']];
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

            header('Location: /pacientes');
            exit;
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
            ];

            $this->model->update($id,$data);
        }

        public function eliminar() {
            $id = $_POST['id'];

            $this->model->delete($id);

            header('Location: /pacientes');
            exit;
        }
    }