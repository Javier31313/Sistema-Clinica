<?php

namespace App\Controllers;

use App\Models\UsuarioModel; //Para poder hacer uso de un modelo dentro de un controlador
use App\Models\Model;

class LoginController extends Controller{

    private $model;

    public function __construct() {
        $this->model = new UsuarioModel(); //este objeto se crea para traer el nombre de la tabla y poder usarlo en where.
    }

    public function index() {
       return $this->view('login');
    }

    public function verificar_credenciales() {
        $usuario = $_POST['usuario'];
        $pass = $_POST['password'];

        //$pass_encriptada = password_hash($pass, PASSWORD_DEFAULT);

        $du = $this->model->where('usuario', '=' , $usuario)->first();
        
        if($du) { //se pone solo ($du) dentro de if para ver si existe
            if(password_verify($pass, $du->password)) {
                //Creamos la sesion
                session_start();

                //Creamos las variables de sesion
                $_SESSION['user'] = $du->usuario;
                
                echo json_encode(['res' => true]);
            }else
                echo json_encode(['res'=>false, 'message' => 'Contraseña incorrecta']);
        }else
            echo json_encode(['res'=>false, 'message' => 'Usuario incorrecto']);

        //echo $usuario . "   " . $pass;
    }

    public function cerrar_sesion() {
        # Eliminamos la variable de sesion
        unset($_SESSION['user']);
        #Destruimos la sesion
        session_destroy();
        # Nos redirigimos a la pagina principal
        header('Location: /');
    }
}