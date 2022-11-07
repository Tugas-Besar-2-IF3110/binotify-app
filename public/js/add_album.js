const album_add_image_input = document.querySelector("#album_add_image_input");

if (album_add_image_input != null) {
  album_add_image_input.addEventListener("change", function() {
    const reader = new FileReader();
    reader.addEventListener("load", () => {
      const uploaded_image = reader.result;
      document.querySelector(".album-add-image").src = uploaded_image;
    });
    reader.readAsDataURL(this.files[0]);
  });
}