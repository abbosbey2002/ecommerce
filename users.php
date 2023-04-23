<?php

include "config/bootstrap.php";


$resolve=UserPost::getUser(1);

// print_r($resolve[0]);
$login='Noilassss';
$useremail='noilsasss@gmail.com';
$phonenumber=9955455;
$userpassword='5ewf885fwef58wffwe8';

UserPost::addUser($login, $useremail, $phonenumber, $userpassword);

// var_dump($add);

