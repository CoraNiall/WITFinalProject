<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Login {
    public $id;
    public $username;
    public $email;
    public $password;
    public $role_id;
    public $active;
    
    public function __construct() {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role_id = $role;
        $this->active = $active;
    }
    
    //check if a given email already exists in the db
    public function emailExists(){
        $db = DB::getInstance();
        $req = $db->prepare("SELECT * from user WHERE email=? LIMIT 0,1");
        $this->email= htmlspecialchars(strip_tags($this->email));
        $req->bindParam(1, $this->email);
        $req->execute();
        //count the occurences of the same email in the db
        $num = $req->rowCount();
        //if email exists, assign values to object properties for easy access and use for php sessions
        if($num>0) {
            $row = $req->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->username = $row['username'];
            $this->email = $row['email'];
            $this->password = $row['password'];
            $this->role_id = $row['role_id'];
            //return true if email exists in db
            return TRUE;
        }
        else {
            //return false if email is not in db
            return false;
        }
        
    }


    public static function create() {
        $db = Db::getInstance();
        $req = $db->prepare("Insert into user(role_id, email, password, username, active) values (:role_id, :email, :password, :username, :active)");
        $req->bindParam(':role_id', $role);
        $req->bindParam(':email', $email);
        $req->bindParam (':password', $password);
        $req->bindParam (':username', $username);
        $req->bindParam (':active', $active);  
// set parameters and execute
    if(isset($_POST['email'])&& $_POST['email']!="")
    {$filteredEmail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);}
    if(isset($_POST['username'])&& $_POST['username']!="")
        {$filteredUsername = filter_input(INPUT_POST,'username', FILTER_SANITIZE_SPECIAL_CHARS);}
    if(isset($_POST['password'])&& $_POST['password']!="")
        {$filteredPassword = filter_input(INPUT_POST,'password', FILTER_SANITIZE_SPECIAL_CHARS);}
$email = $filteredEmail;
$username = $filteredUsername;
$password = $filteredPassword;
$role_id = '1'; //this is admin user, change to 2 for registered user
$active = '1'; //default boolean value means account is active
$req->execute();
    }
    
    public static function login() {
        if($_POST) {
            $db = Db::getInstance();
            $login = new Login ($db);
            //check if email and password are in the db
            $login->email = $_POST['email'];
            $email_exists->$login->emailExists();
            }
        if ($email_exists && password_verify($_POST['password'], $login->password) && $login->active==1){
            $_SESSION['logged_in'] = true;
            $_SESSION['id'] = $this->id;
            $_SESSION['role_id'] = $this->role_id;
            $_SESSION['username'] = htmlspecialchars($this->username, ENT_QUOTES, 'UTF-8');
            //if role id is admin then redirect to Admin page
            if($this->role_id=='admin') {
             require_once('views/pages/admin.php');   
            } else {
                require_once('views/pages/home.php');
            }
        } else {
            //if username does not exist or password is wrong
            echo "Username or password is incorrect. Please try again.";
        }
    }
    
    public static function logout($id) {
        session_destroy();
        require_once('views/pages/home.php');
    }
    
    public static function update($id) {
        $db = Db::getInstance();
        $req = $db->prepare("Update user set email=:email, password=:password, username=:username, active=:active where ID=:id");
        $req->bindParam(':email', $email);
        $req->bindParam (':password', $password);
        $req->bindParam (':username', $username);
        $req->bindParam (':active', $active);
    
// set parameters and execute
    if(isset($_POST['email'])&& $_POST['email']!=""){
        $filteredEmail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    }
    if(isset($_POST['username'])&& $_POST['username']!=""){
        $filteredUsername = filter_input(INPUT_POST,'username', FILTER_SANITIZE_SPECIAL_CHARS);
    }
    if(isset($_POST['password'])&& $_POST['password']!=""){
        $filteredPassword = filter_input(INPUT_POST,'password', FILTER_SANITIZE_SPECIAL_CHARS);
    }
$email = $filteredEmail;
$username = $filteredUsername;
$password = $filteredPassword;
$active = '1'; //default boolean value means account is active
$req->execute();
    }
    
    //maybe change the variable below to username rather than id
    public static function delete($id) {
        $db = Db::getInstance();
      //make sure $id is an integer
      $id = intval($id);
      $req = $db->prepare('delete FROM user WHERE ID = :id');
      // the query was prepared, now replace :id with the actual $id value
      $req->execute(array('id' => $id));
    }
}