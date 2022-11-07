let album_detail_button_delete = document.querySelector(".album-detail-button-delete");

if (album_detail_button_delete != null) {
    album_detail_button_delete.addEventListener("click", function () {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert("Delete album successful.");
                window.location = "../../";
            } else if (xhr.readyState == 4 && xhr.status != 200) {
                alert("Delete album failed.");
            }
        };
        xhr.open('DELETE', "../delete/" + album_detail_button_delete.id, true);
        xhr.send();
    });
}