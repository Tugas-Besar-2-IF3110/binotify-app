<?php

class songmodel {
    private $table = 'song';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    function all() {
        $this->db->query('SELECT * FROM song');
        return $this->db->multiple();
    }
    
    function insert($judul, $penyanyi, $tanggal_terbit, $genre, $duration, $audio_path, $image_path, $album_id) {
        if ($album_id == 0) {
            $query = "INSERT INTO song (Judul, Penyanyi, Tanggal_terbit, Genre, Duration, Audio_path, Image_path, album_id) VALUES ('$judul', '$penyanyi', '$tanggal_terbit', '$genre', '$duration', '$audio_path', '$image_path', NULL)";
        } else {
            $query = "INSERT INTO song (Judul, Penyanyi, Tanggal_terbit, Genre, Duration, Audio_path, Image_path, album_id) VALUES ('$judul', '$penyanyi', '$tanggal_terbit', '$genre', '$duration', '$audio_path', '$image_path', $album_id)";
        }
        $this->db->query($query);
        $this->db->execute();

        return $this->db->rowCount() == 1;
    }

    function get_genre_list() {
        $this->db->query("SELECT DISTINCT(Genre) FROM song");
        return $this->db->multiple();
    }

    function get_song_display_home() {
        $query = "SELECT * FROM (SELECT * FROM song ORDER BY Tanggal_terbit DESC LIMIT 10) AS t ORDER BY Judul";
        $this->db->query($query);
        return $this->db->multiple();
    }

    function get_song_by_id($id) {
        $this->db->query('SELECT * FROM song WHERE song_id = ' . $id);
        return $this->db->single();
    }

    function get_song_by_search_filter_sort_page($search_value, $filter, $sort, $asc_desc, $page) {
        if ($page == '') {
            $page = 0;
        } else {
            $page = (int)$page;
        }

        $limit = (float)10;
        
        $query = "SELECT COUNT(*) FROM song";
        $this->db->query($query);
        $num_of_songs = $this->db->single()["COUNT(*)"];
        $num_of_songs = $this->db->single()["COUNT(*)"];

        $query = '';
        if ($filter == '') {
            if ($sort == '') {
                $query = "SELECT * FROM song WHERE Judul LIKE '%" . $search_value . "%' OR Penyanyi LIKE '%" . $search_value . "%' OR Tanggal_terbit LIKE '%" . $search_value . "%' ORDER BY Judul";
            } else if ($sort == 'abjad') {
                if ($asc_desc == 'asc') {
                    $query = "SELECT * FROM song WHERE Judul LIKE '%" . $search_value . "%' OR Penyanyi LIKE '%" . $search_value . "%' OR Tanggal_terbit LIKE '%" . $search_value . "%' ORDER BY Judul";
                } else {
                    $query = "SELECT * FROM song WHERE Judul LIKE '%" . $search_value . "%' OR Penyanyi LIKE '%" . $search_value . "%' OR Tanggal_terbit LIKE '%" . $search_value . "%' ORDER BY Judul DESC";
                }
            } else {
                if ($asc_desc == 'asc') {
                    $query = "SELECT * FROM song WHERE Judul LIKE '%" . $search_value . "%' OR Penyanyi LIKE '%" . $search_value . "%' OR Tanggal_terbit LIKE '%" . $search_value . "%' ORDER BY Tanggal_terbit";
                } else {
                    $query = "SELECT * FROM song WHERE Judul LIKE '%" . $search_value . "%' OR Penyanyi LIKE '%" . $search_value . "%' OR Tanggal_terbit LIKE '%" . $search_value . "%' ORDER BY Tanggal_terbit DESC";
                }
            }
        } else {
            if ($sort == '') {
                $query = "SELECT * FROM song WHERE (Judul LIKE '%" . $search_value . "%' OR Penyanyi LIKE '%" . $search_value . "%' OR Tanggal_terbit LIKE '%" . $search_value . "%') AND Genre = '" . $filter . "' ORDER BY Judul";
            } else if ($sort == 'abjad') {
                if ($asc_desc == 'asc') {
                    $query = "SELECT * FROM song WHERE (Judul LIKE '%" . $search_value . "%' OR Penyanyi LIKE '%" . $search_value . "%' OR Tanggal_terbit LIKE '%" . $search_value . "%') AND Genre = '" . $filter . "' ORDER BY Judul";
                } else {
                    $query = "SELECT * FROM song WHERE (Judul LIKE '%" . $search_value . "%' OR Penyanyi LIKE '%" . $search_value . "%' OR Tanggal_terbit LIKE '%" . $search_value . "%') AND Genre = '" . $filter . "' ORDER BY Judul DESC";
                }
            } else {
                if ($asc_desc == 'asc') {
                    $query = "SELECT * FROM song WHERE (Judul LIKE '%" . $search_value . "%' OR Penyanyi LIKE '%" . $search_value . "%' OR Tanggal_terbit LIKE '%" . $search_value . "%') AND Genre = '" . $filter . "' ORDER BY Tanggal_terbit";
                } else {
                    $query = "SELECT * FROM song WHERE (Judul LIKE '%" . $search_value . "%' OR Penyanyi LIKE '%" . $search_value . "%' OR Tanggal_terbit LIKE '%" . $search_value . "%') AND Genre = '" . $filter . "' ORDER BY Tanggal_terbit DESC";
                }
            }
        }
        $querySong = $query . " LIMIT ".(int)$limit . " OFFSET " . $page * (int)$limit . "";

        $this->db->query($querySong);
        $return["songs"] = $this->db->multiple();

        $queryCount = "SELECT COUNT(*) FROM (" . $query . ") src";
        $this->db->query($queryCount);
        $num_of_songs = $this->db->single()["COUNT(*)"];

        // $num_of_songs = count($return["songs"]);
        $num_of_pages = ceil($num_of_songs / $limit);

        $return["num_of_pages"] = $num_of_pages;
        $return["current_page"] = $page;
        $return["num_of_songs"] = $num_of_songs;
        // return $this->db->multiple();

        return $return;
    }

