<?php

class Search extends Controller {
    public function index() {
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
        $data['filter'] = $this->model('songmodel')->get_genre_list();
        $this->view('search/search_song', $data);
    }

    public function search_song() {
        $search_value =  $_GET['search_value'];
        if (isset($_GET['filter'])) {
            $filter = $_GET['filter'];
        } else {
            $filter = '';
        }
        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
            $asc_desc = $_GET['asc_desc'];
        } else {
            $sort = '';
            $asc_desc = '';
        }

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = '';
        }

        // $song = $this->model('songmodel')->get_song_by_search_filter_sort_page($search_value, $filter, $sort, $page);
        $song = $this->model('songmodel')->get_song_by_search_filter_sort_page($search_value, $filter, $sort, $asc_desc, $page);
        echo json_encode($song);
    }
}

?>