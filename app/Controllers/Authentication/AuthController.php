<?php
require_once('app/Db/init.php');
class AuthController {

  public function login() {
    $matric = strtolower($_POST['matric']);
    $password = $_POST['password'];
    $login = DB::queryFirstRow("SELECT * FROM Student WHERE StudentMatric=%s", $matric);
    if(!$login) return 'incorrect matric number';
    if(password_verify($password, $login['Password'])) {
      if(!isset($_SESSION)) {
        session_start();
      }
      $_SESSION['matric'] = $login['StudentMatric'];
      $_SESSION['fname'] = $login['FirstName'];
      $_SESSION['lname'] = $login['LastName'];
      // $_SESSION['fname'] = $login['FirstName'];
      return true;
    }
    return 'incorrect password';
  }

  public function register() {
    $username = strtolower($_POST['username']);
    $username = preg_replace('/\s+/', '', $username);
    $password = $_POST['password'];
    $email = strtolower($_POST['email']);
    $exist_username = DB::queryFirstRow("SELECT * FROM users WHERE username=%s", $username);
    if($exist_username) return 'username exists';
    $exist_email = DB::queryFirstRow("SELECT * FROM users WHERE email=%s", $email);
    if($exist_email) return 'email exists';

    $register = DB::insert('users', array(
      'username' => $username,
      'email' => $email,
      'password' => password_hash($password, PASSWORD_BCRYPT),
    ));
    $id = DB::insertId();
    if($register) {
    if(!isset($_SESSION)) {
        session_start();
     }
      $_SESSION['jwt'] = $username;
      $_SESSION['userID'] = $id;
      return true;
    }else{
        return false;
    }
  }

  public function checklogin() {
    if(!isset($_SESSION)) {
      session_start();
    }
    if(!isset($_SESSION['matric'])){
      return false;
    }
    $matric = $_SESSION['matric'];
    $check = DB::queryFirstRow("SELECT * FROM Student WHERE StudentMatric=%s", $matric);
    if($check){
      return true;
    }
    return false;
  }

  public function logout() {
    if(!isset($_SESSION)) {
      session_start();
    }
    unset($_SESSION['matric']);
    unset($_SESSION['fname']);
    unset($_SESSION['lname']);
  }

}
