<?php

require_once '../../config/config.php';
require_once '../../app/core/Database.php';

class AlbumModel
{
  private $table = 'albums';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getAllAlbums()
  {
    $this->db->query('SELECT * FROM ' . $this->table);
    return $this->db->resultSet();
  }

  public function getAlbumByAlbumId($id)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE album_id = :id');
    $this->db->bind('id', $id);
    return $this->db->single();
  }
  
  public function editAlbum($data){
    $this->db->query('UPDATE ' . $this->table . ' SET judul = :judul, image_path = :image_path WHERE album_id = :id');
    $this->db->bind('judul', $data['judul']);
    $this->db->bind('image_path', $data['image_path']);
    $this->db->bind('id', $data['album_id']);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function insertAlbum($data) {
    $this->db->query('INSERT INTO ' . $this->table . ' (judul, penyanyi, tanggal_terbit, genre, total_duration, image_path) VALUES (:judul, :penyanyi, :tanggal_terbit, :genre, :total_duration, :image_path)');
    $this->db->bind('judul', $data['judul']);
    $this->db->bind('penyanyi', $data['penyanyi']);
    $this->db->bind('tanggal_terbit', $data['tanggal_terbit']);
    $this->db->bind('genre', $data['genre']);
    $this->db->bind('total_duration', $data['total_duration']);
    $this->db->bind('image_path', $data['image_path']);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function deleteAlbum($id){
    $this->db->query('DELETE FROM ' . $this->table . ' WHERE album_id = :id');
    $this->db->bind('id', $id);
    $this->db->execute();
    return $this->db->rowCount();
  }
}
