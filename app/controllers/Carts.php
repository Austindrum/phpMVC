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
    public function cartItems(){
        $data = [];
        foreach($this->cartModel->getCartItem() as $item){
            array_push($data, $item);
        }
        $this->view('cart/cart', $data);
    }
    public function dellCart($id){
        foreach($_SESSION['cart'] as $key => $item){
            if($item === $id){
                unset($_SESSION['cart'][$key]);
            }
        }
        redirect('carts/cartItems');
    }
    public function addItemTocart($id){
        if(isset($_SESSION['cart'])){
            if(in_array($id, $_SESSION['cart'])){
                flash('item_has_been_add', 'This Item was Added Before!', 'alert alert-warning');
                redirect('carts/index');
            }else{
                $count = count($_SESSION['cart']);
                $_SESSION['cart'][$count] = $id;
                flash("add_item_success", "Item add TO cart success !!");
                redirect('carts/index');
            }
        }else{
            $_SESSION['cart'][0] = $id;
        }
    }
}