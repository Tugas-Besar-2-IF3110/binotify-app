<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id']) && $_SESSION['isAdmin'] == 1) { ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Daftar User Page</title>
        <link href="../css/navbar.css" type="text/css" rel="stylesheet" />
        <link href="../css/get_user.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <?php include('./template/navbar.php') ?>
            <div class="users">
                <h2 id="daftar-user-title">Daftar User</h2>
                <table class="get-users-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $user) { ?>
                        <tr>
                            <td><?php echo $user['nama'] ?></td>
                            <td><?php echo $user['username'] ?></td>
                            <td><?php echo $user['email'] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
    </html>
<?php } else {
    header("Location: ". BASE_PUBLIC_URL);
}

?>