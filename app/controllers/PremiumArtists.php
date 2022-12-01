<?php

class PremiumArtists extends Controller {
  public function index($path = "&page=1") {
    $this->view('premium-artists/index', array('path' => $path));
  }
}