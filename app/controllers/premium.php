<?php 

class Premium extends Controller {
    public function singer_list() {
        session_start();
        if (isset($_SESSION['user_id']) && $_SESSION['isAdmin'] == 0) {
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
            $penyanyi_data = json_decode(curl_exec($curl), true);
            $err = curl_error($curl);
            curl_close($curl);
            
            $subscription = $this->model('subscriptionmodel')->get_subscription_by_subscriber_id($_SESSION['user_id']);
            $data["penyanyi"] = [];
            foreach ($penyanyi_data as $penyanyi) {
                foreach ($subscription as $sub) {
                    if (intval($sub["creator_id"]) == $penyanyi["user_id"]) {
                        if ($sub["status"] == 'PENDING') {
                            $penyanyi["status"] = "PENDING";
                            break;
                        } else if ($sub["status"] == 'ACCEPTED') {
                            $penyanyi["status"] = "ACCEPTED";
                            break;
                        } else if ($sub["status"] == "REJECTED") {
                            $penyanyi["status"] = "REJECTED";
                            break;
                        }
                    }
                }
                if (empty($penyanyi["status"])) {
                    $penyanyi["status"] = "SUBSCRIBE";
                }
                array_push($data["penyanyi"], $penyanyi);
            }
            
            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $data["title"] = "Premium Singer List";
                
                $this->view('template/header', $data);
                $this->view('template/navbar', $data);
                $this->view('premium/singer_list', $data);
                $this->view('template/footer', $data);
            }
        } else {
            header("Location: ". BASE_PUBLIC_URL);
        }
    }
}

?>