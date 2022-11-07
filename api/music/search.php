<?php

require_once '../../config/config.php';
require_once '../../app/models/Song.php';

$song_model = new SongModel();
$params = array();

if (isset($_GET['judul'])) {
  $judul = $_GET['judul'];
  $params['judul'] = $judul;
}
if (isset($_GET['genre'])) {
  $genre = $_GET['genre'];
  $params['genre'] = $genre;
}
if (isset($_GET['sort'])) {
  $sort = $_GET['sort'];
  $params['sort'] = $sort;
}
if (isset($_GET['page'])) {
  $page = $_GET['page'];
  $params['page'] = $page;
}
$params['limit'] = 5;


$songs = $song_model->findSong($params);

if ($songs != null) {
  http_response_code(200);
  echo json_encode($songs);
} else {
  http_response_code(200);
  echo json_encode(array('status' => 'error', 'message' => 'End of list.'));
}
