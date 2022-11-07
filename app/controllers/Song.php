<?php

class Song extends Controller {
  public function index($id = 0) {
    $this->view('song/index', array('id' => $id));
  }

  public function add() {
    if(isset($_SESSION['is_admin'])){
      if ($_SESSION['is_admin'] == 1) {
        $this->view('song/add');
      } else {
        header('Location: /?home');
      }
    }
    else {
      header('Location: /?home');
    }
  }

  public function edit($id = 0) {
    if(isset($_SESSION['is_admin'])){
      if ($_SESSION['is_admin'] == 1) {
        $this->view('song/edit', array('id' => $id));
      } else {
        header('Location: /?home');
      }
    }
    else {
      header('Location: /?home');
    }
  }
}