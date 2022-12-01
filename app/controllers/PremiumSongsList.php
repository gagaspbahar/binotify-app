<?php

class PremiumSongsList extends Controller {
  public function index($id = 0, $path = "&page=1") {
    $this->view('premium-songs-list/index', array('id' => $id, "path" => $path));
  }
}