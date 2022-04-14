<?php

session_start();

class Query

{

    protected $dbh;
  
    public function __construct()
    {
        $dsn = 'mysql:dbname=chat;host=localhost';
        $user = 'root';
        $password = '';
        try {
            $this->dbh = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
    }
    public function findUserById($user_id)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM `channels` WHERE `user_id`=? ");
        $stmt->execute([$user_id]);
        return$stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function getMessage($uid,$lastid)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM `messages` WHERE `uid`=? AND `id`>? ");
        $stmt->execute([$uid,$lastid]);
        return$stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
   
   

    public function Save($table,$data)
    {
        $update = '';
        $el = '';
        $fields = array_keys($data);
        $values = array_values($data);
        foreach ($fields as $field) {
            $update .= strtoupper($field) . ',';
            $el .= '?,';
        }
        $update = substr($update, 0, -1);
        $el = substr($el, 0, -1);
        $sth = $this->dbh->prepare("INSERT INTO {$table} (${update}) VALUES (${el})");
        $sth->execute($values);
        return true;
    }
    public function update($table,$data,$where)
    {
       
        $update = 'SET ';
            $fields = array_keys($data);
            $values = array_values($data);
            foreach ($fields as $field) {
                $update .= strtoupper($field) . '=?,';
            }
            $update = substr($update, 0, -1);
            $sth = $this->dbh->prepare("UPDATE {$table} ${update} where ${where}");
            $sth->execute($values);
            return true;
    }
    public function supprimer()
    {
        extract($_POST);
       for ($i=0; $i <count($cl_code) ; $i++) { 
        $this->removeUser($cl_code[$i]);
       }
       return true;
    }
    public function changeStatus()
    {
        extract($_POST);
       for ($i=0; $i <count($cl_code) ; $i++) {
           $data['status']=$status;
        $this->update('channels',$data,"id=".$cl_code[$i]);
       }
       return true;
    }
    
    public function removeUser($id)
    {
        $stmt = $this->dbh->prepare("DELETE from `DBUSER` WHERE CL_CODE=? ");
        $stmt->execute([$id]);
        return true;
    }
    public function generateRandomString($length = 7)
    {

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $charactersLength = strlen($characters);

        $randomString = '';

        for ($i = 0; $i < $length; $i++) {

            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
    public function middleware($verify=false)
    {
        if($verify){
          if (!isset($_SESSION['id']) && $_SESSION['id'] == "") {
              header('location:/');
          }
        }else{
            if (isset($_SESSION['id'])) {
                header('location:/dashbord.php');
            }
        }
    }
    public function connect($email)
  {
      $stmt = $this->dbh->prepare("SELECT * FROM `DBUSER` WHERE `CL_MAIL`=:email ");
      $stmt->execute(array('email' => $email));
      $data = $stmt->fetch(PDO::FETCH_ASSOC);
      return json_decode(json_encode($data));
  }
    public function baseUrl()
    {
        $base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
        $base_url .= "://" . $_SERVER['HTTP_HOST'] . '/';
        return $base_url;
    }
}
