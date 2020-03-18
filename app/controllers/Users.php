<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

class Users extends Controller
{
    public function __construct(){
        $this->userModel = $this->model('User');
    }
    public function index($id = []){
        if(!isLogin()){
            flash("no_login", "You Should Login First!", "alert alert-danger");
            redirect('users/login');
        }else{
            $this->view('users/profile');   
        }
    }
    // public function dashbord(){
    //     if(!isLogin()){
    //         flash("no_login", "You Should Login First!", "alert alert-danger");
    //         redirect('users/login');
    //     }else{
    //         if($_SESSION['user_email'] !== 'austin@mail.com'){
    //             flash("no_admin", "You are not Admin", "alert alert-danger");
    //             redirect('users/profile');
    //         }else{
    //             $this->view('users/dashbord');
    //         }
    //     }
    // }
    public function login(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'email'=> trim($_POST['email']),
                'password'=> trim($_POST['password']),
                'email_err'=>'',
                'password_err'=>'',
            ];
            if(isset($_POST['remember'])){ $data['remember'] = $_POST['remember']; };
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
                    if(isset($data['remember'])){
                        setcookie('member_user', $data['email'], time()+3600);
                    }else{
                        setcookie('member_user', "", time()-3600);
                    }
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
                $result = $this->userModel->register($data);                 
                if($result['isSuccess']){
                    // $actual_link = "http://localhost/phpMVC/users/active/" . $result['mailActiveCode'];
                    // $toEmail = $data["email"];
                    // $subject = "User Registration Activation Email";
                    // $content = "Click this link to activate your account. <a href='" . $actual_link . "'>" . $actual_link . "</a>";
                    // $mailHeaders = "From: Admin\r\n";
                    // if(mail($toEmail, $subject, $content, $mailHeaders)) {
                    flash("register_success", "Registered! The activation mail is sent to your email. Click to activate you account.");
                    redirect('users/login');
                    // }else{
                    //     die("Error Happend");
                    // }   
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