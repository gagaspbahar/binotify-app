<?php

require_once '../../config/config.php';
require_once '../../app/models/Song.php';

$song_model = new SongModel();

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $song = $song_model->getSongWithAlbumById($id);
  if ($song != null) {
    http_response_code(200);
    echo json_encode($song);
  } else {
    http_response_code(500);
    echo json_encode(array("message" => "Something went wrong."));
  }
} else {
  http_response_code(400);
  echo json_encode(array("message" => "Bad request."));
}
