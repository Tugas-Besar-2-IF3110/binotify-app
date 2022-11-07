<div class="wrapper-detail-song">
    <div class="song-detail-block-upper">
        <img class="song-detail-image" src="<?php echo BASE_PUBLIC_URL . "/assets//" . $data['song']['Image_path']; ?>">
        <!-- <img class="song-detail-image" src="<?php echo $data['song']['Image_path']; ?>"> -->
        <div class="song-detail-text">
            <?php if ($data["album"] != null) { ?>
                <a class="song-detail-album-anchor" href="<?php echo BASE_PUBLIC_URL . "/album/detail/" . $data['album']['album_id']; ?>">
                    <p><?php echo $data['album']['Judul']; ?></p>
                </a>
            <?php } else {?>
                <p>-</p>
            <?php } ?>
            <p class="song-detail-title"><?php echo $data['song']['Judul']; ?></p>
            <div class="bottom-part-detail-lagu">
            <p><?php 
                if (!empty($data['song']['Genre'])) {
                    echo $data['song']['Penyanyi'] . " • " . $data['song']['Tanggal_terbit'] . " • " . $data['song']['Genre'] . " • " . $data['song']['Duration']; 
                } else {
                    echo $data['song']['Penyanyi'] . " • " . $data['song']['Tanggal_terbit'] . " • " . $data['song']['Duration']; 
                }
                ?></p> 
                <div class="song-detail-round-button" onclick="detail_song_click_play_button()">
                    <div class="song-detail-arrow-right"></div>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) { ?>
        <div class="song-detail-block-middle">
            <a class="" href="<?php echo BASE_PUBLIC_URL . "/song/edit/" . $data['song']['song_id']; ?>">
                <button class="song-detail-button">Edit</button>
            </a>
            <button class="song-detail-button-delete" id="<?php echo $data["song"]["song_id"] ?>">Delete</button>
        </div>
    <?php } ?>
</div>
<div id="detail-song-now-playing">
        <img id="detail-song-image-playing" src="../../assets/<?php echo $data['song']['Image_path']?>">
        <div id="detail-song-word-playing">
            <p id="detail-song-title-playing"><?php echo $data['song']['Judul']?></p> 
            <h5 id="detail-song-penyanyi-playing"><?php echo $data['song']['Penyanyi']?></h5>
        </div>
        <div class="detail-song-audio-container">
                <audio id="detail-song-audio-playing" src="../../assets/<?php echo $data['song']['Audio_path']?>" type="audio/mpeg" controls controlsList="nodownload"></audio>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value=<?php echo $data['login'] ?> class="detail-song-login" />
<input type="hidden" value=<?php echo $data['listen_count'] ?> class="detail-song-listen-count" />