<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <div class="login-container">
        <div class="index-intro">
            <img src="logo.png" alt="">
        </div>


        <?php if (!isLoggedIn()) : ?>
            <p class="login-register"><a href="login.php">Log in</a></p>
            <p class="login-register"><a href="register.php">Register</a></p>
    </div>
<?php endif; ?>

<?php if (isset($message)) : ?>
    <p><?php echo $message ?></p>
<?php endif; ?>

<?php if (isLoggedIn()) : ?>
    <?php $allPosts = getPosts($pdo); ?>
    <?php foreach ($allPosts as $posts) : ?>

        <?php $isLikedByUser = isLikedByUser($posts['id'], $_SESSION['user']['id'], $pdo); ?>
        <?php $likes = countLikes($posts['id'], $pdo); ?>

        <article class="index-posts">

            <div data-id="<?= $posts['id'] ?>" class="like">
                <p class="post-likes likes-post<?= $posts['id']; ?>"><?= $likes ?></p>
                <form class="like-form" method="post">
                    <input type="hidden" name="post_id" value="<?= $posts['id']; ?>">
                    <input type="hidden" name="action" value="<?= $isLikedByUser ? 'unlike' : 'like'; ?>">
                    <button data-id="<?= $posts['id'] ?>" class="like-button" type="submit" name="like">Like
                        <i class="far fa-heart like-button-<?= $posts['id'] ?> like-button-heart <?= $isLikedByUser ? 'hidden' : '' ?>"></i>
                        <i class="fas fa-heart like-button-<?= $posts['id'] ?> like-button-heart liked <?= $isLikedByUser ? '' : 'hidden' ?>"></i>
                    </button> <!-- like-button -->
                </form> <!-- like-form -->
            </div> <!-- like -->

            <p class="username-post">Posted by: <?= $posts['username']; ?></p>
            <p class="post-date">Date:
                <?php $date = explode(" ", $posts['created_at']); ?>
                <?php echo $date[0]; ?></p>
            <div class="description">
                <img class="uploaded-pictures" src="<?= 'app/posts/uploads/' . $posts['user_id'] . '/' . $posts['image'] ?>" alt="">
                <p><?= $posts['description'] ?></p>
            </div>
        <?php endforeach; ?>

        </article>

    <?php endif; ?>


    <?php require __DIR__ . '/views/footer.php'; ?>