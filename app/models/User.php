<?php

class User
{
    private $db;
    
    public function __construct(){
        $this->db = new Database();
    }

    public function isGetUserEmail($email){
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);
        return !empty($this->db->singleResultSet()) ? true : false;
    }
    public function login($email, $password){
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(":email", $email);
        $user = $this->db->singleResultSet();
        if(password_verify($password, $user->password)){
            return $user;
        }else{
            return false;
        }
    }
    public function register($data){
        $this->db->query("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $result = [
            'isSuccess'=>$this->db->execute() ? true : false,
            'mailActiveCode'=>$this->db->getLastInsertId()
        ];
        return $result;
    }
}