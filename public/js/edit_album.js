const album_edit_image_input = document.querySelector("#album_edit_image_input");

if (album_edit_image_input != null) {
  album_edit_image_input.addEventListener("change", function() {
    const reader = new FileReader();
    reader.addEventListener("load", () => {
      const uploaded_image = reader.result;
      document.querySelector(".album-edit-image").src = uploaded_image;
      // console.log(`url(${uploaded_image})`);
    });
    reader.readAsDataURL(this.files[0]);
  });
}

let album_edit_audio_input = document.querySelector("#album_edit_audio_input");
let album_edit_audio_element = document.querySelector("#album_edit_audio_element");
let edit_album_button = document.querySelector(".edit-album-button");

// edit_album_button.addEventListener("click", function () {
//   console.log(album_edit_audio_element.duration);
// })
// console.log(album_edit_audio_element.duration);

if (album_edit_audio_input != null) {
  album_edit_audio_input.addEventListener("change", function() {
    var audio_source = document.querySelector('.audio_source');
    audio_source.src = URL.createObjectURL(this.files[0]);
    // not really needed in this exact case, but since it is really important in other cases,
    // don't forget to revoke the blobURI when you don't need it
    // audio_source.onend = function(e) {
    //   URL.revokeObjectURL(this.src);
    // }
    album_edit_audio_element.load();
  });
}

