<nav class="navbar">
    <div class="profile">
        <img src="https://www.pngitem.com/pimgs/m/108-1084833_spotify-icon-spotify-icon-white-png-transparent-png.png" class="navbar-image" />
        <?php if (isset($_SESSION['username'])) { ?>
            <p><?php echo $_SESSION['username'] ?></p>
        <?php } ?>
    </div>
    <hr id="navbar-upper-line"></hr>
    <a class="nav-text"href="<?= BASE_PUBLIC_URL; ?>">Home</a>
    <a class="nav-text"href="<?= BASE_PUBLIC_URL; ?>/search">Search</a>
    <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) { ?>
        <a class="nav-text" href="<?= BASE_PUBLIC_URL; ?>/song/add_song">Tambah Lagu</a>
        <a class="nav-text" href="<?= BASE_PUBLIC_URL; ?>/album/add_album">Tambah Album</a>
    <?php } ?>
    <a class="nav-text" href="<?= BASE_PUBLIC_URL; ?>/album/get_album">Daftar Album</a>
    <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) { ?>
        <a class="nav-text" href="<?= BASE_PUBLIC_URL; ?>/user/get_user">Daftar User</a>
    <?php } ?>
    <?php if (isset($_SESSION['isAdmin'])) { ?>
        <a class="nav-text" href="<?= BASE_PUBLIC_URL; ?>/auth/logout"><button type="submit" class="btn btn-logout">Log Out</button></a>
    <?php } else { ?>
        <a class="nav-text" href="<?= BASE_PUBLIC_URL; ?>/auth/login"><button type="button" class="btn btn-login">Log In</button></a>
    <?php } ?>
</nav>
