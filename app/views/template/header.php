<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php
            if (isset($data['title'])) {
                echo $data["title"]; 
            } else {
                echo "BINOTIFY"  ;
            }
        ?></title>
        <link href="<?= BASE_PUBLIC_URL; ?>/css/navbar.css" type="text/css" rel="stylesheet" />
        <link href="<?= BASE_PUBLIC_URL; ?>/css/home.css" type="text/css" rel="stylesheet" />
        <link href="<?= BASE_PUBLIC_URL; ?>/css/register.css" type="text/css" rel="stylesheet" />
        <link href="<?= BASE_PUBLIC_URL; ?>/css/login.css" type="text/css" rel="stylesheet" />
        <link href="<?= BASE_PUBLIC_URL; ?>/css/card.css" type="text/css" rel="stylesheet" />
        <link href="<?= BASE_PUBLIC_URL; ?>/css/daftar_album.css" type="text/css" rel="stylesheet" />
        <link href="<?= BASE_PUBLIC_URL; ?>/css/get_user.css" type="text/css" rel="stylesheet" />
        <link href="<?= BASE_PUBLIC_URL; ?>/css/form.css" type="text/css" rel="stylesheet" />
        <link href="<?= BASE_PUBLIC_URL; ?>/css/detail_album.css" type="text/css" rel="stylesheet" />
        <link href="<?= BASE_PUBLIC_URL; ?>/css/edit_album.css" type="text/css" rel="stylesheet" />
        <link href="<?= BASE_PUBLIC_URL; ?>/css/detail_song.css" type="text/css" rel="stylesheet" />
        <link href="<?= BASE_PUBLIC_URL; ?>/css/edit_song.css" type="text/css" rel="stylesheet" />
        <link href="<?= BASE_PUBLIC_URL; ?>/css/add_album.css" type="text/css" rel="stylesheet" />
        <link href="<?= BASE_PUBLIC_URL; ?>/css/add_song.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <div class="container">