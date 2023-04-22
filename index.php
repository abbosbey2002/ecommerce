<?php


require_once "config/bootstrap.php";

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');



// get all products
if($_SERVER['REQUEST_METHOD'] === "GET" && !isset($_GET['id'])){
  $products=Post::getAll();
  print_r($products);
  echo json_encode($products->title);
  echo '</br> hi this mistake </br>';
}

// get one products
if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id'])){
  $product_id=$_GET['id'];
  $product=Post::getOne($product_id)[0];
  echo json_encode($product);
}

// Post products

if($_SERVER['REQUEST_METHOD'] == "POST"){

  $datajson = file_get_contents("php://input", true); 
  $data = json_decode($datajson); 
  
  // access the values of the properties
  $title = $data->title;
  $description = $data->description;
  $catagory = $data->catagory;
  $rate = $data->rate;
  $price = $data->price;
  $image = $data->image;
  

   $result=Post::postProduct($title,  $description, $catagory, $rate, $price, $image);
   if($result){
    echo "successfull add product";
   }else{
    echo 'something went wrong';
   }
  }

  // Delete product

  if($_SERVER['REQUEST_METHOD']==="DELETE"){
    $product_id=$_GET['id'];
    $result=Post::removeProduct($product_id, 'products');
    if($result===1){
      echo "successfull";
     }else{
      echo 'no products or error';
     }



    }


    //  update product

    if($_SERVER['REQUEST_METHOD']==="PUT"){
      echo 'hello world';

      $datajson = file_get_contents("php://input", true); 
  $data = json_decode($datajson); 
  var_dump($data);
  // access the values of the properties
  $id=$data->id;
  $title = $data->title;
  $description = $data->description;
  $catagory = $data->catagory;
  $rate = $data->rate;
  $price = $data->price;
  $image = $data->image;

  $result=Post::update($id, $title,  $description, $catagory, $rate, $price, $image);


  if($result) {
    echo json_encode(
      array('message' => 'product Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'product Not Updated')
    );
  }
    }
  