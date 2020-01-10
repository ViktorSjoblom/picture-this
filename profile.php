<?php require __DIR__ . '/views/header.php'; ?>
<?php if (isLoggedIn()) : ?>

    <?php $id = (int) $_SESSION['user']['id']; ?>
    <?php $usersPosts = getPostsByUser($id, $pdo); ?>

    <?php if (isset($message)) : ?>
        <p><?php echo $message ?></p>
    <?php endif; ?>

    <section>

        <div class="profile-user">
            <?php echo $_SESSION['user']['username']; ?>
        </div>

        <div class="profile-container">
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

        <div class="profile-wrapper">
            <?php foreach ($usersPosts as $posts) : ?>
                <div class="profile-posts">

                    <form action="./../app/posts/update.php" method="post" enctype="multipart/form-data" class="description-form">
                        <label for="description" class="description-flex">Change description</label>
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

                    <form action="./../app/posts/delete.php" method="get" enctype="multipart/form-data" class="delete-form">
                        <input type="hidden" name="page" value="<?php echo '/profile.php'; ?>">
                        <button class="delete-post-button" type="submit" name="delete" value="<?php echo $posts['id']; ?>">Delete</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    </section>
    <?php require __DIR__ . '/views/footer.php'; ?>