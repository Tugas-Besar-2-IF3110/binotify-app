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
                    <?php if ($penyanyi["status"] == "SUBSCRIBE") { ?>
                        <form action="<?= BASE_PUBLIC_URL; ?>/subscription/subscribe" method="post">
                            <input type="hidden" name="creator_id" value="<?php echo $penyanyi["user_id"] ?>" hidden />
                            <input type="hidden" name="subscriber_id" value="<?php echo $_SESSION["user_id"]?>" hidden />
                            <button type="submit" class="daftar-penyanyi-button-subs">Subscribe</button>
                        </form>
                    <?php } else if ($penyanyi["status"] == "PENDING") { ?>
                        <button class="daftar-penyanyi-button-wait">Waiting</button>
                    <?php } else if ($penyanyi["status"] == "ACCEPTED") { ?>
                        <a href="<?php echo BASE_PUBLIC_URL . "/song/detail/" . "asdf"; ?>">
                            <button class="daftar-penyanyi-button-list">Daftar Lagu</button>
                        </a>
                    <?php } else if ($penyanyi["status"] == "REJECTED") { ?>
                        <button class="daftar-penyanyi-button-rej">Rejected</button>
                    <?php } ?>
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
        </table>
    </div>
</div>