<div class="wrapper-add-song">
    <div class="song-add-block-upper">
        <div class="song-add-text">
            <p class="song-add-title">Tambah Lagu</p>
        </div>
    </div>
    <div class="song-add-block-middle">
        <form class="add-song-form" method="post" action="<?php echo BASE_PUBLIC_URL . "/song/add_song"?>" enctype="multipart/form-data">
            <label class="label-add-song">Judul</label>
            <input type="text" placeholder="Judul Lagu" name="judul"/>
            
            <label class="label-add-song">Penyanyi</label>
            <input type="text" placeholder="Penyanyi Lagu" name="penyanyi" id="add_song_input_penyanyi"/>

            <label class="label-add-song">Tanggal Terbit</label>
            <input type="date" placeholder="Tanggal Terbit" name="tanggal_terbit"/>

            <label class="label-add-song">Genre</label>
            <input type="text" placeholder="Genre song" name="genre"/>

            <label class="label-add-song">Song Cover</label>
            <br></br>
            <img class="song-add-image">
            <input type="file" placeholder="Song Cover" name="foto" id="song_add_image_input" accept="image/*"/>
            
            <label class="label-add-song">Audio File (.mp3)</label>
            <br></br>
            <audio controls class="song-add-audio">
                <source class="song-add-audio-source" src="">
            </audio>
            <input type="file" placeholder="Audio File" name="audio" id="song_add_audio_input" accept="audio/*"/>

            <label class="label-add-song">Album</label>
            <select name="album_id" id="add_song_input_album">
                <!-- <option selected hidden></option> -->
                <option value="0" disabled selected id="add_song_default_album_option">Type in singer to show album options</option>
            </select>

            <input type="hidden" name="audio_duration" id="audio_duration_input"/>
            
            <div class="buttonOrMessageHolder">
                <?php if (isset($data['error'])) { ?>
                    <p class="error song-add-message"><?php echo $data['error']; ?></p>
                <?php } ?>
                    
                <?php if (isset($data['success'])) { ?>
                    <p class="success song-add-message"><?php echo $data['success']; ?></p>
                <?php } ?>
            </div>

            <div class="buttonOrMessageHolder">
                <button class="add-song-button" type="submit">Save</button>
            </div>

        </form>
    </div>
</div>