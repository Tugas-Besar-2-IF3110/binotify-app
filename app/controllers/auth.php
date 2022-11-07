<?php


class Auth extends Controller {
    public function index() {
        header('Location: auth/login');
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // The request is using the POST method
            session_start();
            
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
            
                $data["title"] = "Login";
                if (empty($username)) {
                    $data['error'] = 'Username is required';

                    $this->view('template/header', $data);
                    $this->view('template/navbar', $data);
                    $this->view('auth/login', $data);
                    $this->view('template/footer', $data);

                } else if (empty($password)) {
                    $data['error'] = 'Password is required';

                    $this->view('template/header', $data);
                    $this->view('template/navbar', $data);
                    $this->view('auth/login', $data);
                    $this->view('template/footer', $data);

                } else {
                    $user = $this->model('usermodel')->get_by_username_and_password($username, $password);
                    if ($user != null) {
                        $_SESSION['user_id'] = $user['user_id'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['isAdmin'] = $user['isAdmin'];
                        header("Location: ".BASE_PUBLIC_URL);
                    } else {
                        $data['error'] = 'Invalid username or password';

                        $this->view('template/header', $data);
                        $this->view('template/navbar', $data);
                        $this->view('auth/login', $data);
                        $this->view('template/footer', $data);

                    }
                }
            } 
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data["title"] = "Login";

            $this->view('template/header', $data);
            $this->view('template/navbar', $data);
            $this->view('auth/login', $data);
            $this->view('template/footer', $data);
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // The request is using the POST method
            session_start();

            if (isset($_POST['nama']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm-password'])) {
                $nama = $_POST['nama'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $confirm_password = $_POST['confirm-password'];

                $data["title"] = "Registration";
                if (empty($nama)) {
                    $data['error'] = 'Nama is required';

                    $this->view('template/header', $data);
                    $this->view('template/navbar', $data);
                    $this->view('auth/register', $data);
                    $this->view('template/footer', $data);

                } else if (empty($username)) {
                    $data['error'] = 'Username is required';

                    $this->view('template/header', $data);
                    $this->view('template/navbar', $data);
                    $this->view('auth/register', $data);
                    $this->view('template/footer', $data);

                } else if (empty($email)) {
                    $data['error'] = 'Email is required';

                    $this->view('template/header', $data);
                    $this->view('template/navbar', $data);
                    $this->view('auth/register', $data);
                    $this->view('template/footer', $data);

                } else if (empty($password)) {
                    $data['error'] = 'Password is required';

                    $this->view('template/header', $data);
                    $this->view('template/navbar', $data);
                    $this->view('auth/register', $data);
                    $this->view('template/footer', $data);
                    
                } else {
                    if ($password == $confirm_password) {
                        $user_register = $this->model('usermodel')->insert($email, $password, $username, $nama);

                        if ($user_register != null) {
                            $_SESSION['user_id'] = $user_register['user_id'];
                            $_SESSION['username'] = $user_register['username'];
                            $_SESSION['isAdmin'] = $user_register['isAdmin'];
                            header("Location: ".BASE_PUBLIC_URL);

                        } else {
                            $data['error'] = 'Registrasi gagal. Silahkan coba lagi';

                            $this->view('template/header', $data);
                            $this->view('template/navbar', $data);
                            $this->view('auth/register', $data);
                            $this->view('template/footer', $data);
                        }
                    } else {
                        $data['error'] = 'Password yang dimasukkan tidak sama';

                        $this->view('template/header', $data);
                        $this->view('template/navbar', $data);
                        $this->view('auth/register', $data);
                        $this->view('template/footer', $data);
                    }
                }
            } else {
                if (isset($_GET['username'])) {
                    $regex = '/^[a-zA-Z0-9_]+$/';
                    if (preg_match($regex, $_GET['username'])) {
                        $username = $_GET['username'];
                        $user = $this->model('usermodel')->get_by_username($username);

                        if ($user == null) { ?>red-border error-username-used<?php } 
                        else { ?>green-border<?php }
                    } else {
                        ?>red-border error-username-regex<?php
                    }
                } else if (isset($_GET['email'])) {
                    $regex = '/^[a-zA-Z0-9.!#$%&’*+=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/';
                    if (preg_match($regex, $_GET['email'])) {
                        $email = $_GET['email'];

                        $user = $this->model('usermodel')->get_by_email($email);
                        if ($user != null) { ?>red-border error-email-used<?php } 
                        else { ?>green-border<?php }
                    } else {
                        ?>red-border error-email-regex<?php
                    }
                }
            }

       } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data['title'] = 'Registration';

            $this->view('template/header', $data);
            $this->view('template/navbar', $data);
            $this->view('auth/register', $data);
            $this->view('template/footer', $data);
       }
    }

    public function logout() {
        session_start();
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['isAdmin']);
        header("Location: ". BASE_PUBLIC_URL);
    }
}
?>