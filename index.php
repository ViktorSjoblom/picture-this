<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <div class="index-intro">
        <img src="logo.jpeg" alt="">
        <h1><?php echo $config['title']; ?></h1>
    </div>

    <p><a href="login.php">Log in</a></p>
    <p><a href="register.php">Register</a></p>

</article>

<?php require __DIR__ . '/views/footer.php'; ?>