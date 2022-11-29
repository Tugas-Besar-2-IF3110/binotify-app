<?php 

class PremiumSong extends Controller {
    public function psong_list() {
        session_start();
        $data["title"] = "Premium Song List";
        $this->view('template/header', $data);
        $this->view('template/navbar', $data);
        $this->view('premium/premium_song_list', $data);
        $this->view('template/footer', $data);
    }

    public function index(){
        
    }
}

?>