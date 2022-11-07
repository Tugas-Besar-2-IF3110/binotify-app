<?php

class Home extends Controller {
    public function index() {
        session_start();

        if (!empty($_SESSION['listen_timestamp'])) {
            if (time() - $_SESSION["listen_timestamp"] > 86400) {
                unset($_SESSION['listen_timestamp']);
                unset($_SESSION['listen_count']);
            }
        }
        if (empty($_SESSION['user_id'])) {
            if (!empty($_SESSION['listen_count'])) {
                $data['listen_count'] = $_SESSION['listen_count'];
            } else {
                $data['listen_count'] = 0;
            }
            $data['login'] = 0;
        } else {
            $data['listen_count'] = 0;
            $data['login'] = 1;
        }
        $data['song'] = $this->model('songmodel')->get_song_display_home();
        if (!empty($_SESSION['username'])) {
            $data['username'] = $_SESSION['username'];
        }
        if (isset($_GET['index'])) {
            $index = $_GET['index'];
            echo json_encode($data['song'][$index]);
        } else {
            $this->view('home/index', $data);
        }
    }
}
?>