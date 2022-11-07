<?php

class Error404 extends Controller {
  public function index() {
    http_response_code(404);
    $this->view('Error404/index');
  }
}