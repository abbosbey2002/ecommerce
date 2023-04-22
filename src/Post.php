<?php


class Post{
    public static $pdo;
    public $id;
    public $title;
    public $descripttion;
    public $catagory;
    public $rate;
    public $price;
    public $image;

    // get all product
    public static function getAll(){
        $stmt = self::$pdo->prepare("SELECT * FROM products");
        $stmt -> setFetchMode(PDO::FETCH_CLASS, 'POST');
        $stmt->execute();
        $posts = $stmt->fetchAll();
        return $posts;
        
    }

    // get one product
    public static function getOne($id){
        $stmt = self::$pdo->prepare("SELECT * FROM products WHERE id=?");
        $stmt -> setFetchMode(PDO::FETCH_CLASS, 'POST');
        $stmt->execute([$id]);
        $post = $stmt->fetchAll();
        return $post;
        
    }

    // POST PRODUCT
    public static function postProduct($title,  $description, $catagory, $rate, $price, $image){
        $title = htmlspecialchars(strip_tags($title));
        $description = htmlspecialchars(strip_tags($description));
        $catagory = htmlspecialchars(strip_tags($catagory));
        $rate = htmlspecialchars(strip_tags($rate));
        $price = htmlspecialchars(strip_tags($price));
        $image = htmlspecialchars(strip_tags($image));


        $query=self::$pdo->prepare("INSERT INTO products (title, description, catagory, rate, price, image) VALUES (:title, :description, :catagory, :rate, :price, :image)");
        $query->execute([
            'title'=>$title,
            'description'=>$description,
            'catagory'=>$catagory,
            'rate'=>$rate,  
            'price'=>$price,
            'image'=>$image

        ]);
        return 1;
    }

    // delete product
    public static function removeProduct($id, $table){
        $query = 'DELETE FROM ' . $table . ' WHERE id = :id';

        // Prepare statement
        $stmt = self::$pdo->prepare($query);

        // Clean data
        $id = htmlspecialchars(strip_tags($id));

        // Bind data
        $stmt->bindParam(':id', $id);


  
        // Execute query
        if($stmt->execute()) {
          return 1;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
  }

//   update product

public static function update($id, $title,  $description, $catagory, $rate, $price, $image) {
    // Create query
    $query = 'UPDATE ' . 'products' . '
                          SET title = :title, description = :description, catagory = :catagory, rate = :rate, price = :price, image = :image 
                          WHERE id = :id';

    // Prepare statement
    $stmt = self::$pdo->prepare($query);

    // Clean data
    $title = htmlspecialchars(strip_tags($title));
    $description = htmlspecialchars(strip_tags($description));
    $catagory = htmlspecialchars(strip_tags($catagory));
    $rate = htmlspecialchars(strip_tags($rate));
    $price= htmlspecialchars(strip_tags($price));
    $image = htmlspecialchars(strip_tags($image));

    // Bind data
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':catagory', $catagory);
    $stmt->bindParam(':rate', $rate);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':id', $id);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
}

}