<?php

class Test extends Controller {
    public function index() {
        $soapClient = new SoapClient(BASE_SOAP_URL . "?wsdl");
        // var_dump($soapClient->__getTypes());

        $reqHeader = new RequestHeader("key");
        // $reqHeader = array(
        //     'API_KEY'=>'key'
        //     );
        $header = new SoapHeader(
            "NAMESPACE",
            "header",
            $reqHeader,
            false
        );
        $soapClient->__setSoapHeaders($header);

        $req = new RequestSubscriptionReq(1, 1);
        $params = array(
            "request" => $req
        );

        // Invoke WS method (Function1) with the request params 
        $response = $soapClient->__soapCall("requestSubscription", array($params));

        // // Print WS response
        // var_dump($response->return);
        var_dump(new RequestSubscriptionResp($response->return));


        // var_dump($soapClient->__getTypes());
    }
}
?>