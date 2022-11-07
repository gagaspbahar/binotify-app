<?php

require_once '../../config/config.php';
require_once '../../app/models/Album.php';

$album_model = new AlbumModel();

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $album = $album_model->getAlbumByAlbumId($id);
  if ($album != null) {
    http_response_code(200);
    echo json_encode($album);
  } else {
    http_response_code(500);
    echo json_encode(array("message" => "Something went wrong."));
  }
} else {
  http_response_code(400);
  echo json_encode(array("message" => "Bad request."));
}
