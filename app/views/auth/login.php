<div class="wrapper-login">
    <div class="login-block-upper">
        <div class="login-text">
            <p class="login-title">Login</p>
        </div>
    </div>
    <div class="login-block-middle">
        <form class="login-form" action="<?= BASE_PUBLIC_URL; ?>/auth/login" method="post">
            <label class="label-login">Username</label>
            <input type="text" placeholder="Username" name="username" />

            <label class="label-login">Password</label>
            <input type="password" placeholder="Password" name="password" />
            
            <div class="buttonOrMessageHolder">
                <?php if (isset($data['error'])) { ?>
                    <p class="error login-message"><?php echo $data['error']; ?></p>
                <?php } ?>
            </div>
            
            <div class="buttonOrMessageHolder">
                <button class="login-button" type="submit">Login</button>
            </div>
            <p class="label-login"><span>Not registered ? </span><a id="reg-link" href="register">Register here</a></p>
        </form>
    </div>
</div>