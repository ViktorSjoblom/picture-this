<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <div class="login-container">
        <div class="index-intro">
            <img src="logo.png" alt="">
        </div>


        <?php if (!isLoggedIn()) : ?>
            <p class="login-register"><a href="login.php">Log in</a></p>
            <p class="login-register"><a href="register.php">Register</a></p>
        <?php endif; ?>
    </div>


    <?php $allPosts = getPosts($pdo); ?>
    <?php foreach ($allPosts as $posts) : ?>
        <article class="index-posts">
            <div data-id="<?= $post['id'] ?>" class="like">Like</div>
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



        <?php require __DIR__ . '/views/footer.php'; ?>