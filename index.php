<?php require __DIR__ . '/views/header.php';

$allPosts = getPosts($pdo);
?>

<article>
    <div class="login-container">

        <?php if (isset($message)) : ?>
            <p class="default-error"><?php echo $message ?></p>
        <?php endif; ?>

        <?php if (!isLoggedIn()) : ?>
            <img src="logo.png">
            <p class="primary-button"><a href="login.php">Log in</a></p>
            <p class="primary-button"><a href="register.php">Register</a></p>
        <?php endif; ?>
    </div>


    <?php if (isLoggedIn()) : ?>
        <div class="feed-wrapper">
            <?php foreach ($allPosts as $posts) : ?>
                <?php $likes = countLikes($posts['id'], $pdo); ?>
                <?php $isLikedByUser = isLikedByUser($posts['id'], $_SESSION['user']['id'], $pdo); ?>

                <article class="index-posts">
                    <div class="user-container">
                        <form action="/user.php" method="get">
                            <button class="user-button" type="submit" name="id" value="<?php echo $posts['user_id'] ?>">
                                <img class="mini-profilepicture" src="<?= '/app/users/profilepicture/' . $posts['profilepicture'] ?>" alt="">
                                <p class="username-text"><?php echo $posts['username']; ?></p>
                            </button>
                        </form>
                        <p class="post-date">
                            <?php $date = explode(" ", $posts['created_at']); ?>
                            <?php echo $date[0]; ?></p>
                    </div>
                    <div class="index-flex">
                        <img class="uploaded-pictures" src="<?= 'app/posts/uploads/' . $posts['user_id'] . '/' . $posts['image'] ?>" alt="">
                    </div>
                    <div data-id="<?= $posts['id'] ?>" class="like">
                        <p class="post-likes likes-post<?= $posts['id']; ?>"><?= $likes ?></p>
                        <form class="like-form" method="post">
                            <input type="hidden" name="post_id" value="<?= $posts['id']; ?>">
                            <input type="hidden" name="action" value="<?= $isLikedByUser ? 'unlike' : 'like'; ?>">
                            <button data-id="<?= $posts['id'] ?>" class="like-button" type="submit" name="like">
                                <i class="far fa-heart like-button-<?= $posts['id'] ?> like-button-heart <?= $isLikedByUser ? 'hidden' : '' ?>"></i>
                                <i class="fas fa-heart like-button-<?= $posts['id'] ?> like-button-heart liked <?= $isLikedByUser ? '' : 'hidden' ?>"></i>
                            </button>
                        </form>
                    </div>

                    <div class="feed-description">
                        <p><?= $posts['description'] ?></p>
                    </div>
                    <form action="/app/posts/comment.php" method="post">

                        <input type="hidden" name="postid" value="<?= $posts['id'] ?>">
                        <input type="hidden" name="userid" value="<?= $posts['user_id'] ?>">
                        <textarea name="comment" cols="78" rows="2" placeholder="Comment"></textarea>
                        <button type="comment-submit">Send</button>

                    </form>
                    <!-- Comments -->
                    <?php $postComments = getPostComments($posts['id'], $pdo); ?>
                    <?php foreach ($postComments as $comment) : ?>
                        <br>
                        <hr>
                        <br>
                        <pre>
                            <?php echo $comment["content"]; ?>
                            <?php if ($userId === $comment["user_id"]) : ?>
                                <form action="/app/posts/update-comment.php" method="post">
          
                            <input type="hidden" name="comment_id" value="<?= $comment["id"]; ?>">
                            <input type="hidden" name="user_id" value="<?= $comment["user_id"]; ?>">
                            <textarea name="comment" cols="78" rows="2" placeholder="<?php echo $comment["content"]; ?>"></textarea>
                            <button type="comment-submit">Edit comment</button>
                        
                    </form>
                    <form action="/app/posts/delete-comment.php" method="post"> 
                    <input type="hidden" name="comment_id" value="<?= $comment["id"]; ?>">
                    <input type="hidden" name="user_id" value="<?= $comment["user_id"]; ?>">
                            <button type="comment-submit">Delete comment</button>
                    </form>
                            <?php endif; ?>
                    </pre>
                        <br>
                    <?php endforeach; ?>
                <?php endforeach; ?>
        </div>
</article>
<?php endif; ?> <?php require __DIR__ . '/views/footer.php'; ?>