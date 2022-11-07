const song_edit_image_input = document.querySelector("#song_edit_image_input");

if (song_edit_image_input) {
  song_edit_image_input.addEventListener("change", function() {
    const reader = new FileReader();
    reader.addEventListener("load", () => {
      const uploaded_image = reader.result;
      document.querySelector(".song-edit-image").src = uploaded_image;
      // console.log(`url(${uploaded_image})`);
    });
    reader.readAsDataURL(this.files[0]);
  });
}