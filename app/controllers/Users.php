<?php

class Users extends Controller {
  public function __construct() {
    $this->userModel = $this->model('User');
  }

  public function register() {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'name' => trim($_POST['name']),
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'confirm_password' => trim($_POST['confirm_password']),
        'name_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => ''
      ];

      if(empty($data['email'])) {
        $data['email_err'] = 'Please Enter Email';
      } elseif($this->userModel->findUserByEmail($data['email'])) {
        $data['email_err'] = 'Email is already existed';
      }

      if(empty($data['name'])) {
        $data['name_err'] = 'Please Enter Name';
      }

      if(empty($data['password'])) {
        $data['password_err'] = 'Please Enter Password';
      } elseif(strlen($data['password']) < 6) {
        $data['password_err'] = 'Password must be at least 6 characters';
      }

      if(empty($data['confirm_password'])) {
        $data['confirm_password_err'] = 'Please Enter Confirm Password';
      } elseif($data['password'] != $data['confirm_password']) {
        $data['confirm_password_err'] = 'Password must be match';
      }

      if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        if($this->userModel->register($data)) {
          flash('register_success', 'You are registered');
          redirect('users/login');
        }
      } else {
        $this->view('users/register', $data);
      }
    } else {
      $data = [
        'name' => '',
        'email' => '',
        'password' => '',
        'confirm_password' => '',
        'name_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => ''
      ];
    }
    $this->view('users/register', $data);
  }

  public function login() {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'email_err' => '',
        'password_err' => '',
      ];

      if(empty($data['email'])) {
        $data['email_err'] = 'Please Enter Email';
      }

      if(empty($data['password'])) {
        $data['password_err'] = 'Please Enter Password';
      } elseif(strlen($data['password']) < 6) {
        $data['password_err'] = 'Password must be at least 6 characters';
      }

      if($this->userModel->findUserByEmail($data['email'])) {

      } else {
        $data['email_err'] = 'No User';
      }

      if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
        $loggedInUser = $this->userModel->login($data['email'], $data['password']);
        if($loggedInUser) {
          die('Success');
        } else {
          $data['password_err'] = 'Password is not correct';
          $this->view('users/login', $data);
        }
      } else {
        $this->view('users/login', $data);
      }
    } else {
      $data = [
        'email' => '',
        'password' => '',
        'email_err' => '',
        'password_err' => '',
      ];
    }
    $this->view('users/login', $data);
  }
}
?>