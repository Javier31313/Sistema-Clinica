<?php 

namespace App\Controllers;
use App\Models\PacienteModel;

class DashboardController extends Controller  {
    protected $model;

    public function __construct() {
        session_start(); //La sesion esta abierta, porque __construct es el primer metodo que se ejecuta
        $this->model = new PacienteModel;
    }
    

    public function index() {
        return $this->view('dashboard'); //Posteriormente se ejecuta la vista
    }

    public function pacientesTotales() {
        $sql = "SELECT COUNT(*) AS num FROM fich_paciente";
        $pacientes = $this->model->query($sql)->get();
        echo json_encode($pacientes);
    }
}