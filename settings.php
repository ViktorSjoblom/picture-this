<?php require __DIR__ . '/views/header.php'; ?>

<h1>Do you want to reset your password?</h1>
<h1>Do you want to reset your email?</h1>
<h1>Do you want to reset your biography?</h1>
<h1>Do you want to delete your account?</h1>

<?php echo $_SESSION['user']['profilepicture'] ?>

<a href="/profile.php">Profile</a>


<?php require __DIR__ . '/views/footer.php'; ?>