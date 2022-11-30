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

    function get_subscription_by_subscriber_id_and_creator_id($subscriberId, $creatorId) {
        $this->db->query('SELECT * FROM subscription WHERE subscriber_id = ' . $subscriberId . ' AND creator_id = ' . $creatorId);
        return $this->db->single();
    }

    function update_status($creator_id, $subscriber_id, $status) {
        $subscription = $this->get_subscription_by_subscriber_id_and_creator_id($subscriber_id, $creator_id);

        if ($subscription != null && isset($subscription["status"]) && $subscription["status"] == $status) {
            return true;
        } else {
            $query = "UPDATE subscription " .
            "SET status = '". $status ."' " .
            "WHERE " .
            "creator_id = " . $creator_id .
            " AND subscriber_id = " . $subscriber_id
            ;
            $this->db->query($query);
            $this->db->execute();
    
            return $this->db->rowCount() == 1;

        }
    }
}

?>