<?php require __DIR__ . '/views/header.php'; ?>

<div class="login-container">
    <article>
        <h1 class="login-text">Login</h1>

        <form action="app/users/login.php" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" placeholder="Email" required>
                <small class="small-text">Please provide your email address.</small>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
                <small class="small-text">Please provide your password.</small>
            </div>
            <div class="login-button">
                <button target=" _blank" rel="nofollow noopener" type="submit" class="primary-button">Login</button>
            </div>
        </form>

        <?php if (isset($message)) : ?>
            <p><?php echo $message ?></p>
        <?php endif; ?>

        <p>Don't have an account? Create one <a class="create-account-here" href="/register.php">here!</a></p>

    </article>
</div>
<?php require __DIR__ . '/views/footer.php'; ?>