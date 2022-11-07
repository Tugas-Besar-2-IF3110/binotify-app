<?php

class User extends Controller {
    public function check_unique_username() {
        $username = $_GET['username'];
        $regex = '/^[a-zA-Z0-9_]+$/';
        if (preg_match($regex, $username)) {
            $user = $this->model('usermodel')->get_by_username($username);

            if ($user != null) { ?>red-border error-username-used<?php } 
            else { ?>green-border<?php }
        } else {
            ?>red-border error-username-regex<?php
        }
    }

    public function check_unique_email() {
        $email = $_GET['email'];
        $regex = '/^[a-zA-Z0-9.!#$%&’*+=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/';
        if (preg_match($regex, $email)) {
            $user = $this->model('usermodel')->get_by_email($email);
            if ($user != null) { ?>red-border error-email-used<?php } 
            else { ?>green-border<?php }
        } else {
            ?>red-border error-email-regex<?php
        }
    }

    public function get_user() {
        $data = $this->model('usermodel')->all_user();
        $this->view('user/get_user', $data);
    }
}

?>