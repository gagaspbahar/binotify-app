<?php

require_once '../../config/config.php';
require_once '../../app/models/Subscription.php';

$subscription_model = new SubscriptionModel();

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $subscription = $subscription_model->getSubscriptionBySubscriberId($id);
  if ($subscription != null) {
    http_response_code(200);
    echo json_encode($subscription);
  } else {
    http_response_code(500);
    echo json_encode(array("message" => "Something went wrong."));
  }
} else {
  http_response_code(400);
  echo json_encode(array("message" => "Bad request."));
}
