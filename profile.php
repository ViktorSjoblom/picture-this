<?php require __DIR__ . '/views/header.php'; ?>

<h1>Hello <?php echo $_SESSION['user']['username'] ?>!</h1>

<?php echo $_SESSION['user']['profilepicture'] ?>

<a href="/settings.php">Settings</a>


<?php require __DIR__ . '/views/footer.php'; ?>