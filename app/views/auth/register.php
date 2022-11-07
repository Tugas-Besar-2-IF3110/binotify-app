<div class="wrapper-register">
    <div class="register-block-upper">
        <div class="register-text">
            <p class="register-title">Register</p>
        </div>
    </div>
    <div class="register-block-middle">
        <form class="register-form" action="<?= BASE_PUBLIC_URL; ?>/auth/register" method="post" id="registration">
            <label class="label-register">Nama</label>
            <input type="text" placeholder="Nama" name="nama" />

            <label class="label-register">Username</label>
            <input type="text" placeholder="Username" name="username" id="register-username" />
            <div class="buttonOrMessageHolder">
                <p class="error register-message" id="error-username" hidden></p>
            </div>

            <label class="label-register">Email</label>
            <input type="text" placeholder="Email" name="email" id="register-email" />
            <div class="buttonOrMessageHolder">
                <p class="error register-message" id="error-email" hidden></p>
            </div>

            <label class="label-register">Password</label>
            <input type="text" placeholder="Password" name="password" />

            <label class="label-register">Confirm Password</label>
            <input type="text" placeholder="Confirm Password" name="confirm-password" />

            <div class="buttonOrMessageHolder">
                <?php if (isset($data['error'])) { ?>
                    <p class="error register-message"><?php echo $data['error']; ?></p>
                <?php } ?>
            </div>

            <div class="buttonOrMessageHolder">
                <button class="register-button" type="submit">Register</button>
            </div>
            <p class="label-register"><span>Already have an account ? </span><a id="log-link" href="login">Login</a></p>
        </form>
    </div>
</div>
