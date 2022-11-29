<?php

require_once '../../config/config.php';
require_once '../../app/core/Database.php';

class SubscriptionModel {
    private $table = 'subscription';
    private $db;
    
    public function __construct()
    {
        $this->db = new Database;
    }
    
    public function getAllSubscriptions()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getSubscriptionByCreatorId($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE creator_id = :id');
        $this->db->bind('id', $id);
        return $this->db->resultSet();
    }

    public function getSubscriptionBySubscriberId($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE subscriber_id = :id');
        $this->db->bind('id', $id);
        return $this->db->resultSet();
    }

    public function getSubscription($creator, $subscriber) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE creator_id = :creator AND subscriber_id = :subscriber');
        $this->db->bind('creator', $creator);
        $this->db->bind('subscriber', $subscriber);
        return $this->db->single();
    }

    public function addSubscription($data) {
        $this->db->query('INSERT INTO ' . $this->table . ' (creator_id, subscriber_id, status) VALUES (:creator_id, :subscriber_id, :status)');
        $this->db->bind('creator_id', $data['creator_id']);
        $this->db->bind('subscriber_id', $data['subscriber_id']);
        $this->db->bind('status', $data['status']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateSubscription($creator, $subscriber, $status) {
        $this->db->query('UPDATE ' . $this->table . ' SET status = :status WHERE creator_id = :creator_id AND subscriber_id = :subscriber_id');
        $this->db->bind('creator_id', $creator);
        $this->db->bind('subscriber_id', $subscriber);
        $this->db->bind('status', $status);
        $this->db->execute();
        return $this->db->rowCount();
    }
}