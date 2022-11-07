<?php

class albummodel {
    private $table = 'album';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    function all() {
        $this->db->query('SELECT * FROM album');
        return $this->db->multiple();
    }
    
    function insert($judul, $penyanyi, $image_path, $tanggal_terbit, $genre) {
        $query = "INSERT INTO album (Judul, Penyanyi, Image_path, Tanggal_terbit, Genre) VALUES ('$judul', '$penyanyi', '$image_path', '$tanggal_terbit', '$genre')";
        $this->db->query($query);
        $this->db->execute();

        return $this->db->rowCount() == 1;
    }

    function get_album_by_id($id) {
        $query = "SELECT * FROM album WHERE album_id = " . $id;
        $this->db->query($query);
        $album = $this->db->single();

        if ($this->db->rowCount() == 1) {
            return $album;
        }
        return null;
    }

    function update_duration_by_id($duration, $id) {
        $query = "UPDATE album SET Total_duration = Total_duration + " . $duration . " WHERE album_id = " . $id;
        $this->db->query($query);
        $this->db->execute();

        return $this->db->rowCount() == 1;
    }
    
    function get_by_penyanyi($penyanyi) {
        $this->db->query("SELECT * FROM album WHERE Penyanyi = '$penyanyi'");
        return $this->db->multiple();
    }

    function update($id, $judul, $penyanyi, $image_path, $tanggal_terbit, $genre) {
        $query = "SELECT * FROM album WHERE album_id = :album_id";
        $update_same = true;
        
        $this->db->query($query);
        $this->db->bind("album_id", $id);
        $old_album = $this->db->single();

        $judul_update = $old_album["Judul"];
        $penyanyi_update = $old_album["Penyanyi"];
        $image_path_update = $old_album["Image_path"];
        $tanggal_terbit_update = $old_album["Tanggal_terbit"];
        $genre_update = $old_album["Genre"];
        
        if ($judul != null) {
            $judul_update = $judul;

            if ($judul_update != $judul) {
                $update_same = false;
            }
        }
        
        if ($penyanyi != null) {
            $penyanyi_update = $penyanyi;

            if ($penyanyi_update != $penyanyi) {
                $update_same = false;
            }
        }
        
        if ($image_path != null) {
            $image_path_update = $image_path;
            if ($image_path_update != $image_path) {
                $update_same = false;
            }
        }

        if ($tanggal_terbit != null) {
            $tanggal_terbit_update = $tanggal_terbit;
            if ($tanggal_terbit_update != $tanggal_terbit) {
                $update_same = false;
            }
        }
        
        if ($genre != null) {
            $genre_update = $genre;
            if ($genre_update != $genre) {
                $update_same = false;
            }
        }

        $query = "UPDATE album SET Judul ='" . $judul_update . "', Penyanyi = '" . $penyanyi_update ."', Image_path = '" . $image_path_update . "', Tanggal_terbit = '" . $tanggal_terbit_update ."', Genre = '" . $genre_update ."' WHERE album_id = " . $id;

        $this->db->query($query);
        $this->db->execute();

        return $this->db->rowCount() == 1 || $update_same;
    }

    function get_all_album(){
        $query= "SELECT * FROM album ORDER BY Judul";
        $this->db->query($query);
        return $this->db->multiple();
    }

    function delete_album_by_album_id($id) {
        $query = "DELETE FROM album WHERE album_id = ". $id;
        // echo $query;
        $this->db->query($query);
        // $this->db->bind("album_id", $id);

        $this->db->execute();

        return $this->db->rowCount() == 1;
        // return $query;
    }

    function decrease_album_duration_by_album_id($id, $duration) {
        $query = "UPDATE album SET Total_duration = Total_duration - " . $duration . " WHERE album_id = " . $id;
        // echo $query;
        $this->db->query($query);
        // $this->db->bind("album_id", $id);

        $this->db->execute();

        return $this->db->rowCount() == 1;
        // return $query;
    }
}

?>