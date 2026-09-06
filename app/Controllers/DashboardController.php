<?php 

namespace App\Controllers;


class DashboardController extends Controller  {

    public function __construct() {
        session_start(); //La sesion esta abierta, porque __construct es el primer metodo que se ejecuta
    }

    public function index() {
        return $this->view('dashboard'); //Posteriormente se ejecuta la vista
    }
}