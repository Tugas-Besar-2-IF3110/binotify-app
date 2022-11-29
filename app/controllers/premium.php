<?php 

class Premium extends Controller {
    public function singer_list() {
        session_start();
        
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => BINOTIFY_PREMIUM_API . "/user",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer " . API_KEY
            ],
        ]);
        $data["penyanyi"] = json_decode(curl_exec($curl), true);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $data["title"] = "Premium Singer List";
            
            $this->view('template/header', $data);
            $this->view('template/navbar', $data);
            $this->view('premium/singer_list', $data);
            $this->view('template/footer', $data);
        }
    }
}

?>