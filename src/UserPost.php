<?php

class UserPost{
    public static $pdo;
    public $id;
    public $login;
    public $useremail;
    public $phonenumber;
    public $userpassword;



    // get users
public static function getUsersAll(){
    $stmt = self::$pdo->prepare("SELECT * FROM usersdata ");
    $stmt -> setFetchMode(PDO::FETCH_CLASS, 'UserPost');
    $stmt->execute();
    $posts = $stmt->fetchAll();
    return $posts;
    
}

    // get user by id
    public static function getUser($id){
        $stmt = self::$pdo->prepare("SELECT * FROM usersdata WHERE id=?");
        // $stmt -> setFetchMode(PDO::FETCH_CLASS, 'UserPost');
        $stmt->execute([$id]);
        $post = $stmt->fetchAll();
        if($stmt->rowCount()){
            return $post;
        }else{
            echo "error: this user not found";
        }   
    }

    // check user 
    public static  function checkUser($login, $useremail, $phonenumber){
        $users=self::getUsersAll();
        foreach($users as $user){
            if($user->login===$login){
                return "$login login already exists";
            }
            elseif($user->useremail===$useremail){
                return "$useremail email already exists";
            }
            elseif($user->phonenumber==$phonenumber){
                return "$phonenumber phone number already exists";
            }

        }
        return "success";
    }
    
    // add user
    public static function addUser($login, $useremail, $phonenumber, $userpassword){
        $login = htmlspecialchars(strip_tags($login));
        $useremail = htmlspecialchars(strip_tags($useremail));
        $phonenumber = htmlspecialchars(strip_tags($phonenumber));
        $userpassword = htmlspecialchars(strip_tags($userpassword));

        if (filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
           $res=self::checkUser($login, $useremail, $phonenumber);
            if($res==="success"){
                $query=self::$pdo->prepare("INSERT INTO usersdata (login, useremail, phonenumber, userpassword) VALUES (:login, :useremail, :phonenumber, :userpassword)");
                $query->execute([
                    'login'=>$login,
                    'useremail'=>$useremail,
                    'phonenumber'=>$phonenumber,
                    'userpassword'=>$userpassword
        
                ]);
                if($query->execute()){
                    echo "success";
                }else{
                    echo "failed";
                }
            }else{
                echo $res;
            }

          } else {
            echo("$useremail is not a valid email address");
          }
    }

}