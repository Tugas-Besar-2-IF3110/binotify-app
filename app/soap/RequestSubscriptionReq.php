<?php

class RequestSubscriptionReq {
    public function __construct($API_KEY, $creatorId, $subscriberId) 
    {
        $this->API_KEY = $API_KEY;
        $this->creatorId = $creatorId;
        $this->subscriberId = $subscriberId;
    }
}
?>