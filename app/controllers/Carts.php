<?php
class Carts extends Controller
{
    public function __construct(){
        $this->cartModel = $this->model('Cart');
    }
    public function index(){
        $data = [
            'items'=> $this->cartModel->getAllItem(),
        ];
        $this->view('cart/index', $data);
    }
}