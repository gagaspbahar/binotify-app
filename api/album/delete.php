<?php

require_once '../../config/config.php';
require_once '../../app/models/Album.php';

if (isset($_POST['id'])) {
  $album_model = new AlbumModel();
  // $song = $album_model->getAlbumByAlbumId($_POST['id']);

  $rows = $album_model->deleteAlbum($_POST['id']);

  if ($rows) {
    // $rm_img = 'rm ../../' . $album['image_path'];
    // exec($rm_img);
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
