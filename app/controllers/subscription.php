<?php

class Subscription extends Controller {
    public function index() {
        $soapClient = new SoapClient(BASE_SOAP_URL . "?wsdl");

        $req = new RequestSubscriptionReq(API_KEY, 1, 1);
        $params = array(
            "request" => $req
        );

        $responseObj = $soapClient->__soapCall("requestSubscription", array($params));

        $response = new RequestSubscriptionResp($responseObj->return);
        var_dump($response);

    }
}
?>