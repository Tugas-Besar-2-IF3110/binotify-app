<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Search Page</title>
        <link href="css/navbar.css" type="text/css" rel="stylesheet" />
        <link href="css/search.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <?php include('./template/navbar.php') ?>
            <div class="search-home">
                <div class="ssf">
                    <form class="search-input" method="post">
                        <input class="search" id="search" type="text" placeholder="Search" name="name"><br>
                    </form>
                    <p id="filter-by">Filter by:</p>
                    <select id="filter">
                        <option selected hidden></option>
                        <?php for ($i = 0; $i < count($data['filter']); $i++) { ?>
                            <?php if ($data['filter'][$i]['Genre'] != '') { ?>
                                <option value=<?php echo $data['filter'][$i]['Genre']?>><?php echo $data['filter'][$i]['Genre']?></option>
                            <?php } ?>
                        <?php }?>
                    </select>
                    <p id="sort-by">Sort by:</p>
                    <select id="sort">
                        <option selected hidden></option>
                        <option value="abjad">Abjad</option>
                        <option value="tahun">Tahun terbit</option>
                    </select>
                    <select id="asc-desc">
                    </select>
                    <button class="button" id="reset-button" type="submit">Reset</button>
                    <button class="button" id="search-button" type="submit">Search</button>
                </div>
                <div class="search-pagination-wrapper">
                    
                <div class="pagination">
                    <div class="pagination-block">
                        <!-- <span id="page_number" class="outline-none pageButton"><</span>
                        <span id="page_number" class="outline-none page_number">1</span>
                        <span id="page_number" class="outline-none page_number">2</span>
                        <span id="page_number" class="outline-none page_number">3</span>
                        <span id="page_number" class="outline-none page_number" >4</span>
                        <span id="page_number" class="outline-none page_number" >5</span>
                        <span id="page_number" class="outline-none page_number" >6</span>
                        <span id="page_number" class="outline-none page_number" >7</span>
                        <span id="page_number" class="outline-none page_number" >8</span>
                        <span id="page_number" class="outline-none page_number" >9</span>
                        <span id="page_number" class="outline-none page_number" >10</span>
                        <span class="pageButton outline-none" id="button_next">></span> -->
                    </div>
                </div>
                </div>
                <div class="search-body" id="data">
                </div>
            </div>
        </div>
        <div id="now-playing">
            <img id="image-playing" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D">
            <div id="word-playing">
                <p id="title-playing">Song Title</p> 
                <h5 id="penyanyi-playing">Singer</h5>
            </div>
            <div class="audio-container">
                <audio id="audio-playing" type="audio/mpeg" controls autoplay controlsList="nodownload"></audio>
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">
    data = document.getElementById('data');
    search = document.getElementById('search');
    filter = document.getElementById('filter');
    sort = document.getElementById('sort');
    asc_desc = document.getElementById('asc-desc');
    search_button = document.getElementById('search-button');
    reset_button = document.getElementById('reset-button');
    search_pagination_wrapper = document.querySelector('.search-pagination-wrapper');
    num_of_pages = 0;
    current_page = 0;
    
    reset_button.addEventListener('click', function() {
        data.innerHTML = '';
        search.value = '';
        filter.value = '';
        sort.value = '';
        while (asc_desc.options.length > 0) {
            asc_desc.remove(0);
        }
    });

    sort.addEventListener('change', function() {
        while (asc_desc.options.length > 0) {
            asc_desc.remove(0);
        }
        asc_desc.appendChild(new Option("Asc", "asc"));
        asc_desc.appendChild(new Option("Desc", "desc"));
    });

    search_button.addEventListener('click', function() {
        searchSong(search.value);
    });

    search.addEventListener("keypress", function(e) {
        if (e.key === "Enter") {
            e.preventDefault();
            searchSong(search.value);
        }
    });

    const searchSong = (value, page = 0) => {
        url = `<?php echo BASE_PUBLIC_URL ?>/search/search_song?search_value=${value}`;
        if (filter.value != '') {
            url += `&filter=${filter.value}`;
        }
        if (sort.value != '') {
            url += `&sort=${sort.value}&asc_desc=${asc_desc.value}`;
        }
        
        url += `&page=${page}`;
        data.innerHTML = "";
        if (value.length > 0) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    resp = JSON.parse(xhr.response);
                    num_of_pages = resp["num_of_pages"];
                    current_page = resp["current_page"];
                    response = resp["songs"];

                    for (let i = 0; i < response.length; i++) {
                        data.innerHTML += 
                        `<a class="column" href='song/detail/${response[i].song_id}'>
                            <div class="round_button" onclick="click_play_button(${response[i].song_id})">
                                <div class="arrow_right"></div>
                            </div>
                            <img class = "song_photo" src="<?php echo BASE_PUBLIC_URL ?>/assets/${response[i].Image_path}">
                            <div class="song_section_2">
                                <div class="title_singer">
                                    <p class= "song_title">${response[i].Judul}</p>
                                    <p class= "song_singer">${response[i].Penyanyi}</p>
                                    <p class= "year_genre">${response[i].Tanggal_terbit.split('-')[0]} • ${response[i].Genre}</p>
                                </div>
                            </div>
                        </a>`
                    }
                    let pagination_block = document.querySelector(".pagination-block");
                    pagination_block.innerHTML = '';
                    if (resp.num_of_pages <= 5) {
                        for (let i = 0; i < resp.num_of_pages; i++) {
                            if (i == resp.current_page) {
                                pagination_block.innerHTML += `<span id="${i}" class="page_number outline-none clickPageNumber" >${i + 1}</span>`
                            } else {
                                pagination_block.innerHTML += `<span id="${i}" class="page_number outline-none page_number_not_click" >${i + 1}</span>`
                            }
                        }
                    } else {
                        if (resp.current_page >= 3) {
                            pagination_block.innerHTML += `<span id="${resp.current_page - 1}" class="page_number outline-none pageButton"><</span>`
                        }
                        let start_page = 0;

                        if (resp.current_page <= 2) {
                            start_page = 0;
                        } else if (resp.num_of_pages - resp.current_page <= 3) {
                            start_page = resp.num_of_pages - 5;
                        } else {
                            start_page = resp.current_page - 2;
                        }

                        for (let i = start_page; i < start_page + 5; i++) {
                            if (i == resp.current_page) {
                                pagination_block.innerHTML += `<span id="${i}" class="page_number outline-none clickPageNumber" >${i + 1}</span>`
                            } else {
                                pagination_block.innerHTML += `<span id="${i}" class="page_number outline-none page_number_not_click" >${i + 1}</span>`
                            }
                        }
                        if (resp.num_of_pages - resp.current_page > 3) {
                            pagination_block.innerHTML += `<span id="${resp.current_page + 1}" class="page_number outline-none pageButton">></span>`
                        }
                    }

                    let page_number_elements = document.querySelectorAll(".page_number");

                    page_number_elements.forEach(page_number_element => {
                        page_number_element.addEventListener('click', function() {
                            searchSong(search.value, this.id);
                        });
                    })

                    const button = document.getElementsByClassName('round_button');

                    for (let i = 0; i < button.length; i++){

                        button[i].addEventListener('click', function (e) { 
                            e.preventDefault();
                        });
                    }
                }
            };
            xhr.open('GET', url, true);
            xhr.send();
        }
    }

    song_click = document.getElementById('song_click');
    audio_playing = document.getElementById('audio-playing');
    current_play_id = -1;
    login = <?php echo $data['login'] ?>;
    listen_count = <?php echo $data['listen_count']?>;

    function click_play_button(song_id) {
        if (can_listen_song()) {
            console.log(listen_count);
            if (current_play_id != song_id) {
                url = `<?php echo BASE_PUBLIC_URL ?>/song/get_song_by_id?song_id=${song_id}`;
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var now_playing = document.getElementById("now-playing")
                        response = JSON.parse(xhr.response);
                        if (window.getComputedStyle(now_playing).visibility === "hidden"){
                            now_playing.style.visibility = "visible";
                        }
                        document.getElementById("image-playing").src = "./assets/" + response.Image_path;
                        document.getElementById("audio-playing").src = "./assets/" + response.Audio_path;
                        document.getElementById("title-playing").innerHTML = response.Judul;
                        document.getElementById("penyanyi-playing").innerHTML = response.Penyanyi;
                        current_play_id = song_id;
                        if (!login) {
                            update_count_listen();
                        }
                    }
                };
                xhr.open('GET', url, true);
                xhr.send();
            } else {
                if (audio_playing.paused) {
                    audio_playing.play();
                } else {
                    audio_playing.pause();
                }
            }
        } else {
            alert('Anda sudah mendegarkan lagu 3x hari ini. Silahkan login atau registrasi untuk mendengarkan lagu lainnya');
        }
    }

    function can_listen_song() {
        if (!login) {
            return listen_count < 3;
        } else {
            return true;
        }
    }

    function update_count_listen() {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                listen_count = xhr.response;
            }
        }
        xhr.open('GET', "song/listen", true);
        xhr.send();
    }
</script>