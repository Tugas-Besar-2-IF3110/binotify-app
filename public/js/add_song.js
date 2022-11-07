const song_add_image_input = document.querySelector("#song_add_image_input");
let song_add_audio_input = document.querySelector("#song_add_audio_input");
let song_add_audio = document.querySelector(".song-add-audio");
let add_song_button = document.querySelector(".add-song-button");
let audio_duration_input = document.querySelector("#audio_duration_input");
let add_song_input_penyanyi = document.querySelector("#add_song_input_penyanyi");
let add_song_input_album = document.querySelector("#add_song_input_album");
let add_song_default_album_option = document.querySelector("#add_song_default_album_option");

function debounce(func, timeout = 320) {
  let timer;
  return (...args) => {
      clearTimeout(timer);
      timer = setTimeout(() => {
          func.apply(this, args);
      }, timeout);
  }
}

if (song_add_image_input != null) {
  song_add_image_input.addEventListener("change", function() {
    const reader = new FileReader();
    reader.addEventListener("load", () => {
      const uploaded_image = reader.result;
      document.querySelector(".song-add-image").src = uploaded_image;
      // console.log(`url(${uploaded_image})`);
    });
    reader.readAsDataURL(this.files[0]);
  });
}

// if (add_song_button != null) {
//   add_song_button.addEventListener("click", function () {
//     console.log(audio_duration_input.value);
//   })
// }

if (song_add_audio != null) {
  song_add_audio.addEventListener("canplaythrough", function() {
    audio_duration_input.value = Math.floor(this.duration);
  });
}

if (song_add_audio_input != null) {
  song_add_audio_input.addEventListener("change", function() {
    var audio_source = document.querySelector('.song-add-audio-source');
    audio_source.src = URL.createObjectURL(this.files[0]);
    song_add_audio.load();
  });
}

add_song_input_penyanyi.addEventListener('keyup', debounce(function() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
          add_song_default_album_option.style.visibility = "hidden";
          album_list = JSON.parse(xhr.response);
          while (add_song_input_album.options.length > 1) {
              add_song_input_album.remove(1);
          }
          for (let i = 0; i < album_list.length; i++) {
              add_song_input_album.appendChild(new Option(album_list[i].Judul, album_list[i].album_id));
          }
      }
  };
  xhr.open('GET', `../album/get_album_by_penyanyi?penyanyi=${add_song_input_penyanyi.value}`, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send();
}));