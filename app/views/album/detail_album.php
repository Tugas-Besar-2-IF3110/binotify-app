<div class="wrapper-detail-album">
    <div class="album-detail-block-upper">
        <img class="album-detail-image" src="<?php echo BASE_PUBLIC_URL . "/assets//" . $data['album']['Image_path']; ?>">
        <!-- <img class="album-detail-image" src="<?php echo $data['album']['Image_path']; ?>"> -->
        <div class="album-detail-text">
            <p>ALBUM</p>
            <p class="album-detail-title"><?php echo $data['album']['Judul']; ?></p>
            <!-- <p>Taylor Swift . 2022 . 13 songs, 44 min 8 sec</p> -->
            <p><?php echo $data['album']['Penyanyi'] . " • " . $data['album']['Tanggal_terbit'] . " • " . $data['album']['num_of_songs'] . " songs, " . $data['album']['Total_duration']; ?></p>
        </div>
    </div>

    <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) { ?>
        <div class="album-detail-block-middle">
            <a class="" href="<?php echo BASE_PUBLIC_URL . "/album/edit/" . $data['album']['album_id']; ?>">
                <button class="album-detail-button">Edit</button>
            </a>
            <button class="album-detail-button-delete" id="<?php echo $data["album"]["album_id"] ?>">Delete</button>
        </div>
    <?php } ?>

        <div class="album-detail-block-bottomer">
            <table class="album-detail-songs-table">
            <tr>
                <th class="bg-17-17-17">#</th>
                <th class="bg-17-17-17">Title</th>
                <th class="album-detail-table-align-right bg-17-17-17">Singer</th>
                <th class="album-detail-table-align-right bg-17-17-17">Duration</th>
                <th class="album-detail-table-align-right bg-17-17-17">Detail</th>
            </tr>

            <?php $i = 1; ?>
            <?php foreach($data["songs"] as $song): ?>
                <tr>
                    <td class="bg-17-17-17"><?php echo $i; ?></td>
                    <td class="bg-17-17-17"><?php echo $song["Judul"]; ?></td>
                    <td class="album-detail-table-align-right bg-17-17-17"><?php echo $song["Penyanyi"]; ?></td>
                    <td class="album-detail-table-align-right bg-17-17-17"><?php echo $song["Duration"]; ?></td>
                    <td class="album-detail-table-align-right bg-17-17-17 album-detail-songs-buttons">
                        <a href="<?php echo BASE_PUBLIC_URL . "/song/detail/" . $song["song_id"]; ?>">
                            <button class="album-detail-songs-button">Detail</button>
                        </a>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
            </table>
        </div>
</div>