<?php

require_once '../../config/config.php';
require_once '../../app/models/Album.php';

if (isset($_POST['id'])) {
  $album_model = new AlbumModel();
  $album = $album_model->getAlbumByAlbumId($_POST['id']);
  $uploadOk = 0;

  if (isset($_FILES['file'])) {
    $uploadOk = 1;
    $img_dir = "../../public/img/song-cover/";
    $target_img_file = $img_dir . basename($_FILES["file"]["name"]);
    $imgFileType = strtolower(pathinfo($target_img_file, PATHINFO_EXTENSION));

    // Check file size
    if ($_FILES["file"]["size"] > 10000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imgFileType != "png" && $imgFileType != "jpeg" && $imgFileType != "jpg") {
      echo "Sorry, only png, jpg & jpeg files are allowed.";
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, album edit failed.";

      // if everything is ok, try to upload file
    } else {
      $st = move_uploaded_file($_FILES["file"]["tmp_name"], $target_img_file);
    }
  }

  if (isset($_POST['judul'])) {
    $album['judul'] = $_POST['judul'];
  }
  if (isset($_FILES) && $uploadOk) {
    $album['image_path'] = $target_img_file;
  }

  $rows = $album_model->editAlbum($album);

  if ($rows) {
    http_response_code(200);
    $msg = "Album successfully edited.";
  } else {
    http_response_code(500);
    $msg = "Album edit failed.";
  }
} else {
  http_response_code(400);
  $msg = "Bad request.";
}
echo json_encode(array("message" => $msg));
