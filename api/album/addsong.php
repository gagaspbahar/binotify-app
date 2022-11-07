<?php

require_once '../../config/config.php';
require_once '../../app/models/Song.php';


if (isset($_POST['song_id']) && isset($_POST['album_id'])) {
  $song_model = new SongModel();

  $rows = $song_model->addSongToAlbum($_POST['song_id'], $_POST['album_id']);

  if ($rows) {
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
