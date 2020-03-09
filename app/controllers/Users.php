<?php

class Users extends Controller
{
    public function __construct(){
        $this->userModel = $this->model('User');
    }
    public function login(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'email'=> trim($_POST['email']),
                'password'=> trim($_POST['password']),
                'email_err'=>'',
                'password_err'=>'',
            ];
            // Email Validate ===================================================
            if(empty($data['email'])){
                $data['email_err'] = "Please Enter Your Email";
            }elseif(!$this->userModel->isGetUserEmail($data['email'])){
                $data['email_err'] = "Email not found";
            };
            // Password Validate ===================================================
            if(empty($data['password'])){
                $data['password_err'] = "Please Enter Your password";
            }
            // User Info Validate Confirm===================================================
            if(empty($data['email_err']) && empty($data['password_err'])){
                $user = $this->userModel->login($data['email'],$data['password']);
                if($user){
                    flash("login_success", "Login Success");
                    $this->setLoginSession($user);
                    redirect('pages/index');
                }else{
                    $data['password_err'] = "Password Incorreact!";
                    $this->view('users/login', $data);
                }
            }else{
                $this->view('users/login', $data);
            }
        }else{
            $data = [
                'email'=>'',
                'password'=>'',
                'email_err'=>'',
                'password_err'=>''
            ];
            $this->view('users/login', $data);
        }
    }
    public function setLoginSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
    }
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        flash('logout_success', 'You are Logout', 'alert alert-danger');
        // session_destroy();
        redirect('users/login');
    }
    public function register(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'name'=> trim($_POST['name']),
                'email'=> trim($_POST['email']),
                'password'=> trim($_POST['password']),
                'confirm_password'=> trim($_POST['confirm_password']),
                'name_err'=> '',
                'email_err'=>'',
                'password_err'=>'',
                'confirm_password_err'=>''
            ];
            // Name Validate ===================================================
            if(empty($data['name'])){
                $data['name_err'] = "Please Enter Your Name";
            }
            // Email Validate ===================================================
            if(empty($data['email'])){
                $data['email_err'] = "Please Enter Your Email";
            }
            if($this->userModel->isGetUserEmail($data['email'])){
                $data['email_err'] = "Email has been Used";
            }
            // Password Validate ===================================================
            if(empty($data['password'])){
                $data['password_err'] = "Please Enter Your password";
            }
            if(strlen($data['password']) < 6){
                $data['password_err'] = "Password need over 6 char or num";
            }
            // Confirm password Validate  ===================================================
            if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = "Please Confirm Your password";
            }
            if($data['password'] !== $data['confirm_password']){
                $data['confirm_password_err'] = "Password not Confirm";
            }
            // User Info Validate Confirm===================================================
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['email_err'])){
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                if($this->userModel->register($data)){
                    flash("register_success", "Rgister Success! You can login Now!");
                    redirect('users/login');
                }else{
                    die("Error Happend");
                };
            }else{
                $this->view('users/register', $data);
            }
        }else{
            $data = [
                'name'=> '',
                'email'=>'',
                'password'=>'',
                'confirm_password'=>'',
                'name_err'=> '',
                'email_err'=>'',
                'password_err'=>'',
                'confirm_password_err'=>''
            ];
            $this->view('users/register', $data);
        }
    }
}