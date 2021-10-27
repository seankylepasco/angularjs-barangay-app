<?php
  class Auth {
    private $conn;
    private $table = 'users'; 
    public $id;
    public $name;
    public $email;
    public $password;

    public function __construct($db) {
      $this->conn = $db;
    }
    public function login() {
      $query = 'SELECT * FROM '.$this->table.' WHERE email = :email && password = :password ';
      $stmt = $this->conn->prepare($query);
      $this->email = htmlspecialchars(strip_tags($this->email));
      $this->password = htmlspecialchars(strip_tags($this->password));
      $stmt->bindParam(':email', $this->email);
      $stmt->bindParam(':password', $this->password);
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
      $stmt->bindParam(':name', $this->name);
      $stmt->bindParam(':email', $this->email);
      $stmt->bindParam(':password', $this->password);
      if($stmt->execute()){
        return true;
      }
      printf("Error: %s. \n", $stmt->error);
      return false;
    }
}