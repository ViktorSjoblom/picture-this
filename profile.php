<?php require __DIR__ . '/views/header.php'; ?>
<?php if (isLoggedIn()) : ?>

    <?php $id = (int) $_SESSION['user']['id']; ?>
    <?php $usersPosts = getPostsByUser($id, $pdo); ?>

    <?php require __DIR__ . '/views/message.php'; ?>
    <section class="">
        <div class="profile-userpage">
            <div class="profile-user">
                <?php echo $_SESSION['user']['username']; ?>
            </div>

            <div class="profile-profilepicture">
                <img src="<?= '/app/users/profilepicture/' . $_SESSION['user']['profilepicture'] ?>" alt="">
            </div>

            <div class="profile-biography">
                <?php echo $_SESSION['user']['biography']; ?>
            </div>

        </div>

        <div class="edit-center">
            <div class="edit-profile">
                <a href="app/users/settings.php">Edit profile</a>
            </div>
        </div>

        <?php foreach ($usersPosts as $posts) : ?>

            <div class="profile-posts">
                <form action="./../app/posts/delete.php" method="get" enctype="multipart/form-data" class="delete-form">
                    <input type="hidden" name="page" value="<?php echo '/profile.php'; ?>">
                    <button type="submit" name="delete" value="<?php echo $posts['id']; ?>">Delete post</button>
                </form>

                <form action="./../app/posts/update.php" method="post" enctype="multipart/form-data" class="description-form">
                    <label for="description">Change description</label>
                    <input type="text" name="description" placeholder="<?php echo $posts['description']; ?>" value="<?php echo $posts['description']; ?>">
                    <input type="hidden" name="page" value="<?php echo '/profile.php'; ?>">
                    <button type="submit" name="id" value="<?php echo $posts['id']; ?>">Update</button>
                </form>


                <img class="uploaded-pictures" src="<?php echo 'app/posts/uploads/' . $posts['user_id'] . '/' . $posts['image'] ?>" alt="">
                <p class="post-date">
                    <?php $date = explode(" ", $posts['created_at']); ?>
                    <?php echo $date[0]; ?></p>
                <div class="description">
                    <p><?php echo $posts['description'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    </section>
    <?php require __DIR__ . '/views/footer.php'; ?>