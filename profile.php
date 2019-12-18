<?php require __DIR__ . '/views/header.php'; ?>

<section class="profile-userpage">

    <?php require __DIR__ . '/views/message.php'; ?>

    <div class="profile-user">
        <?php if (isLoggedIn()) {
            echo $_SESSION['user']['username'];
        } ?>
    </div>

    <div class="profile-profilepicture">
        <?php if (isLoggedIn()) : ?>
            <img src="<?= '/app/users/profilepicture/' . $_SESSION['user']['profilepicture'] ?>" alt="">
        <?php endif; ?>
    </div>

    <div class="profile-biography">
        <?php if (isLoggedIn()) {
                        echo $_SESSION['user']['biography'];
                    } ?>
    </div>

    <div class="edit-profile">
        <a href="app/users/settings.php">Edit my profile</a>
    </div>

</section>

<?php require __DIR__ . '/views/footer.php'; ?>