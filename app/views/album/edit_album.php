 <div class="wrapper-edit-album">
    <div class="album-edit-block-upper">
        <div class="album-edit-text">
            <p class="album-edit-title">Edit Album</p>
        </div>
    </div>
    <div class="album-edit-block-middle">
        <form class="edit-album-form" method="post" action="<?php echo BASE_PUBLIC_URL . "/album/edit/".$data["album"]["album_id"] ?>" enctype="multipart/form-data">
            <label class="label-edit-album">Judul</label>
            <input type="text" placeholder="Judul Album" name="judul" value="<?php echo $data["album"]["Judul"] ?>"/>

            <label class="label-edit-album">Tanggal Terbit</label>
            <input type="date" placeholder="Tanggal Terbit Album" name="tanggal_terbit" value="<?php echo $data["album"]["Tanggal_terbit"] ?>"/>
            
            <label class="label-edit-album">Album Cover</label>
            <br></br>
            <img class="album-edit-image" src="<?php echo BASE_PUBLIC_URL . "/assets//" . $data['album']['Image_path']; ?>">
            <input type="file" placeholder="Album Cover" name="foto" id="album_edit_image_input" accept="image/*"/>
            
            <div class="buttonOrMessageHolder">
                <?php if (isset($data['error'])) { ?>
                    <p class="error album-edit-message"><?php echo $data['error']; ?></p>
                <?php } ?>
                    
                <?php if (isset($data['success'])) { ?>
                    <p class="success album-edit-message"><?php echo $data['success']; ?></p>
                <?php } ?>
            </div>

            <div class="buttonOrMessageHolder">
                <button class="edit-album-button" type="submit">Save</button>
            </div>

        </form>
    </div>
</div>