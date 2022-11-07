<?php

class Admin extends Controller {
  public function index() {
    if(isset($_SESSION['is_admin'])){
      if ($_SESSION['is_admin'] == 1) {
        $this->view('admin/index');
      } else {
        header('Location: /?home');
      }
    }
    else {
      header('Location: /?home');
    }
  }
}