<?php
require_once "helper/session_helper.php";
require_once "helper/url_helper.php";
require_once "config/config.php";

spl_autoload_register(function($classname){
    require_once 'libraries/'.$classname.'.php';
});