
<?php
    require_once '../conexion.php';
    require_once '../INTERFACES/iLogin.php';
    require_once '../DAO/loginDAO.php';

    class LoginService implements ILogin{
        private $loginDao;

        public function __construct($pdo) {
            $this->loginDao = new LoginDao($pdo);
        }

        public function login($usuario, $password) {
            return $this->loginDao->login($usuario, $password);
        }
    }

?>