<?php

try {
    $dsn = "mysql:host=localhost:3307;dbname=db_school";
    $user = "school";
    $passwd = "school";

    $handler = new PDO($dsn, $user, $passwd);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    echo $e->getMessage();
    die();
}


$query = $handler->query('select * from users');
$result = $query->fetch(PDO::FETCH_ASSOC);

echo $result['firstname'];

$firstname = 'Allen';
$lastname = 'Moller';
$email = 'allan$mail.dk';
$username = 'allen';
$password = 'pass';


$sql = 'insert into users (firstname, lastname, email, username, password) values (:fname, :lname, :email, :username, :password)';
$query = $handler->prepare($sql);
$query->execute(
  array(
      ':fname' => $firstname,
      ':lname' => $lastname,
      ':email' => $email,
      ':username' => $username,
      ':password' => $password
  )
);
/**
 * Direct function to user class from database using PDO.
 */
$query = $handler->query('select * from users');
$query->setFetchMode(PDO::FETCH_CLASS, 'User');

$userObj = $query->fetch();

echo $userObj->getEmail();
echo $userObj->getName();

class User{

    public function __construct(){
    }

    public function getEmail(){
        return $this->email;
    }
    public function getName(){
        return $this->username;
    }
}

