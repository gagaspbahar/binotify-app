<?php

require_once '../../config/config.php';


if (isset($_GET['id'])) {
  if (isset($_ENV['SOAP_URL'])) {
    $url = $_ENV['SOAP_URL'];
  } else if (isset($_ENV['SOLO_DOCKER'])) {
    $url = "http://host.docker.internal:8888/ws/subscription";
  } else {
    $url = "http://localhost:8888/ws/subscription";
  }
  $id = $_GET['id'];
  $request_param = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <getAllSubscriptionRequestBySubscriber xmlns="http://service.binotify.com/">
        <subscriber>'. $id . '</subscriber>
    </getAllSubscriptionRequestBySubscriber>
  </soap:Body>
</soap:Envelope>
  ';

  $headers = array(
    "Content-Type: text/xml;charset=\"utf-8\"",
    'Content-Length: ' .strlen($request_param),
    'X-API-Key: ' . $_ENV['SOAP_API_KEY']
  );

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $request_param);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  $response = curl_exec($ch);
  curl_close($ch);
  if ($response === FALSE) {
    printf("CURL error (#%d): %s<br>\n", curl_errno($ch),
    htmlspecialchars(curl_error($ch)));
  }
  $response1 = str_replace('<?xml version=\'1.0\' encoding=\'UTF-8\'?><S:Envelope xmlns:S="http://schemas.xmlsoap.org/soap/envelope/"><S:Body><ns2:getAllSubscriptionRequestBySubscriberResponse xmlns:ns2="http://service.binotify.com/"><return>',"",$response);
  $response2 = str_replace("</return></ns2:getAllSubscriptionRequestBySubscriberResponse></S:Body></S:Envelope>","",$response1);
  // echo $parser;
  echo $response2;
}