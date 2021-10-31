<?php
  class Contact {
    private $conn;
    private $table='contacts'; 
    public $name;
    public $subject;
    public $email;
    public $mobile;
    public $message;

    public function __construct($db) {
      $this->conn = $db;
    }
    public function contact(){
      $query = 'INSERT INTO '.$this->table.'(`name`, `subject`, `email`, `mobile`, `message`) VALUES (:name, :subject, :email, :mobile, :message)';
      $stmt = $this->conn->prepare($query);
      $this->name = htmlspecialchars(strip_tags($this->name));
      $this->subject = htmlspecialchars(strip_tags($this->subject));
      $this->email = htmlspecialchars(strip_tags($this->email));
      $this->mobile = htmlspecialchars(strip_tags($this->mobile));
      $this->message = htmlspecialchars(strip_tags($this->message));
      $stmt->bindParam(':name', $this->name);
      $stmt->bindParam(':email', $this->email);
      $stmt->bindParam(':subject', $this->subject);
      $stmt->bindParam(':mobile', $this->mobile);
      $stmt->bindParam(':message', $this->message);
      if($stmt->execute()){
        return true;
      }
      printf("Error: %s. \n", $stmt->error);
      return false;
    }
}
?>