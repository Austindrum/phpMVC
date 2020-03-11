<?php require APPROOT.'/views/inc/header.php' ?>
<div class="row">
    <div class="col-md-5 mx-auto p-4 rounded" id="user-form">
        <?php flash("register_success"); ?>
        <?php flash("logout_success"); ?>
        <?php flash("no_login"); ?>
        <form class="form-signin" action="<?= URLROOT ?>users/login" method="POST">
            <div class="text-center mb-4">
                <h1 class="h3 mb-3 font-weight-bolder">
                    <i class="fas fa-clipboard-check"></i> 
                     Login
                </h1>
            </div>
            <div class="form-label-group mt-3">
                <label for="" class="font-weight-bold">Email: *</label>
                <input type="email" 
                class="form-control <?= !empty($data['email_err']) ? 'is-invalid' : '' ?>" 
                placeholder="Email address" 
                name="email"
                value="<?= $data['email'] ?>"
                autocomplete="off">
                <span class="invalid-feedback font-weight-bold"><?= '! '.$data['email_err'] ?></span>
            </div>

            <div class="form-label-group mt-3">
                <label for="" class="font-weight-bold">Password: *</label>
                <input type="password" 
                class="form-control <?= !empty($data['password_err']) ? 'is-invalid' : '' ?>" 
                placeholder="Password" 
                name="password">
                <span class="invalid-feedback font-weight-bold"><?= '! '.$data['password_err'] ?></span>
            </div>

            <div class="checkbox mb-1 mt-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block mt-3" type="submit">Login</button>

        </form>
        <p class="text-center mt-4 mb-1">
            Not Sign up Before?
            <a href="<?= URLROOT ?>users/register">Sign Up</a>
        </p>
    </div>
</div>
<?php require APPROOT.'/views/inc/footer.php' ?>