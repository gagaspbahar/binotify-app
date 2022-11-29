<?php

require_once '../../config/config.php';
require_once '../../app/models/Subscription.php';

// echo file_get_contents('php://input');
// error_log(print_r('sync.php: ' . json_decode(file_get_contents('php://input'), true)));

$postData = json_decode(file_get_contents('php://input'), true);
$subscription_model = new SubscriptionModel();

$rows = $subscription_model->getSubscription($postData['creator_id'], $postData['subscriber_id']);

if (!$rows) {
  $data = [
    'creator_id' => $postData['creator_id'],
    'subscriber_id' => $postData['subscriber_id'],
    'status' => $postData['status']
  ];
  $rows2 = $subscription_model->addSubscription($data);
} else {
  $rows2 = $subscription_model->updateSubscription($postData['creator_id'], $postData['subscriber_id'], $postData['status']);
}

if ($rows2) {
  http_response_code(200);
  echo json_encode(array(
    "message" => "Subscription added successfully."
  ));
} else {
  http_response_code(500);
  echo json_encode(array(
    "message" => "Failed to sync subscription."
  ));
}
