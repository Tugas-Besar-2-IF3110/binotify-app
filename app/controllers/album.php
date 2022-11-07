<?php

class Album extends Controller {
    public function add_album() {
        session_start();
        if (isset($_SESSION['user_id']) && $_SESSION['isAdmin'] == 1) { 
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                if (isset($_POST['judul']) && isset($_POST['penyanyi']) && isset($_FILES['foto']) && isset($_POST['tanggal_terbit']) && isset($_POST['genre'])) {
                    $judul = $_POST['judul'];
                    $penyanyi = $_POST['penyanyi'];
                    $foto = $_FILES['foto'];
                    $tanggal_terbit = $_POST['tanggal_terbit'];
                    $genre = $_POST['genre'];

                    if (empty($judul)) {
                        $data['error'] = 'Judul is required';
                        $data["title"] = "Add Album";

                        $this->view('template/header', $data);
                        $this->view('template/navbar', $data);
                        $this->view('album/add_album', $data);
                        $this->view('template/footer', $data);

                    } else if (empty($penyanyi)) {
                        $data['error'] = 'Penyanyi is required';
                        $data["title"] = "Add Album";

                        $this->view('template/header', $data);
                        $this->view('template/navbar', $data);
                        $this->view('album/add_album', $data);
                        $this->view('template/footer', $data);

                    } else if (empty($foto['name'])) {
                        $data['error'] = 'Foto is required';
                        $data["title"] = "Add Album";

                        $this->view('template/header', $data);
                        $this->view('template/navbar', $data);
                        $this->view('album/add_album', $data);
                        $this->view('template/footer', $data);
                        
                    } else if (empty($tanggal_terbit)) {
                        $data['error'] = 'Tanggal terbit is required';
                        $data["title"] = "Add Album";

                        $this->view('template/header', $data);
                        $this->view('template/navbar', $data);
                        $this->view('album/add_album', $data);
                        $this->view('template/footer', $data);
                        
                    } else {
                        $foto['name'] = str_replace("'", "", $foto['name']);
                        $image_path = 'album_images/' . uniqid() . '-' . str_replace("'", "", $foto['name']);
                        $path_to_save = $this->assets() . $image_path;
                        if (move_uploaded_file($foto['tmp_name'], $path_to_save)) {
                            $success_insert = $this->model('albummodel')->insert($judul, $penyanyi, $image_path, $tanggal_terbit, $genre);

                            if ($success_insert) {
                                $data['success'] = 'Tambah album sukses';
                                $data["title"] = "Add Album";

                                $this->view('template/header', $data);
                                $this->view('template/navbar', $data);
                                $this->view('album/add_album', $data);
                                $this->view('template/footer', $data);
                            } else {
                                $data['error'] = 'Tambah album gagal. Silahkan coba lagi';
                                $data["title"] = "Add Album";

                                $this->view('template/header', $data);
                                $this->view('template/navbar', $data);
                                $this->view('album/add_album', $data);
                                $this->view('template/footer', $data);
                            }
                        } else {
                            $data['error'] = 'Tambah album gagal. Silahkan coba lagi';
                            $data["title"] = "Add Album";

                            $this->view('template/header', $data);
                            $this->view('template/navbar', $data);
                            $this->view('album/add_album', $data);
                            $this->view('template/footer', $data);
                        }
                    }
                } else {
                    $data["title"] = "Add Album";

                    $this->view('template/header', $data);
                    $this->view('template/navbar', $data);
                    $this->view('album/add_album', $data);
                    $this->view('template/footer', $data);
                }
            } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $data["title"] = "Add Album";

                $this->view('template/header', $data);
                $this->view('template/navbar', $data);
                $this->view('album/add_album', $data);
                $this->view('template/footer', $data);
            }
        } else {
            header("Location: ". BASE_PUBLIC_URL);
        }
    }

    public function get_album() {
        $album = $this->model('albummodel')->get_all_album();
        $this->view('album/daftar_album', $album);
    }

    public function get_album_by_penyanyi() {
        // if (isset($_GET)) {
        //     foreach ($_GET as $penyanyi) {
        //         $album_list = $this->model('albummodel')->get_by_penyanyi($penyanyi);
        //         echo json_encode($album_list);
        //     }
        // }
        if (isset($_GET) && isset($_GET["penyanyi"])) {
            $album_list = $this->model('albummodel')->get_by_penyanyi($_GET["penyanyi"]);
            echo json_encode($album_list);
        }
    }

    public function detail($id) {
        session_start();
        $album = $this->model('albummodel')->get_album_by_id($id);

        $songs = $this->model('songmodel')->get_songs_by_album_id($id);

        include $this->utility('timeformat');
        for ($i = 0; $i < count($songs); $i++) {
            $songs[$i]['Duration'] = (new changeFormat($songs[$i]['Duration']))->getTimeCodeFromNum();
        }

        $album['Total_duration'] = (new changeFormat($album['Total_duration']))->getTimeCodeFromNumAlbum();

        $data["title"] = "Detail Album";
        $data["album"] = $album;
        $data["songs"] = $songs;
        $data["album"]["num_of_songs"] = count($songs);

        $this->view('template/header', $data);
        $this->view('template/navbar', $data);
        $this->view('album/detail_album', $data);
        $this->view('template/footer', $data);
    }

    public function edit($id) {
        session_start();
        if (isset($_SESSION['user_id']) && $_SESSION['isAdmin'] == 1) { 
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // var_dump($_POST);
                if (isset($_POST['judul'])) {
                    $judul = $_POST['judul'];
                    $tanggal_terbit = $_POST['tanggal_terbit'];
                    if (empty($judul)) {
                        $data['error'] = 'Judul is required';

                        $album = $this->model('albummodel')->get_album_by_id($id);
    
                        $data["title"] = "Edit Album";
                        $data["album"] = $album;

                        $this->view('template/header', $data);
                        $this->view('template/navbar', $data);
                        $this->view('album/edit_album', $data);
                        $this->view('template/footer', $data);
    
                    } else {
                        if (isset($_FILES['foto']) && $_FILES["foto"]["error"] == 0) {
                            $album = $this->model('albummodel')->get_album_by_id($id);

                            $foto = $_FILES['foto'];
                            $image_path = 'album_images/' . uniqid() . '-' . str_replace("'", "", $foto['name']);
                            $path_to_save = $this->assets() . $image_path;

                            if (unlink(getcwd() . "/assets//" . $album["Image_path"]) && move_uploaded_file($foto['tmp_name'], $path_to_save)) {
                                $success_update = $this->model('albummodel')->update($id, $judul, null, $image_path, $tanggal_terbit, null);
    
                                if ($success_update) {
                                    $data['success'] = 'Edit album sukses';
                                    $album = $this->model('albummodel')->get_album_by_id($id);
    
                                    $data["title"] = "Edit Album";
                                    $data["album"] = $album;

                                    $this->view('template/header', $data);
                                    $this->view('template/navbar', $data);
                                    $this->view('album/edit_album', $data);
                                    $this->view('template/footer', $data);
                                } else {
                                    $data['error'] = 'Edit album gagal. Silahkan coba lagi';
                                    $album = $this->model('albummodel')->get_album_by_id($id);
    
                                    $data["title"] = "Edit Album";
                                    $data["album"] = $album;

                                    $this->view('template/header', $data);
                                    $this->view('template/navbar', $data);
                                    $this->view('album/edit_album', $data);
                                    $this->view('template/footer', $data);
                                }
                            } else {
                                $data['error'] = 'Edit album gagal. Silahkan coba lagi';
                                $album = $this->model('albummodel')->get_album_by_id($id);
    
                                $data["title"] = "Edit Album";
                                $data["album"] = $album;

                                $this->view('template/header', $data);
                                $this->view('template/navbar', $data);
                                $this->view('album/edit_album', $data);
                                $this->view('template/footer', $data);
                            }
                        } else {
                            $success_update = $this->model('albummodel')->update($id, $judul, null, null, $tanggal_terbit, null);
                            
                            if ($success_update) {
                                $data['success'] = 'Edit album sukses';
                                $album = $this->model('albummodel')->get_album_by_id($id);
    
                                $data["title"] = "Edit Album";
                                $data["album"] = $album;
                                
                                $this->view('template/header', $data);
                                $this->view('template/navbar', $data);
                                $this->view('album/edit_album', $data);
                                $this->view('template/footer', $data);
                            } else {
                                $data['error'] = 'Edit album gagal. Silahkan coba lagi';
    
                                $album = $this->model('albummodel')->get_album_by_id($id);
    
                                $data["title"] = "Edit Album";
                                $data["album"] = $album;
                                
                                $this->view('template/header', $data);
                                $this->view('template/navbar', $data);
                                $this->view('album/edit_album', $data);
                                $this->view('template/footer', $data);
                            }
    
                        }

                    }
                }
            } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $album = $this->model('albummodel')->get_album_by_id($id);

                $data["title"] = "Edit Album";
                $data["album"] = $album;

                $this->view('template/header', $data);
                $this->view('template/navbar', $data);
                $this->view('album/edit_album', $data);
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
                $album = $this->model('albummodel')->get_album_by_id($id);
                $songs = $this->model('songmodel')->get_songs_by_album_id($id);

                $success_delete = $this->model('albummodel')->delete_album_by_album_id($id);
                if ($success_delete) {
                    unlink(getcwd() . "/assets//" . $album["Image_path"]);
                    
                    foreach($songs as $song) {
                        unlink(getcwd() . "/assets//" . $song["Image_path"]);
                        unlink(getcwd() . "/assets//" . $song["Audio_path"]);
                    }

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