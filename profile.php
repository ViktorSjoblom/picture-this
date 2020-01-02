<?php require __DIR__ . '/views/header.php'; ?>

<section class="profile-userpage">

    <?php require __DIR__ . '/views/message.php'; ?>

    <div class="profile-user">
        <?php if (isLoggedIn()) : ?>
            <?php echo $_SESSION['user']['username']; ?>
        <?php endif; ?>
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


    <?php if (isLoggedIn()) :
        $id = (int) $_SESSION['user']['id'];
        $usersPosts = getPostsByUser($id, $pdo);
    ?>
        <?php foreach ($usersPosts as $posts) : ?>
            <div class="profile-posts">

                <form action="./../app/posts/delete.php" method="get" enctype="multipart/form-data" class="delete-form">
                    <input type="hidden" name="page" value="<?= '/profile.php'; ?>">
                    <button type="submit" name="delete" value="<?= $posts['id']; ?>">Delete post</button>
                </form>


                <article class="feed-post">
                    <img class="uploaded-pictures" src="<?= 'app/posts/uploads/' . $posts['user_id'] . '/' . $posts['image'] ?>" alt="">
                    <div data-id="<?= $post['id'] ?>" class="like">
                        <p class="post-date">
                            <?php $date = explode(" ", $posts['created_at']); ?>
                            <?php echo $date[0]; ?></p>
                        <div class="description">
                            <p><?= $posts['description'] ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                    </div>
                </article>
            </div>

</section>
<?php require __DIR__ . '/views/footer.php'; ?>