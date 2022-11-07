let song_detail_button_delete = document.querySelector(".song-detail-button-delete");
let detail_song_audio = document.querySelector(".detail-song-audio");
let detail_song_played = false;

if (document.querySelector(".detail-song-login") != null) {
    detail_song_login = document.querySelector(".detail-song-login").value;
}
if (document.querySelector(".detail-song-listen-count") != null) {
    detail_song_listen_count = document.querySelector(".detail-song-listen-count").value;
}

if (song_detail_button_delete != null) {
    song_detail_button_delete.addEventListener("click", function () {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert("Delete song successful.");
                window.location = "../../";
            } else if (xhr.readyState == 4 && xhr.status != 200) {
                alert("Delete song failed.");
            }
        };
        xhr.open('DELETE', "../delete/" + song_detail_button_delete.id, true);
        xhr.send();
    });
}

function detail_song_click_play_button(){
    if (can_listen_song()) {
        audio_playing = document.getElementById('detail-song-audio-playing');
        var now_playing = document.getElementById("detail-song-now-playing")
        if (window.getComputedStyle(now_playing).visibility === "hidden"){
            now_playing.style.visibility = "visible";
        }
        if (audio_playing.paused) {
            audio_playing.play();
        } else {
            audio_playing.pause();
        }
        if (!detail_song_played) {
            update_count_listen();
            detail_song_played = true;
        }
    } else {
        alert('Anda sudah mendegarkan lagu 3x hari ini. Silahkan login atau registrasi untuk mendengarkan lagu lainnya');
    }
}

function can_listen_song() {
    if (detail_song_login == 0) {
        return (detail_song_listen_count < 3) || detail_song_played;
    } else {
        return true;
    }
}

function update_count_listen() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            detail_song_listen_count = xhr.response;
        }
    }
    xhr.open('GET', "../../song/listen", true);
    xhr.send();
}