<div class="wrapper-edit-song">
    <div class="song-edit-block-upper">
        <div class="song-edit-text">
            <p class="song-edit-title">Edit Lagu</p>
        </div>
    </div>
    <div class="song-edit-block-middle">
        <form class="edit-song-form" method="post" action="<?php echo BASE_PUBLIC_URL . "/song/edit/".$data["song"]["song_id"] ?>" enctype="multipart/form-data">
            <label class="label-edit-song">Judul</label>
            <input type="text" placeholder="Judul Lagu" name="judul" value="<?php echo $data["song"]["Judul"] ?>"/>

            <label class="label-edit-song">Tanggal Terbit</label>
            <input type="date" placeholder="Tanggal Terbit Lagu" name="tanggal_terbit" value="<?php echo $data["song"]["Tanggal_terbit"] ?>"/>
            
            <label class="label-edit-song">Song Cover</label>
            <br></br>
            <img class="song-edit-image" src="<?php echo BASE_PUBLIC_URL . "/assets//" . $data['song']['Image_path']; ?>">
            <input type="file" placeholder="Song Cover" name="foto" id="song_edit_image_input" accept="image/*"/>
            
            <label class="label-edit-song">Genre</label>
            <input type="text" placeholder="Genre Lagu" name="genre" value="<?php echo $data["song"]["Genre"] ?>"/>

            <div class="buttonOrMessageHolder">
                <?php if (isset($data['error'])) { ?>
                    <p class="error song-edit-message"><?php echo $data['error']; ?></p>
                <?php } ?>
                    
                <?php if (isset($data['success'])) { ?>
                    <p class="success song-edit-message"><?php echo $data['success']; ?></p>
                <?php } ?>
            </div>

            <div class="buttonOrMessageHolder">
                <button class="edit-song-button" type="submit">Save</button>
            </div>

        </form>
    </div>
</div>