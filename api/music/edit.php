<?php
require_once '../../config/config.php';
require_once '../../app/models/Song.php';

if (isset($_POST['id'])) {
    $song_model = new SongModel();
    $song = $song_model->getSongById($_POST['id']);
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
            echo "Sorry, song edit failed.";

            // if everything is ok, try to upload file
        } else {
            $st = move_uploaded_file($_FILES["file"]["tmp_name"], $target_img_file);
        }
    }

    if (isset($_POST['judul'])) {
        $song['judul'] = $_POST['judul'];
    }
    if (isset($_POST['genre'])) {
        $song['genre'] = $_POST['genre'];
    }
    if (isset($_POST['tanggal_terbit'])) {
        $song['tanggal_terbit'] = $_POST['tanggal_terbit'];
    }
    if (isset($_FILES) && $uploadOk) {
        $song['image_path'] = $target_img_file;
    }

    $rows = $song_model->editSong($song);

    if ($rows) {
        http_response_code(200);
        $msg = "Song successfully edited.";
    } else {
        http_response_code(500);
        $msg = "Song edit failed.";
    }
} else {
    http_response_code(400);
    $msg = "Bad request";
}
echo json_encode(array(
    "message" => $msg
));
