<?php 

class Premium extends Controller {
    public function singer_list() {
        session_start();
        $data["title"] = "Premium Singer List";
        $this->view('template/header', $data);
        $this->view('template/navbar', $data);
        $this->view('premium/singer_list', $data);
        $this->view('template/footer', $data);
    }
}

?>