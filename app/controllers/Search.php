<?php

class Search extends Controller {
  public function index($path = "&page=1") {
    $this->view('search/index', array('path' => $path));
  }
}