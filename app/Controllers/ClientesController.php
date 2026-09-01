<?php


    namespace App\Controllers;

    use App\Models\ClienteModel;

    class ClientesController extends Controller{
        protected $model;

        public function __construct() {
            session_start();
            $this->model = new ClienteModel();
        }
    
        public function index(){
            return $this->view('clientes');
        }

        public function obtener_clientes() {
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
                $responce->rows[$i]['id'] = $cliente['numExpediente'];
                $responce->rows[$i]['cell'] = [$cliente['nombre'], $cliente['fecha_nacimiento'], $cliente['edad'], $cliente['doc_identidad'], $cliente['telefonos'], $cliente['contacto_emergencia_nombre'], $cliente['contacto_emergencia_telefono'], $cliente['direcResidencial']];
                $i++;
            }
            
            // Enviamos la respuesta en formato JSON
            echo json_encode($responce);
        }

    }


/*
namespace App\Controllers;

use App\Models\ClienteModel;

class ClientesController extends Controller { // extendemos a Controller para usar el método view()
    
    protected $model;

    public function __construct() {
        $this->model = new ClienteModel();
    }

    public function index() {
        return $this->view('clientes'); // el parametro que recibe view es la ruta o el nombre de el archivo clientes.php
    }

    public function index2() {
        return $this->view('clientesDashboard');
    }

    public function obtener_registros() {
        // $model2 = new ClienteModel();

        // return $model2->where('id',5)->first();
            

        //Este que hizo el profe funciona sin tener que YO desde AQUI escribir una consulta sql porque el metodo all ya la trae ya lo tiene definido, por eso cuando usas el metodo first no funciona porque no existe ninguna consulta sql A MENOS que la hagas desde aqui, como lo haces con tu prueba de arriba
        $registros = $this->model->create([
            'nombre_empresa' => 'GUCCI',
            'correo_empresarial' => 'GUCCI',
            'telefono_empresa' => '173498314789'
        ]);
        echo json_encode($registros);
    }
}  */