    function get_songs_by_album_id($id) {
        $query = "SELECT * FROM song WHERE album_id = :album_id";
        $this->db->query($query);
        $this->db->bind("album_id", $id);

        return $this->db->multiple();
    }

    function get_song_by_song_id($id) {
        $query = "SELECT * FROM song WHERE song_id = :song_id";
        $this->db->query($query);
        $this->db->bind("song_id", $id);

        $song = $this->db->single();

        if ($this->db->rowCount() == 1) {
            return $song;
        }
        return null;
    }

    function update($id, $judul, $penyanyi, $tanggal_terbit, $genre, $duration, $audio_path, $image_path, $album_id) {
        $query = "SELECT * FROM song WHERE song_id = :song_id";
        $update_same = true;
        
        $this->db->query($query);
        $this->db->bind("song_id", $id);
        $old_album = $this->db->single();

        $judul_update = $old_album["Judul"];
        $penyanyi_update = $old_album["Penyanyi"];
        $tanggal_terbit_update = $old_album["Tanggal_terbit"];
        $genre_update = $old_album["Genre"];
        $duration_update = $old_album["Duration"];
        $audio_path_update = $old_album["Audio_path"];
        $image_path_update = $old_album["Image_path"];
        $album_id_update = $old_album["album_id"];
        
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

        if ($duration != null) {
            $duration_update = $duration;
            if ($duration_update != $duration) {
                $update_same = false;
            }
        }

        if ($audio_path != null) {
            $audio_path_update = $audio_path;
            if ($audio_path_update != $audio_path) {
                $update_same = false;
            }
        }
        
        if ($image_path != null) {
            $image_path_update = $image_path;
            if ($image_path_update != $image_path) {
                $update_same = false;
            }
        }
        
        if ($album_id != null) {
            $album_id_update = $album_id;
            if ($album_id_update != $album_id) {
                $update_same = false;
            }
        }

        $query = "
            UPDATE song SET 
            Judul ='" . $judul_update . "', 
            Penyanyi = '" . $penyanyi_update ."', 
            Tanggal_terbit = '" . $tanggal_terbit_update ."', 
            Genre = '" . $genre_update ."' ,
            Duration = '" . $duration_update . "', 
            Audio_path = '" . $audio_path_update . "', 
            Image_path = '" . $image_path_update . "'
            WHERE song_id = " . $id
            ;

        $this->db->query($query);
        $this->db->execute();
        
        return $this->db->rowCount() == 1 || $update_same;
    }
    
    function delete_song_by_song_id($id) {
        $query = "DELETE FROM song WHERE song_id = ". $id;
        // echo $query;
        $this->db->query($query);
        // $this->db->bind("song_id", $id);

        $this->db->execute();

        return $this->db->rowCount() == 1;
        // return $query;
    }
}

?>