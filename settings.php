<?php require __DIR__ . '/views/header.php'; ?>

<a href="/profile.php">Profile</a>


<form class="profilepicture-group" action="/app/users/profilepicture.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="profilepicture">Choose an profile picture to upload</label>
        <input class="profilepicture-input" type="file" accept="image/jpeg, image/png" name="profilepicture" required>
        <button class="btn-primary" type="submit" name="button">Upload</button>
    </div>
</form>

<form class="biography-group" action="/app/users/settings.php" method="post" enctype="multipart/form-data">
    <div class="form-group">

        <label for="biography">Update your biography</label>
        <textarea class="biography-area" name="biography" placeholder="Update your biography..."></textarea>

        <label for="name">Change name</label>
        <input class="form-control" type="text" name="name" placeholder="Current name">

        <label for="username">Change username</label>
        <input class="form-control" type="text" name="username" placeholder="Current username">

        <label class=" label-confirm" for="password-confirm">Confirm with password</label>
        <input class="form-control" type="password" name="confirm-password" placeholder="Password">


        <button class="btn-primary" type="submit" name="button">Update</button>
    </div>
</form>

<form class="settings-group" action="/app/users/settings-email.php" method="post" enctype="multipart/form-data">
    <div class="form-group-email">
        <label for="email">Change email</label>
        <p>Current mail</p>
        <input class="form-control" type="email" name="current-email" placeholder="Current mail">
        <p>New mail</p>
        <input class="form-control" type="email" name="new-email" placeholder="New mail">
        <p>Repeat new mail</p>
        <input class="form-control" type="email" name="repeat-new-email" placeholder="Repeat new mail">

        <button class="btn-primary" type="submit" name="button">Save</button>
    </div>
</form>

<form class="settings-group" action="/app/users/settings-password.php" method="post" enctype="multipart/form-data">
    <div class="form-group-password">
        <label for="password">Change password</label>
        <p>Current password</p>
        <input class="form-control" type="password" name="current-password" placeholder="Current password">
        <p>New password</p>
        <input class="form-control" type="password" name="new-password" placeholder="New password">
        <p>Repeat new password</p>
        <input class="form-control" type="password" name="repeat-new-password" placeholder="Repeat new password">

        <button class="btn-primary" type="submit" name="button">Save</button>
    </div>


    <p>Delete your account</p>
    <form class="settings-group" action="/app/users/delete.php" method="post" enctype="multipart/form-data">
        <div class="confirm-delete-account hidden">
            <p>Are you sure you want to remove you account?</p>
            <small>All content will be removed aswell</small>
            <div class="delete-account-buttons">
                <button class="button" type="submit" name="delete-account" value="<?= isLoggedIn() ?>">Delete</button>
                <button class="button" type="button" name="button">Cancel</button>
            </div>
        </div>
    </form>
    <button class="button" type="submit" name="button">Delete account</button>


</form>

<?php require __DIR__ . '/views/footer.php'; ?>