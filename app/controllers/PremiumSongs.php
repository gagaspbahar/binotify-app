<?php

class PremiumSongs extends Controller {
  public function index($id = 0, $path = "&page=1") {
    $this->view('premium-songs/index', array('id' => $id, "path" => $path));
  }
  public function list($id = 0, $path = "&page=1") {
    $this->view('premium-songs-list/index', array('id' => $id, "path" => $path));
  }
}