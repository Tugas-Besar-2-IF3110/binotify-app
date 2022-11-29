<?php

class RequestSubscriptionResp {
    public function __construct($object) 
    {
        $this->success = $object->success;
        $this->message = $object->message;

        if (property_exists($object, "creatorId")) {
            $this->creatorId = $object->creatorId;
        } else {
            $this->creatorId = null;
        }

        if (property_exists($object, "subscriberId")) {
            $this->subscriberId = $object->subscriberId;
        } else {
            $this->subscriberId = null;
        }

        if (property_exists($object, "status")) {
            $this->status = $object->status;
        } else {
            $this->status = null;
        }
    }
}
?>