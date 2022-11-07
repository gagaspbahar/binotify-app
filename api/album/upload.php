<?php

require_once '../../config/config.php';
require_once '../../app/models/Album.php';

$img_dir = "../../public/img/song-cover/";
$target_img_file = $img_dir . basename($_FILES["file"]["name"]);
$saved_img_dir = "public/img/song-cover/" . basename($_FILES["file"]["name"]);

if (isset($_POST['judul']) && isset($_POST['genre']) && isset($_POST['penyanyi']) && isset($_POST['tanggal_terbit']) && isset($_FILES['file'])) {
  $uploadOk = 1;
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
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
  } else {
    $st = move_uploaded_file($_FILES["file"]["tmp_name"], $target_img_file);
  }
  $album_model = new AlbumModel();

  $dataparams = array(
    'judul' => $_POST['judul'],
    'penyanyi' => $_POST['penyanyi'],
    'tanggal_terbit' => $_POST['tanggal_terbit'],
    'genre' => $_POST['genre'],
    'total_duration' => 0,
    'image_path' => $saved_img_dir
  );
  $rows = $album_model->insertAlbum($dataparams);

  if ($rows) {
    http_response_code(200);
    echo json_encode(array("message" => "Album successfully added."));
  } else {
    http_response_code(500);
    echo json_encode(array("message" => "Something went wrong."));
  }
} else {
  http_response_code(400);
  echo json_encode(array("message" => "Bad request."));
}
