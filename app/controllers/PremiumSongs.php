<?php

class PremiumSongs extends Controller {
  public function index($id = 0) {
    $this->view('premium-songs/index', array('id' => $id));
  }
}