<?php

class User {
  private $db;

  public function __construct() {
    $this->db = new Database();
  }

  public function register($data) {
    $this->db->query("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':password', $data['password']);

    if($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  
  public function findUserByEmail($email) {
    $this->db->query("SELECT * FROM users WHERE email = :email");
    $this->db->bind(':email', $email);
    $this->db->single();

    if($this->db->rowCount()) {
      return true;
    } else {
      return false;
    }
  }
}

?>