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
    public function getItem($id){
        $this->db->query("SELECT * FROM items WHERE id = :id");
        $this->db->bind(":id", $id);
        $item = $this->db->singleResultSet();
        return $item;
    }
    public function getAllCategories(){
        $this->db->query("SELECT * FROM categories");
        $item = $this->db->resultSet();
        return $item;
    }
    public function getCartItem(){
        $item = [];
        if(isset($_SESSION['cart'])){
            foreach($_SESSION['cart'] as $id){
                $this->db->query("SELECT * FROM items WHERE id = :id");
                $this->db->bind(":id", $id);
                array_push($item, $this->db->singleResultSet());
            }
            return $item;
        }else{
            return $item;
        }
    }
    public function createItem($data){
        $this->db->query("SELECT id FROM categories WHERE categories = :category");
        $this->db->bind(':category', $data['category']);
        $cateId = $this->db->singleResultSet();
        $this->db->query('INSERT INTO items (name, price, content, category) VALUES (:name, :price, :content, :category)');
        $this->db->bind(':name', $data['itemName']);
        $this->db->bind(':price', $data['itemPrice']);
        $this->db->bind(':content', $data['itemContent']);
        $this->db->bind(':category', $cateId->id);
        $this->db->execute();
        $itemId = $this->db->getLastInsertId();
        foreach($data['itemImage'] as $image){
            $this->db->query("INSERT INTO itemimage (item_id, item_image) VALUES (:id, :image)");
            $this->db->bind(':id', $itemId);
            $this->db->bind(':image', $image);
            $this->db->execute();
        }
    }
}
