<?php 

namespace App\Controllers;
use App\Models\PacienteModel;
use App\Models\CitasModel;

class DashboardController extends Controller  {
    protected $model;
    protected $modelCitas;

    public function __construct() {
        session_start(); //La sesion esta abierta, porque __construct es el primer metodo que se ejecuta
        $this->model = new PacienteModel;
        $this->modelCitas = new CitasModel;
    }
    

    public function index() {
        return $this->view('dashboard'); //Posteriormente se ejecuta la vista
    }

    public function pacientesTotales() {
        $sql = "SELECT COUNT(*) AS num FROM fich_paciente";
        $pacientes = $this->model->query($sql)->get();
        return $pacientes;
    }

    public function citasTotales() {
        $sql = "SELECT COUNT(*) AS numCita FROM citas";
        $citas = $this->modelCitas->query($sql)->get();
        return $citas;
    }
}