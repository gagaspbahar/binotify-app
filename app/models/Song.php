<?php

require_once '../../config/config.php';
require_once '../../app/core/Database.php';

class SongModel
{
  private $table = 'songs';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getAllSongs()
  {
    $this->db->query('SELECT * FROM ' . $this->table);
    return $this->db->resultSet();
  }

  public function getSongById($id)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE song_id = :id');
    $this->db->bind('id', $id);
    return $this->db->single();
  }

  public function getSongWithAlbumById($id){
    $this->db->query("select
    s.*,
    (case
      when a.judul is null then 'No Album'
      else a.judul
    end) as judul_album
  from
    songs s
  left join albums a on
    s.album_id = a.album_id
  where
    s.song_id = :id");
    $this->db->bind('id', $id);
    return $this->db->single();
  }

  public function insertSong($data){
    $this->db->query('INSERT INTO ' . $this->table . ' (judul, penyanyi, tanggal_terbit, genre, duration, audio_path, image_path) VALUES (:judul, :penyanyi, :tanggal_terbit, :genre, :duration, :audio_path, :image_path)');
    $this->db->bind('judul', $data['judul']);
    $this->db->bind('penyanyi', $data['penyanyi']);
    $this->db->bind('tanggal_terbit', $data['tanggal_terbit']);
    $this->db->bind('genre', $data['genre']);
    $this->db->bind('duration', $data['duration']);
    $this->db->bind('audio_path', $data['audio_path']);
    $this->db->bind('image_path', $data['image_path']);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function editSong($data) {
    $this->db->query('UPDATE ' . $this->table . ' SET judul = :judul, tanggal_terbit = :tanggal_terbit, genre = :genre, image_path = :image_path WHERE song_id = :id');
    $this->db->bind('judul', $data['judul']);
    $this->db->bind('tanggal_terbit', $data['tanggal_terbit']);
    $this->db->bind('genre', $data['genre']);
    $this->db->bind('image_path', $data['image_path']);
    $this->db->bind('id', $data['song_id']);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function deleteSong($id) {
    $this->db->query('DELETE FROM ' . $this->table . ' WHERE song_id = :id');
    $this->db->bind('id', $id);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function findSong($data)
  {
    $query = "SELECT * FROM songs";
    $where = false;
    if (isset($data['judul'])) {
      $query .= " WHERE LOWER(judul) LIKE :judul OR LOWER(penyanyi) LIKE :judul OR date_part('year', tanggal_terbit)::varchar LIKE :judul ";
      $where = true;
    }
    if (isset($data['genre'])) {
      if ($where) {
        $query .= " AND genre = :genre";
      } else {
        $query .= " WHERE genre = :genre";
        $where = true;
      }
    }
    if (!isset($data['sort'])) {
      $query .= " ORDER BY lower(judul)";
    } else {
      $sign = substr($data['sort'], 0, 1);
      $sortby = substr($data['sort'], 1);
      if ($sortby == 'judul') {
        $query .= " ORDER BY lower(judul)";
      } else if ($sortby == 'tanggal_terbit') {
        $query .= " ORDER BY tanggal_terbit";
      }
      if ($sign == '-') {
        $query .= " DESC";
      } else {
        $query .= " ASC";
      }
    }

    $query .= " LIMIT 5";

    if (isset($data['page'])) {
      $query .= " OFFSET :offset";
    }


    $this->db->query($query);
    if (isset($data['judul'])) {
      $this->db->bind('judul', '%' . $data['judul'] . '%');
    }
    if (isset($data['genre'])) {
      $this->db->bind('genre', $data['genre']);
    }
    if (isset($data['page'])) {
      $this->db->bind('offset', $data['limit'] * ($data['page'] - 1));
    }
    $this->db->execute();

    return $this->db->resultSet();
  }

  public function deleteSongFromAlbum($id) {
    $this->db->query('UPDATE ' . $this->table . ' SET album_id = NULL WHERE song_id = :id');
    $this->db->bind('id', $id);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function addSongToAlbum($song_id, $album_id) {
    $this->db->query('UPDATE ' . $this->table . ' SET album_id = :album_id WHERE song_id = :song_id');
    $this->db->bind('album_id', $album_id);
    $this->db->bind('song_id', $song_id);
    $this->db->execute();
    return $this->db->rowCount();
  }
}

