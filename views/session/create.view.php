<?php
require basePath('views/partials/head.php');
require basePath('views/partials/header.php');
?>

<div class="row align-items-center g-lg-0 p-5">
    <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">LOGIN TO POST AWESOME STUFF</h1>
        <p class="col-lg-10 fs-4">Anakin, my allegiance is to the republic, to democracy!</p>
    </div>
    <div class="col-md-10 mx-auto col-lg-5">
        <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary" action="/session" method="POST">
            <div class="form-floating mb-3">
                <input
                    name="email"
                    type="email"
                    class="form-control <?= (isset($errors['email']) || isset($errors['email_password'])) ? 'is-invalid' : '' ?>"
                    id="email"
                    placeholder="name@example.com"
                    value="<?= old('email') ?>">
                <label for="email">Email address</label>
            </div>
            <div class="form-floating mb-3">
                <input
                    name="password"
                    type="password"
                    class="form-control <?= (isset($errors['password']) || isset($errors['email_password'])) ? 'is-invalid' : '' ?>"
                    id="password"
                    placeholder="Password"
                    value="<?= old('password') ?>">
                <label for="password">Password</label>
            </div>
            <?php foreach ($errors as $error) : ?>
                <p class="text-danger mt-2"><?= $error ?></p>
            <?php endforeach; ?>
            <div class="checkbox mb-3">
                <label for="stayConnected">
                    <input
                        id="stayConnected"
                        name="stayConnected"
                        type="checkbox"
                        checked> Remember me
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
        </form>
    </div>
</div>

<?php
require basePath('views/partials/footer.php');
require basePath('views/partials/foot.php');
?>
