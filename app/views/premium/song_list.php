<div class="wrapper-daftar-plagu">
    <div class="daftar-plagu-block-upper">
        <div class="daftar-plagu-text">
            <p class="daftar-plagu-title">Daftar Lagu Premium</p>
        </div>
    </div>

    <div class="daftar-plagu-block-bottomer">
        <table class="daftar-plagu-songs-table">
            <tr>
                <th class="bg-17-17-17">#</th>
                <th class="bg-17-17-17">Judul</th>
                <th class="bg-17-17-17">Audio</th>
            </tr>

            <?php $i = 1; ?>
            <?php foreach ($data["song"] as $song): ?>
                <tr>
                    <td class="bg-17-17-17"><?php echo $i; ?></td>
                    <td class="bg-17-17-17"><?php echo $song["Judul"]; ?></td>
                    <td class="bg-17-17-17">
                        <audio controls src="<?php echo BINOTIFY_PREMIUM_API . "/song/" . $song["Audio_path"] ?>"></audio>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>
    </div>
</div>