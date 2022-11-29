<?php

class Subscription extends Controller {
    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // The request is using the POST method
            session_start();

            if (isset($_POST['creator_id']) && isset($_POST['subscriber_id'])) {
                $creator_id = $_POST['creator_id'];
                $subscriber_id = $_POST['subscriber_id'];
                $soapClient = new SoapClient(BASE_SOAP_URL . "?wsdl");

                $req = new RequestSubscriptionReq(API_KEY, $creator_id, $subscriber_id);
                $params = array(
                    "request" => $req
                );
                $responseObj = $soapClient->__soapCall("requestSubscription", array($params));
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
}
?>