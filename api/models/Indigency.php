<?php
  class Indigency {
    private $conn;
    private $table='indigency'; 
    public $id;
    public $name;
    public $address;
    public $reason;
    public $created;


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
      $query = 'INSERT INTO '.$this->table.'(`name`, `address`, `reason`) VALUES (:name, :address, :reason)';
      $stmt = $this->conn->prepare($query);
      $this->name = htmlspecialchars(strip_tags($this->name));
      $this->address = htmlspecialchars(strip_tags($this->address));
      $this->reason = htmlspecialchars(strip_tags($this->reason));
      $stmt->bindParam(':name', $this->name);
      $stmt->bindParam(':reason', $this->reason);
      $stmt->bindParam(':address', $this->address);
      if($stmt->execute()){
        return true;
      }
      printf("Error: %s. \n", $stmt->error);
      return false;
    }

    public function update(){
      $query = 'UPDATE '.$this->table.' SET name = :name, address = :address, reason = :reason WHERE id = :id';
      $stmt = $this->conn->prepare($query);
      $this->name = htmlspecialchars(strip_tags($this->name));
      $this->address = htmlspecialchars(strip_tags($this->address));
      $this->reason = htmlspecialchars(strip_tags($this->reason));
      $this->id = htmlspecialchars(strip_tags($this->id));
      $stmt->bindParam(':name', $this->name);
      $stmt->bindParam(':address', $this->address);
      $stmt->bindParam(':reason', $this->reason);
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
        $query = 'SELECT * FROM '.$this->table.' WHERE name LIKE :name OR address LIKE :address OR reason LIKE :reason';
        $stmt = $this->conn->prepare($query);
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
        $stmt->bindParam(':name', $keywords);
        $stmt->bindParam(':reason', $keywords);
        $stmt->bindParam(':address', $keywords);
        $stmt->execute();
        return $stmt;
    }
}
?>
