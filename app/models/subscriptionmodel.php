<?php

class subscriptionmodel {
    private $table = 'subscription';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    function insert($creator_id, $subscriber_id) {
        $query = "INSERT INTO subscription VALUES ('$creator_id', '$subscriber_id', 'PENDING')";
        $this->db->query($query);
        $this->db->execute();

        return $this->db->rowCount() == 1;
    }

    function get_subscription_by_subscriber_id($id) {
        $this->db->query('SELECT * FROM subscription WHERE subscriber_id = ' . $id);
        return $this->db->multiple();
    }
}

?>