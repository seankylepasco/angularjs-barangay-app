<?php
  class Auth {
    private $conn;
    private $table = 'users'; 
    public $id;
    public $name;
    public $email;
    public $password;
    public $img;

    public function __construct($db) {
      $this->conn = $db;
    }
    public function login() {
      $query = 'SELECT * FROM '.$this->table.' WHERE email = :email ';
      $stmt = $this->conn->prepare($query);
      $this->email = htmlspecialchars(strip_tags($this->email));
      $stmt->bindParam(':email', $this->email);
      if($stmt->execute()){
        return $stmt;
      }
      printf("Error: %s. \n", $stmt->error);
      return false;
    }

    public function register(){
      $query = 'INSERT INTO '.$this->table.'(`name`, `email`, `password`) VALUES (:name, :email, :password)';
      $stmt = $this->conn->prepare($query);
      $this->name = htmlspecialchars(strip_tags($this->name));
      $this->email = htmlspecialchars(strip_tags($this->email));
      $this->password = htmlspecialchars(strip_tags($this->password));
      // $this->img = htmlspecialchars(strip_tags($this->img));
      $stmt->bindParam(':name', $this->name);
      $stmt->bindParam(':email', $this->email);
      $stmt->bindParam(':password', $this->password);
      // $stmt->bindParam(':img', $this->img);
      if($stmt->execute()){
        return true;
      }
      printf("Error: %s. \n", $stmt->error);
      return false;
    }
}