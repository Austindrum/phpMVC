<?php
class Carts extends Controller
{
    public function __construct(){
        $this->cartModel = $this->model('Cart');
    }
    public function index($id = []){
        if($id == []){
            $data = [
                'items'=> $this->cartModel->getAllItem(),
            ];
            $this->view('cart/index', $data);
        }else{
            $item = $this->cartModel->getItem($id);
            $data = [
                'name'=> $item->name,
                'price'=> $item->price,
                'image'=>$item->image,
                'content'=>$item->content
            ];
            $this->view('cart/item', $data);
        }
    }
    public function dashbord(){
        if(!isLogin()){
            flash("no_login", "You Should Login First!", "alert alert-danger");
            redirect('users/login');
        }else{
            if($_SESSION['user_email'] !== 'austin@mail.com'){
                flash("no_admin", "You are not Admin", "alert alert-danger");
                redirect('users/profile');
            }else{
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $data =[
                        'itemName' => trim($_POST['name']),
                        'itemPrice' => trim($_POST['price']),
                        'itemContent' => trim($_POST['content']),
                        'itemImage' => [],
                        'itemNameErr'=>'',
                        'itemPriceErr' => '',
                        'itemImageErr' => [],
                        'categories'=> [],
                        'category'=>$_POST['category'],
                        'categoriesErr'=> ''
                    ];
                    $categories = $this->cartModel->getAllCategories();
                    foreach($categories as $category){
                        array_push($data['categories'], $category->categories);                    
                    };
                    $files = $_FILES['image'];
                    //Handle file
                    if(!empty($files['name'][0])){;
                        $tempArray = array();
                        //create tempArray
                        foreach($files as $key => $file){
                            for ($i=0; $i < count($file); $i++) {
                                $tempArray[$i] = array(
                                    'name'=>'',
                                    'type'=>'',
                                    'tmp_Name'=>'',
                                    'error'=>'',
                                    'size'=>''
                                );
                            }
                            break;
                        }
                        //push temp file into tempArray
                        foreach($files as $key=>$file){
                            foreach($file as $num=>$value){
                                foreach($tempArray as $k => $temp){
                                    if($num == $k){
                                        $tempArray[$k][$key] = $value;
                                    };
                                }
                            }
                        };
                        //handle tempArray to $data['itemImage'] or $data['itemImageErr']
                        $num = 0;
                        foreach($tempArray as $file){
                            $fileName = $file['name'];
                            $fileTempName = $file['tmp_name'];
                            $fileSize = $file['size'];
                            $fileError = $file['error'];
                            $fileType = $file['type'];
                            $fileExt = explode('.', $fileName);
                            $fileActExt = strtolower(end($fileExt));
                            $allowed = array("jpg", "jpeg", "png");
                            if(in_array($fileActExt, $allowed)){
                                if($fileError === 0){
                                    if($fileSize < 1000000){
                                        $newFileName = $data['itemName']."_".$num.".".$fileActExt; 
                                        $newFileDest = "C:/xampp/htdocs/phpMVC/public/upload/".$newFileName;
                                        move_uploaded_file($fileTempName, $newFileDest);
                                        array_push($data['itemImage'], "upload/".$newFileName);
                                        array_push($data['itemImageErr'], null);
                                        echo $newFileName;
                                        $num++;
                                    }else{
                                        array_push($data['itemImage'], $fileName);
                                        array_push($data['itemImageErr'], 'FIle was Too Big');    
                                    }
                                }else{
                                    array_push($data['itemImage'], $fileName);
                                    array_push($data['itemImageErr'], 'Sometnig Wrong');
                                }
                            }else{
                                array_push($data['itemImage'], $fileName);
                                array_push($data['itemImageErr'], 'FIle Type Need jpg, jpeg, png');
                            }
                        }
                    }
                    if(empty($data['itemName'])){
                        $data['itemNameErr'] = "Please Enter Item Name";
                    }
                    if(empty($data['itemPrice'])){
                        $data['itemPriceErr'] = "Please Enter Item Price";
                    }
                    if(empty($data['category'])){
                        $data['categoriesErr'] = "Please Select Category";
                    }
                    if( empty($data['itemNameErr']) && empty($data['itemPriceErr']) && empty($data['itemImageErr'] && $data['categoriesErr'])){
                        $this->cartModel->createItem($data);
                    }else{
                        $this->view('cart/dashbord', $data);
                    }
                }else{
                    $data =[
                        'itemName' => '',
                        'itemPrice' => '',
                        'itemContent' => '',
                        'itemImage' => [],
                        'itemNameErr'=>'',
                        'itemPriceErr' => '',
                        'itemImageErr' => [],
                        'categories'=> []
                    ];
                    $categories = $this->cartModel->getAllCategories();
                    foreach($categories as $category){
                        array_push($data['categories'], $category->categories);                    
                    };
                    $this->view('cart/dashbord', $data);
                }
            }
        }
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
        flash('item_remove', 'Remove Item success!');
        redirect('carts/cartItems');
    }
    public function addItem(){
        if(isLogin()){
                if($_SESSION['user_email'] == "austin@mail.com"){
                // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    $data =[
                        'itemName' => trim($_POST['name']),
                        'itemPrice' => trim($_POST['price']),
                        'itemContent' => trim($_POST['content']),
                        'itemImage' => [],
                        'itemNameErr'=>'',
                        'itemPriceErr' => '',
                        'itemImageErr' => [],
                    ];
                    $files = $_FILES['image'];
                    //Handle file
                    if(!empty($files['name'][0])){;
                        $tempArray = array();
                        //create tempArray
                        foreach($files as $key => $file){
                            for ($i=0; $i < count($file); $i++) {
                                $tempArray[$i] = array(
                                    'name'=>'',
                                    'type'=>'',
                                    'tmp_Name'=>'',
                                    'error'=>'',
                                    'size'=>''
                                );
                            }
                            break;
                        }
                        //push temp file into tempArray
                        foreach($files as $key=>$file){
                            foreach($file as $num=>$value){
                                foreach($tempArray as $k => $temp){
                                    if($num == $k){
                                        $tempArray[$k][$key] = $value;
                                    };
                                }
                            }
                        };
                        //handle tempArray to $data['itemImage'] or $data['itemImageErr']
                        foreach($tempArray as $file){
                            $fileName = $file['name'];
                            $fileTempName = $file['tmp_name'];
                            $fileSize = $file['size'];
                            $fileError = $file['error'];
                            $fileType = $file['type'];
                            $fileExt = explode('.', $fileName);
                            $fileActExt = strtolower(end($fileExt));
                            $allowed = array("jpg", "jpeg", "png");
                            if(in_array($fileActExt, $allowed)){
                                if($fileError === 0){
                                    if($fileSize < 1000000){
                                        $newFileName = $data['itemName'].".".$fileActExt; 
                                        // $newFileDest = "C:/xampp/htdocs/phpMVC/public/upload/".$newFileName;
                                        // move_uploaded_file($fileTempName, $newFileDest);
                                        array_push($data['itemImage'], $newFileName);
                                        array_push($data['itemImageErr'], null);
                                    }else{
                                        array_push($data['itemImage'], $fileName);
                                        array_push($data['itemImageErr'], 'FIle was Too Big');    
                                    }
                                }else{
                                    array_push($data['itemImage'], $fileName);
                                    array_push($data['itemImageErr'], 'Sometnig Wrong');
                                }
                            }else{
                                array_push($data['itemImage'], $fileName);
                                array_push($data['itemImageErr'], 'FIle Type Need jpg, jpeg, png');
                            }
                        }
                    }
                    if(empty($data['itemName'])){
                        $data['itemNameErr'] = "Please Enter Item Name";
                    }
                    if(empty($data['itemPrice'])){
                        $data['itemPriceErr'] = "Please Enter Item Price";
                    }
                    if( empty($data['itemNameErr']) && empty($data['itemPriceErr']) && empty($data['itemImageErr'])){
                        echo "Good";
                    }else{
                        $this->view('cart/dashbord', $data);
                    }
                }
        }else{
            flash('item_remove', 'Remove Item success!');
            redirect('carts/cartItems');
        }
        $data =[
            'itemName' => '',
            'itemPrice' => '',
            'itemContent' => '',
            'itemImage' => [],
            'itemNameErr'=>'',
            'itemPriceErr' => '',
            'itemImageErr' => [],
        ];
        $this->view('cart/dashbord', $data);
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
    public function account(){
        if(!isLogin()){
            flash("no_login", "You Should Login First!", "alert alert-danger");
            redirect('users/login');
        }else{
            if(count($_SESSION['cart']) > 0){
                $data["items"] = [];
                $data["total"] =  0;
                $total = 0;
                $items = $this->cartModel->getAllItem();
                foreach($items as $item){
                    foreach($_SESSION['cart'] as $itemId){
                        if($item->id == $itemId){
                            foreach($_POST as $key=>$value){
                                if($key == $item->id){
                                    array_push($data['items'], ['id'=>$item->id, 'name'=>$item->name, 'price'=>$item->price, 'num'=>$value]);
                                }
                            }
                        }
                    }
                }
                foreach($data['items'] as $item){
                    $data['total'] += $item['price'] * $item['num'];
                }
                $this->view('cart/account', $data);
            }else{
                flash("empty_cart", "You Should Add Some item!", "alert alert-danger");
                redirect('carts/cartItems');
            }
        }
    }
}