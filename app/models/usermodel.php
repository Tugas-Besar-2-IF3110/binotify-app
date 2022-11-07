<?php

class usermodel {
    private $table = 'user';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    function all_user() {
        $this->db->query('SELECT * FROM user WHERE isAdmin = false');
        return $this->db->multiple();
    }

    public function get_by_username_and_password($username, $password) {
        $query = "SELECT * FROM user WHERE username = :username";

        $this->db->query($query);
        $this->db->bind('username', $username);
        
        $user = $this->db->single();

        if ($this->db->rowCount() == 1) {
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return null;
    }

    function insert($email, $password, $username, $nama) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO user (email, password, username, nama) VALUES ('$email', '$password', '$username', '$nama')";
        
        $this->db->query($query);
        $this->db->execute();
        
        if ($this->db->rowCount() == 1) {
            $query = "SELECT * FROM user WHERE username = :username";

            $this->db->query($query);
            $this->db->bind('username', $username);
            
            $user = $this->db->single();
            return $user;
        }

        return null;
    }

     function get_by_username($username) {
        $query = "SELECT * FROM user WHERE username = :username";

        $this->db->query($query);
        $this->db->bind('username', $username);
        
        $user = $this->db->single();

        if ($this->db->rowCount() == 1) {
            return $user;
        }
        return null;
    }

    function get_by_email($email) {
        $query = "SELECT * FROM user WHERE email = :email";

        $this->db->query($query);
        $this->db->bind('email', $email);
        
        $user = $this->db->single();

        if ($this->db->rowCount() == 1) {
            return $user;
        }
        return null;
    }
}

?>