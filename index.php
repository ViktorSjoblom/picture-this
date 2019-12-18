<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <div class="index-intro">
        <img src="logo.jpeg" alt="">
        <h1><?php echo $config['title']; ?></h1>
    </div>

    <p><a href="login.php">Log in</a></p>
    <p><a href="register.php">Register</a></p>



    <?php $allPosts = getPosts($pdo); ?>
    <?php foreach ($allPosts as $posts) : ?>
        <article class="feed-post">
            <img src="<?= 'app/posts/uploads/' . $posts['user_id'] . '/' . $posts['image'] ?>" alt="">
            <div data-id="<?= $post['id'] ?>" class="like">
                <p class="post-date">
                    <?php $date = explode(" ", $posts['created_at']); ?>
                    <?php echo $date[0]; ?></p>
                <div class="description">
                    <p class="username-post"><?= $posts['username']; ?></p>
                    <p><?= $posts['description'] ?></p>
                </div>
            <?php endforeach; ?>

        </article>



        <?php require __DIR__ . '/views/footer.php'; ?>