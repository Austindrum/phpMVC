<?php
session_start();

function flash($name = "", $message = "", $class="alert alert-success"){
    if(!empty($name)){
        if(!empty($message) && empty($_SESSION[$name])){
            if(!empty($_SESSION[$name])){
                nuset($_SESSION[$name]);
            }
            if(!empty($_SESSION[$name.'_class'])){
                nuset($_SESSION[$name.'_class']);
            }
            $_SESSION[$name] = $message;
            $_SESSION[$name.'_class'] = $class;
        }
        if(empty($message) && !empty($_SESSION[$name])){
            // $class = !empty($_SESSION[$name.'_class']) ? $_SESSION[$name.'_class'] : "";
            echo "<div class='".$_SESSION[$name.'_class']."' id='msg_flash'>".$_SESSION[$name]."</div>";
            unset($_SESSION[$name]);
            unset($_SESSION[$name.'_class']); 
        }
    }    
}
function isLogin(){
    if(isset($_SESSION['user_id'])){
        return true;
    }else{
        return false;
    }
}