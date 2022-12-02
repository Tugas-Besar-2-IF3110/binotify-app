<?php

class Subscription extends Controller {
    public function __construct() 
    {
        $this->soapClient = new SoapClient(BASE_SOAP_URL . "?wsdl");
    }

    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // The request is using the POST method
            session_start();

            if (isset($_POST['creator_id']) && isset($_POST['subscriber_id'])) {
                $creator_id = $_POST['creator_id'];
                $subscriber_id = $_POST['subscriber_id'];

                $req = new RequestSubscriptionReq(API_KEY, $creator_id, $subscriber_id);
                $params = array(
                    "request" => $req
                );
                $responseObj = $this->soapClient->__soapCall("requestSubscription", array($params));
                $response = new RequestSubscriptionResp($responseObj->return);

                if ($response->success) {
                    $success_insert = $this->model('subscriptionmodel')->insert($creator_id, $subscriber_id);
                    if ($success_insert) {
                        header("Location: ". BASE_PUBLIC_URL . "/premium/singer_list");
                    }
                }
            }
        }
    }

    public function callback_update_request() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $headers = getallheaders();
            if (isset($headers["Authorization"]) && $headers["Authorization"] == BINOTIFY_SOAP_API_KEY) {
                $creator_id = $_POST["creator_id"];
                $subscriber_id = $_POST["subscriber_id"];
                $status = $_POST["status"];
    
                $success_update = $this->model('subscriptionmodel')->update_status($creator_id, $subscriber_id, $status);
                $data["success"] = $success_update;
                if ($success_update) {
                    $data["message"] = "Update successful";
                    http_response_code(200);
                } else {
                    $data["message"] = "Update failed";
                    http_response_code(400);
                }
                echo json_encode($data);
            } else {
                $data["success"] = false;
                $data["message"] = "Not Authorized";
                http_response_code(400);
                echo json_encode($data);
            }
        }
    }
}
?>