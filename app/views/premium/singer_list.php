<div class="wrapper-daftar-penyanyi">
    <div class="daftar-penyanyi-block-upper">
        <div class="daftar-penyanyi-text">
            <p class="daftar-penyanyi-title">Daftar Penyanyi Premium</p>
        </div>
    </div>

        <div class="daftar-penyanyi-block-bottomer">
            <table class="daftar-penyanyi-songs-table">
            <tr>
                <th class="bg-17-17-17">#</th>
                <th class="bg-17-17-17">Nama</th>
                <th class="daftar-penyanyi-table-align-right bg-17-17-17"></th>
            </tr>

            <?php $i = 1; var_dump($data["penyanyi"]) ?>
            <?php foreach ($data["penyanyi"] as $penyanyi): ?>
                <tr>
                    <td class="bg-17-17-17"><?php echo $i; ?></td>
                    <td class="bg-17-17-17"><?php echo $penyanyi["name"]; ?></td>
                    <td class="daftar-penyanyi-table-align-right bg-17-17-17 daftar-penyanyi-songs-buttons">
                        <a href="<?php echo BASE_PUBLIC_URL . "/song/detail/" . "asdf"; ?>">
                            <button class="daftar-penyanyi-songs-button">Subscribe</button>
                        </a>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
            </table>
        </div>
</div>