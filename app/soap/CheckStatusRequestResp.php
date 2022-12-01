<?php

class CheckStatusRequestResp {
    public function __construct($object) 
    {
        $this->success = $object->success;
        $this->message = $object->message;

        if (property_exists($object, "list")) {
            $this->list = array();
            
            if (is_object($object->list)) {
                array_push($this->list, $object->list);

            } else if (is_array($object->list)) {
                foreach ($object->list as $element) {
                    array_push($this->list, $element);
                }

            }
        } else {
            $this->list = null;
        }

    }
}
?>