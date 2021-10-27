<?php
  class Post {
    private $conn;
    private $table = 'residents'; 
    public $id;
    public $name;
    public $email;
    public $birthdate;
    public $address;
    public $voter_status;
    public $civil_status;
    public $gender;
    public $nickname;
    public $password;

    public function __construct($db) {
      $this->conn = $db;
    }
    public function read() {
      $query = 'SELECT * FROM '.$this->table.' WHERE 1';
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      return $stmt;
    }
    public function read_single() {
      $query = 'SELECT * FROM '.$this->table.' WHERE id = ? LIMIT 0,1';
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->id);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $this->id = $row['id'];
      $this->name = $row['name'];
      $this->email = $row['email'];
      $this->password = $row['password'];
    }
    public function create(){
      $query = 'INSERT INTO '.$this->table.'(`name`, `email`, `birthdate`, `address`, `gender`, `nickname`, `voter_status`, `civil_status`) VALUES (:name, :email, :birthdate, :address, :gender, :nickname, :voter_status, :civil_status)';
      $stmt = $this->conn->prepare($query);
      $this->name = htmlspecialchars(strip_tags($this->name));
      $this->email = htmlspecialchars(strip_tags($this->email));
      $this->birthdate = htmlspecialchars(strip_tags($this->birthdate));
      $this->address = htmlspecialchars(strip_tags($this->address));
      $this->nickname = htmlspecialchars(strip_tags($this->nickname));
      $this->gender = htmlspecialchars(strip_tags($this->gender));
      $this->voter_status = htmlspecialchars(strip_tags($this->voter_status));
      $this->civil_status = htmlspecialchars(strip_tags($this->civil_status));
      $stmt->bindParam(':name', $this->name);
      $stmt->bindParam(':email', $this->email);
      $stmt->bindParam(':birthdate', $this->birthdate);
      $stmt->bindParam(':nickname', $this->nickname);
      $stmt->bindParam(':gender', $this->gender);
      $stmt->bindParam(':address', $this->address);
       $stmt->bindParam(':voter_status', $this->voter_status);
       $stmt->bindParam(':civil_status', $this->civil_status);
      if($stmt->execute()){
        return true;
      }
      printf("Error: %s. \n", $stmt->error);
      return false;
    }
    public function update(){
      $query = 'UPDATE '.$this->table.' SET name = :name, email = :email, birthdate = :birthdate, address = :address, voter_status = :voter_status,
       civil_status = :civil_status, gender = :gender, nickname = :nickname WHERE id = :id';
      $stmt = $this->conn->prepare($query);
      $this->name = htmlspecialchars(strip_tags($this->name));
      $this->email = htmlspecialchars(strip_tags($this->email));
      $this->birthdate = htmlspecialchars(strip_tags($this->birthdate));
      $this->address = htmlspecialchars(strip_tags($this->address));
      $this->gender = htmlspecialchars(strip_tags($this->gender));
      $this->nickname = htmlspecialchars(strip_tags($this->nickname));
      $this->voter_status = htmlspecialchars(strip_tags($this->voter_status));
      $this->civil_status = htmlspecialchars(strip_tags($this->civil_status));
      $this->id = htmlspecialchars(strip_tags($this->id));
      $stmt->bindParam(':name', $this->name);
      $stmt->bindParam(':email', $this->email);
      $stmt->bindParam(':birthdate', $this->birthdate);
      $stmt->bindParam(':address', $this->address);
      $stmt->bindParam(':gender', $this->gender);
      $stmt->bindParam(':nickname', $this->nickname);
      $stmt->bindParam(':voter_status', $this->voter_status);
      $stmt->bindParam(':civil_status', $this->civil_status);
      $stmt->bindParam(':id', $this->id);
      if($stmt->execute()){
        return true;
      }
      printf("Error: %s. \n", $stmt->error);
      return false;
    }
    public function delete(){
      $query = 'DELETE FROM '.$this->table.' WHERE id = :id';
      $stmt = $this->conn->prepare($query);
      $this->id = htmlspecialchars(strip_tags($this->id));
      $stmt->bindParam(':id', $this->id);
      if($stmt->execute()){
        return true;
      }
      printf("Error: %s. \n", $stmt->error);
      return false;
    }
  function search($keywords){
    $query = 'SELECT * FROM '.$this->table.' WHERE name LIKE :name OR email LIKE :email OR address LIKE :address';
    $stmt = $this->conn->prepare($query);
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";
    $stmt->bindParam(':name', $keywords);
    $stmt->bindParam(':email', $keywords);
    $stmt->bindParam(':address', $keywords);
    $stmt->execute();
    return $stmt;
  }
}
?>
