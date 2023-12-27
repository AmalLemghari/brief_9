<?php
class User {
    private $id;
    private $username;
    private $passwordHash;
    private $role;

    public function __construct($id, $username, $passwordHash, $role) {
        $this->id = $id;
        $this->username = $username;
        $this->passwordHash = $passwordHash;
        $this->role = $role;
    }

    // Méthodes pour accéder aux propriétés
    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getRole() {
        return $this->role;
    }
    
}
?>
