<?php require __DIR__ . '/views/header.php'; ?>
<div class="settings-container">

    <?php if (isset($message)) : ?>
        <p class="default-error"><?php echo $message ?></p>
    <?php endif; ?>

    <div class="profile-profilepicture">
        <img src="<?= '/app/users/profilepicture/' . $_SESSION['user']['profilepicture'] ?>" alt="">
    </div>
    <form class="profilepicture-group" action="/app/users/profilepicture.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="profilepicture">Choose new profile picture to upload</label>
            <input class="profilepicture-input" type="file" accept="image/jpeg, image/png" name="profilepicture" required>
            <button class="primary-button" type="submit" name="button">Upload</button>
        </div>
    </form>

    <form class="biography-group" action="/app/users/settings.php" method="post" enctype="multipart/form-data">
        <div class="form-group">

            <label for="biography">Update your biography</label>
            <textarea maxlength="150" class="biography-area" name="biography" placeholder="<?php echo $_SESSION['user']['biography'] ?>"></textarea>

            <label for="name">Change name</label>
            <input class="form-control" type="text" name="name" placeholder="<?php echo $_SESSION['user']['name'] ?>">

            <label for="username">Change username</label>
            <input class="form-control" type="text" name="username" placeholder="<?php echo $_SESSION['user']['username'] ?>">

            <label class=" label-confirm" for="password-confirm">Confirm with password</label>
            <input class="form-control" type="password" name="confirm-password" placeholder="Password">


            <button class="primary-button" type="submit" name="button">Confirm</button>
        </div>
    </form>

    <form class="settings-group" action="/app/users/settings-email.php" method="post" enctype="multipart/form-data">
        <div class="form-group-email">
            <label for="email">Change email</label>
            <p class="current-settings">Current mail</p>
            <input class="form-control" type="email" name="current-email" placeholder="<?php echo $_SESSION['user']['email'] ?>">
            <p>New mail</p>
            <input class="form-control" type="email" name="new-email" placeholder="New mail">
            <p>Repeat new mail</p>
            <input class="form-control" type="email" name="repeat-new-email" placeholder="Repeat new mail">

            <button class="primary-button" type="submit" name="button">Save</button>
        </div>
    </form>

    <form class="settings-group" action="/app/users/settings-password.php" method="post" enctype="multipart/form-data">
        <div class="form-group-password">
            <label for="password">Change password</label>
            <p class="current-settings">Current password</p>
            <input class="form-control" type="password" name="current-password" placeholder="Current password">
            <p>New password</p>
            <input class="form-control" type="password" name="new-password" placeholder="New password">
            <p>Repeat new password</p>
            <input class="form-control" type="password" name="repeat-new-password" placeholder="Repeat new password">

            <button class="primary-button" type="submit" name="button">Save</button>
        </div>


        <?php unset($_SESSION['message']); ?>
    </form>

    <form class="form-delete" action="/app/users/delete.php" method="get" enctype="multipart/form-data">

        <button class="primary-button delete-style" type="submit" name="delete-account" value="<?php echo $_SESSION['user']['id'] ?>">Delete Account</button>

    </form>

</div>
<?php require __DIR__ . '/views/footer.php'; ?>