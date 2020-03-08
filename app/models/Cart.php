<?php

class Cart
{
    public $db;
    public function __construct(){
        $this->db = new Database();
    }
    public function getAllItem(){
        $this->db->query("SELECT * FROM items");
        return $this->db->resultSet();
    }
}