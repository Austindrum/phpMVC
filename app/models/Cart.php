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
    public function getCartItem(){
        $item = [];
        foreach($_SESSION['cart'] as $id){
            $this->db->query("SELECT * FROM items WHERE id = :id");
            $this->db->bind(":id", $id);
            array_push($item, $this->db->singleResultSet());
        }
        return $item;
    }
}