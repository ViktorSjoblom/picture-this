<?php require __DIR__ . '/views/header.php'; ?>

<div class="login-container">
    <article>
        <h1 class="login-text">Login</h1>

        <form action="app/users/login.php" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" placeholder="Email" required>
                <small class="form-text text-muted">Please provide your email address.</small>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
                <small class="form-text text-muted">Please provide your password.</small>
            </div>
            <div class="login-button">
                <button type="submit" class="login-button">Login</button>
            </div>
        </form>

        <p>Don't have an account? Create one <a class="create-account-here" href="/register.php">here!</a></p>

    </article>
</div>
<?php require __DIR__ . '/views/footer.php'; ?>