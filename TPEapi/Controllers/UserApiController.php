<?php
    require_once("Controllers/apiController.php");
    require_once("helpers/AuthApiHelper.php");
    require_once("Models/UserModel.php");
    
    class UserApiController extends ApiController {
        private $model;
        private $authHelper;

        function __construct() {
            parent::__construct();
            $this->authHelper = new AuthHelper();
            $this->model = new UserModel();
        }

        function getToken($params = []) {
            $basic = $this->authHelper->getAuthHeaders(); 

            if(empty($basic)) {
                $this->view->response('No envió encabezados de autenticación.', 401);
                return;
            }

            $basic = explode(" ", $basic); // lo separa dejandolo como un arreglo con valores => ["Basic", "base64(usr:pass)"]

            if($basic[0]!="Basic") {
                $this->view->response('Los encabezados de autenticación son incorrectos.', 401);
                return;
            }

            $userpass = base64_decode($basic[1]);
            $userpass = explode(":", $userpass);

            $user = $userpass[0];
            $pass = $userpass[1];

            $userdata = $this->model->getByEmail($user);

            //llamar a la bd y verificar si los valores son correctos
            if($user == $userdata->email && password_verify($pass,$userdata->password)){
                // Usuario es válido
                $token = $this->authHelper->createToken($userdata);
                $this->view->response($token);
            } else {
                $this->view->response('El usuario o contraseña son incorrectos.', 401);
            }
        }

        
        
    }
