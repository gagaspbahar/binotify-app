<?php

require_once '../../config/config.php';
require_once '../../app/models/Song.php';

if (isset($_POST['id'])) {
  $song_model = new SongModel();
  $song = $song_model->getSongById($_POST['id']);

  $rows = $song_model->deleteSong($_POST['id']);

  if ($rows) {
    $rm_song = 'rm ../../' . $song['audio_path'];
    $rm_img = 'rm ../../' . $song['image_path'];
    exec($rm_song);
    exec($rm_img);
    http_response_code(200);
    echo json_encode(array(
      "message" => "Song deleted successfully."
    ));
  } else {
    http_response_code(500);
    echo json_encode(array(
      "message" => "Song deletion failed."
    ));
  }
} else {
  http_response_code(400);
  echo json_encode(array(
    "message" => "Bad request."
  ));
}
