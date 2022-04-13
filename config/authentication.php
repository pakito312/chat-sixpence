<?php

require_once 'Validation.php';
require_once 'request.php';


class Authentication
{
   
    private $email;
    private $password;
    protected $log = ["lb@hightof.com"];
    protected $pass = ["344556"];
    public $query;
    public function __construct()
    {
        $this->query = new Query();
        $this->query->middleware();
        $this->email = isset($_POST['email']) ? strip_tags($_POST['email']) : null;
        $this->password = isset($_POST['password']) ? strip_tags($_POST['password']) : null;
    }
    public function login()
    {
        if (isset($_POST["submit_login"])) {
            $val = new Validation();
            $val->name('email')->value($this->email)->required();
            $val->name('password')->value($this->password)->min(6)->required();
            if ($val->isSuccess()) {
                $user = $this->query->connect($this->email);
                
                if (in_array($this->email,$this->log) && in_array($this->password,$this->pass)) {
                    
                            $_SESSION['id'] = $this->email ;
                            $_SESSION['email'] = $this->email ;
                            
                            $reponsError['message'] = 'Connexion en cours, veuillez patienter...';
                            $reponsError['status'] = 'success';
                            $reponsError['redirectionLogin'] = $this->query->baseUrl()."dashboard.php";
                        
                } else {
                    $reponsError['message'] = 'Email ou mot de passe incorrect';
                    $reponsError['status'] = 'danger';
                }
            } else {
                $reponsError['message'] = 'Tous les champs sont requis';
                $reponsError['status'] = 'danger';
            }
            $reponsError['button'] = 'Fermer';
            return $reponsError;
        }
    }

}
