<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="css/navbar.css" type="text/css" rel="stylesheet" />
    <link href="css/home.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <?php include('./template/navbar.php') ?>
        <div class="home-full">
            <h2 class= "judul-home"> Daftar Lagu Terbaru <span id="UN-home"><?php
                if (!empty($data['username'])) {
                    echo $data['username'];
                }
            ?></span></h2>
            <div class="home">
                <?php for ($i = 0; $i < count($data['song']); $i++) { ?>
                    <a class="column" href='song/detail/<?php echo $data['song'][$i]['song_id']?>'>
                        <div class="round_button" onclick="click_play_button(<?php echo $i ?>)">
                            <div class="arrow_right"></div>
                        </div>
                        <img class = "song_photo" src="assets/<?php echo $data['song'][$i]['Image_path']?>">
                        <div class="song_section_2">
                            <div class="title_singer">
                                <p class= "song_title"><?php echo $data['song'][$i]['Judul']?></p>
                                <p class= "song_singer"><?php echo $data['song'][$i]['Penyanyi']?></p>
                                <p class= "year_genre"><?php echo explode('-', $data['song'][$i]['Tanggal_terbit'])[0]?> • <?php echo $data['song'][$i]['Genre']?></p>
                            </div>
                        </div>
                    </a>
                <?php }?>
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
    </div>
</body>
</html>

<script type="text/javascript">
    song_click = document.getElementById('song_click');
    audio_playing = document.getElementById('audio-playing');
    current_play_idx = -1;
    login = <?php echo $data['login'] ?>;
    listen_count = <?php echo $data['listen_count']?>;
    const button = document.getElementsByClassName('round_button');

    for (let i = 0; i < button.length; i++){
        button[i].addEventListener('click', function (e) { 
            e.preventDefault();
        });
    }

    function click_play_button(song_idx) {
        if (can_listen_song()) {
            if (current_play_idx != song_idx) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var now_playing = document.getElementById("now-playing")
                        response = JSON.parse(xhr.response);
                        if (window.getComputedStyle(now_playing).visibility === "hidden"){
                            now_playing.style.visibility = "visible";
                        }
                        document.getElementById("image-playing").src = "assets/" + response.Image_path;
                        document.getElementById("audio-playing").src = "assets/" + response.Audio_path;
                        document.getElementById("title-playing").innerHTML = response.Judul;
                        document.getElementById("penyanyi-playing").innerHTML = response.Penyanyi;
                        current_play_idx = song_idx;
                        if (!login) {
                            update_count_listen();
                        }
                    }
                };
                xhr.open('GET', "home?index=" + song_idx, true);
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
