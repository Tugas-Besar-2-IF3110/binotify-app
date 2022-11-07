<div class="wrapper-add-album">
    <div class="album-add-block-upper">
        <div class="album-add-text">
            <p class="album-add-title">Tambah Album</p>
        </div>
    </div>
    <div class="album-add-block-middle">
        <form class="add-album-form" method="post" action="<?php echo BASE_PUBLIC_URL . "/album/add_album"?>" enctype="multipart/form-data">
            <label class="label-add-album">Judul</label>
            <input type="text" placeholder="Judul Album" name="judul"/>
            
            <label class="label-add-album">Penyanyi</label>
            <input type="text" placeholder="Penyanyi Album" name="penyanyi"/>

            <label class="label-add-album">Album Cover</label>
            <br></br>
            <img class="album-add-image">
            <input type="file" placeholder="Album Cover" name="foto" id="album_add_image_input" accept="image/*"/>
            
            <label class="label-add-album">Tanggal Terbit</label>
            <input type="date" placeholder="Tanggal Terbit" name="tanggal_terbit"/>

            <label class="label-add-album">Genre</label>
            <input type="text" placeholder="Genre Album" name="genre"/>
            
            <div class="buttonOrMessageHolder">
                <?php if (isset($data['error'])) { ?>
                    <p class="error album-add-message"><?php echo $data['error']; ?></p>
                <?php } ?>
                    
                <?php if (isset($data['success'])) { ?>
                    <p class="success album-add-message"><?php echo $data['success']; ?></p>
                <?php } ?>
            </div>

            <div class="buttonOrMessageHolder">
                <button class="add-album-button" type="submit">Save</button>
            </div>

        </form>
    </div>
</div>