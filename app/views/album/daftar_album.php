<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Album</title>
    <link href="../css/navbar.css" type="text/css" rel="stylesheet" />
    <link href="../css/daftar_album.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <?php include('./template/navbar.php') ?>
        <div class="albums">
            <h2 id="daftar-album-title">Daftar Album</h2>
            <div class="row">
                <?php for ($i = 0; $i < count($data); $i++) { ?>
                    <a class="column" href='detail/<?php echo $data[$i]['album_id']?>'>
                        <img class = "album_photo" src="../assets/<?php echo $data[$i]['Image_path']?>">
                        <div class="album_section_2">
                            <div class="title_singer">
                                <p class= "album_title"><?php echo $data[$i]['Judul']?></p>
                                <p class= "album_singer"><?php echo $data[$i]['Penyanyi']?></p>
                                <p class= "year_genre"><?php echo explode('-', $data[$i]['Tanggal_terbit'])[0]?> • <?php echo $data[$i]['Genre']?></p>
                            </div>
                        </div>
                    </a>
                <?php }?>
            </div>
        </div>   
    </div>
</body>
</html>