<?php

class Song extends Controller {

    public function add_song() {
        session_start();
        if (isset($_SESSION['user_id']) && $_SESSION['isAdmin'] == 1) { 
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['judul']) && isset($_POST['penyanyi']) && isset($_POST['tanggal_terbit']) && isset($_POST['genre']) && isset($_FILES['audio']) && isset($_FILES['foto'])) {
                    $judul = $_POST['judul'];
                    $penyanyi = $_POST['penyanyi'];
                    $tanggal_terbit = $_POST['tanggal_terbit'];
                    $genre = $_POST['genre'];
                    $audio = $_FILES['audio'];
                    $foto = $_FILES['foto'];
                    if (isset($_POST['album_id'])) {
                        $album_id = intval($_POST['album_id']);  
                    } else {
                        $album_id = 0;
                    }
                    $audio_duration = $_POST['audio_duration'];

                    if (empty($judul)) {
                        $data['error'] = 'Judul is required';
                        $data["title"] = "Add Song";

                        $this->view('template/header', $data);
                        $this->view('template/navbar', $data);
                        $this->view('song/add_song', $data);
                        $this->view('template/footer', $data);

                    } else if (empty($tanggal_terbit)) {
                        $data['error'] = 'Tanggal terbit is required';
                        $data["title"] = "Add Song";

                        $this->view('template/header', $data);
                        $this->view('template/navbar', $data);
                        $this->view('song/add_song', $data);
                        $this->view('template/footer', $data);
                        
                    } else if (empty($audio['name'])) {
                        $data['error'] = 'Audio is required';
                        $data["title"] = "Add Song";

                        $this->view('template/header', $data);
                        $this->view('template/navbar', $data);
                        $this->view('song/add_song', $data);
                        $this->view('template/footer', $data);
                        
                    } else {
                        $audio['name'] = str_replace("'", "", $audio['name']);
                        $audio_path = 'audio_files/' . uniqid() . '-' . str_replace("'", "", $audio['name']);
                        $path_to_save = $this->assets() . $audio_path;
                        if (move_uploaded_file($audio['tmp_name'], $path_to_save)) {
                            if (!empty($foto)) {
                                $foto['name'] = str_replace("'", "", $foto['name']);
                                $image_path = 'audio_images/' . uniqid() . '-' . str_replace("'", "", $foto['name']);
                                $path_to_save = $this->assets() . $image_path;
                                move_uploaded_file($foto['tmp_name'], $path_to_save);
                            }
                            
                            $success_insert = $this->model('songmodel')->insert($judul, $penyanyi, $tanggal_terbit, $genre, $audio_duration, $audio_path, $image_path, $album_id);
                            if ($album_id == 0) {
                                $success_update = true;
                            } else {
                                $success_update = $this->model('albummodel')->update_duration_by_id($audio_duration, $album_id);
                            }
                            if ($success_insert && $success_update) {
                                $data['success'] = 'Tambah lagu sukses';
                                $data["title"] = "Add Song";

                                $this->view('template/header', $data);
                                $this->view('template/navbar', $data);
                                $this->view('song/add_song', $data);
                                $this->view('template/footer', $data);
                            } else {
                                $data['error'] = 'Tambah lagu gagal. Silahkan coba lagi';
                                $data["title"] = "Add Song";

                                $this->view('template/header', $data);
                                $this->view('template/navbar', $data);
                                $this->view('song/add_song', $data);
                                $this->view('template/footer', $data);
                            }
                        } else {
                            $data['error'] = 'Tambah lagu gagal. Silahkan coba lagi';
                            $data["title"] = "Add Song";

                            $this->view('template/header', $data);
                            $this->view('template/navbar', $data);
                            $this->view('song/add_song', $data);
                            $this->view('template/footer', $data);
                        }
                    }
                } else {
                    $data["title"] = "Add Song";

                    $this->view('template/header', $data);
                    $this->view('template/navbar', $data);
                    $this->view('song/add_song', $data);
                    $this->view('template/footer', $data);
                }
            } else {
                // $this->view('song/add_song');
                $data["title"] = "Add Song";

                $this->view('template/header', $data);
                $this->view('template/navbar', $data);
                $this->view('song/add_song', $data);
                $this->view('template/footer', $data);
            }
        } else {
            header("Location: ". BASE_PUBLIC_URL);
        }
    }

    public function get_song_by_id() {
        $song_id = $_GET['song_id'];
        $song = $this->model('songmodel')->get_song_by_id($song_id);
        echo json_encode($song);
    }

    public function listen() {
        session_start();

        if (empty($_SESSION['listen_count'])) {
            $_SESSION['listen_timestamp'] = time();
            $_SESSION['listen_count'] = 1;
        } else {
            $_SESSION['listen_count']++;
        }
        echo ($_SESSION['listen_count']);
    }

    public function detail($id) {
        session_start();

        if (!empty($_SESSION['listen_timestamp'])) {
            if (time() - $_SESSION["listen_timestamp"] > 86400) {
                unset($_SESSION['listen_timestamp']);
                unset($_SESSION['listen_count']);
            }
        }
        if (empty($_SESSION['user_id'])) {
            if (!empty($_SESSION['listen_count'])) {
                $data['listen_count'] = $_SESSION['listen_count'];
            } else {
                $data['listen_count'] = 0;
            }
            $data['login'] = 0;
        } else {
            $data['listen_count'] = 0;
            $data['login'] = 1;
        }
        include $this->utility('timeformat');
        $song = $this->model('songmodel')->get_song_by_song_id($id);
        $song["Duration"] = (new changeFormat($song["Duration"]))->getTimeCodeFromNumAlbum();
        // var_dump($song);
        $data["title"] = "Detail Lagu";
        $data["song"] = $song;
        if ($song["album_id"] != null) {
            $album = $this->model('albummodel')->get_album_by_id($song["album_id"]);
        } else {
            $album = null;
        }
        $data["album"] = $album;
        // var_dump($data);

        $this->view('template/header', $data);
        $this->view('template/navbar', $data);
        $this->view('song/detail_song', $data);
        $this->view('template/footer', $data);
    }

    public function edit($id) {
        session_start();
        if (isset($_SESSION['user_id']) && $_SESSION['isAdmin'] == 1) { 
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // var_dump($_POST);
                if (isset($_POST['judul']) && isset($_POST['tanggal_terbit']) && isset($_POST['genre'])) {
                    $judul = $_POST['judul'];
                    $tanggal_terbit = $_POST['tanggal_terbit'];
                    $genre = $_POST['genre'];

                    if (empty($judul)) {
                        $data['error'] = 'Judul is required';

                        $song = $this->model('songmodel')->get_song_by_song_id($id);
    
                        $data["title"] = "Edit song";
                        $data["song"] = $song;

                        $this->view('template/header', $data);
                        $this->view('template/navbar', $data);
                        $this->view('song/edit_song', $data);
                        $this->view('template/footer', $data);
    
                    } elseif (empty($tanggal_terbit)) {
                        $data['error'] = 'Tanggal Terbit is required';

                        $song = $this->model('songmodel')->get_song_by_song_id($id);
    
                        $data["title"] = "Edit song";
                        $data["song"] = $song;

                        $this->view('template/header', $data);
                        $this->view('template/navbar', $data);
                        $this->view('song/edit_song', $data);
                        $this->view('template/footer', $data);

                    } elseif (empty($genre)) {
                        $data['error'] = 'Genre is required';

                        $song = $this->model('songmodel')->get_song_by_song_id($id);
    
                        $data["title"] = "Edit song";
                        $data["song"] = $song;

                        $this->view('template/header', $data);
                        $this->view('template/navbar', $data);
                        $this->view('song/edit_song', $data);
                        $this->view('template/footer', $data);

                    } else {
                        if (isset($_FILES['foto']) && $_FILES["foto"]["error"] == 0) {
                            $song = $this->model('songmodel')->get_song_by_song_id($id);
                            $foto = $_FILES['foto'];
                            $image_path = 'audio_images/' . uniqid() . '-' . str_replace("'", "", $foto['name']);
                            $path_to_save = $this->assets() . $image_path;

                            if (unlink(getcwd() . "/assets//" . $song["Image_path"]) && move_uploaded_file($foto['tmp_name'], $path_to_save)) {
                                $success_update = $this->model('songmodel')->update($id, $judul, null, $tanggal_terbit, $genre, null, null, $image_path, null);
    
                                if ($success_update) {
                                    $data['success'] = 'Tambah song sukses';
                                    $song = $this->model('songmodel')->get_song_by_song_id($id);
    
                                    $data["title"] = "Edit song";
                                    $data["song"] = $song;

                                    $this->view('template/header', $data);
                                    $this->view('template/navbar', $data);
                                    $this->view('song/edit_song', $data);
                                    $this->view('template/footer', $data);
                                } else {
                                    $data['error'] = 'Tambah song gagal. Silahkan coba lagi';
                                    $song = $this->model('songmodel')->get_song_by_song_id($id);
    
                                    $data["title"] = "Edit song";
                                    $data["song"] = $song;

                                    $this->view('template/header', $data);
                                    $this->view('template/navbar', $data);
                                    $this->view('song/edit_song', $data);
                                    $this->view('template/footer', $data);
                                }
                            } else {
                                $data['error'] = 'Tambah song gagal. Silahkan coba lagi';
                                $song = $this->model('songmodel')->get_song_by_song_id($id);
    
                                $data["title"] = "Edit song";
                                $data["song"] = $song;

                                $this->view('template/header', $data);
                                $this->view('template/navbar', $data);
                                $this->view('song/edit_song', $data);
                                $this->view('template/footer', $data);
                            }
                        } else {
                            $success_update = $this->model('songmodel')->update($id, $judul, null, $tanggal_terbit, $genre, null, null, null, null);
                            
                            if ($success_update) {
                                $data['success'] = 'Edit song sukses';
                                $song = $this->model('songmodel')->get_song_by_song_id($id);
    
                                $data["title"] = "Edit song";
                                $data["song"] = $song;
                                
                                $this->view('template/header', $data);
                                $this->view('template/navbar', $data);
                                $this->view('song/edit_song', $data);
                                $this->view('template/footer', $data);
                            } else {
                                $data['error'] = 'Edit song gagal. Silahkan coba lagi';
    
                                $song = $this->model('songmodel')->get_song_by_song_id($id);
    
                                $data["title"] = "Edit song";
                                $data["song"] = $song;
                                
                                $this->view('template/header', $data);
                                $this->view('template/navbar', $data);
                                $this->view('song/edit_song', $data);
                                $this->view('template/footer', $data);
                            }
    
                        }

                    }
                }
            } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $song = $this->model('songmodel')->get_song_by_song_id($id);

                $data["title"] = "Edit song";
                $data["song"] = $song;

                $this->view('template/header', $data);
                $this->view('template/navbar', $data);
                $this->view('song/edit_song', $data);
                $this->view('template/footer', $data);
            }
        } else {
            header("Location: ". BASE_PUBLIC_URL);
        }
    }

    public function delete($id) {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') { 
            if (isset($_SESSION['user_id']) && $_SESSION['isAdmin'] == 1) { 
                $song = $this->model('songmodel')->get_song_by_song_id($id);

                $success_delete = $this->model('songmodel')->delete_song_by_song_id($id);
                if ($success_delete) {
                    if ($song["album_id"] != null) {
                        $success_decrease = $this->model('albummodel')->decrease_album_duration_by_album_id($song["album_id"], $song["Duration"]);
                    }

                    unlink(getcwd() . "/assets//" . $song["Image_path"]);
                    unlink(getcwd() . "/assets//" . $song["Audio_path"]);
                    http_response_code(200);
                    $data["message"] = "Delete successful";
                    // $data["test"] = $success_delete;
                    echo json_encode($data);
                } else {
                    http_response_code(400);
                    $data["error"] = "Delete failed";
                    echo json_encode($data);
                }
            } else {
                http_response_code(401);
                $data["error"] = "You are not unauthorized";
                echo json_encode($data);
            }
        } else {
            http_response_code(404);
            $data["error"] = "This url does not exist";
            echo json_encode($data);
        }

    }

}

?>