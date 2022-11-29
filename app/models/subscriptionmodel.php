<?php

class subscriptionmodel {
    private $table = 'subscription';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    function get_subscription_by_subscriber_id($id) {
        $this->db->query('SELECT * FROM subscription WHERE subscriber_id = ' . $id);
        return $this->db->multiple();
    }
}

?>