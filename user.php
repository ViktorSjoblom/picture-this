<?php require __DIR__ . '/views/header.php';
if (!isLoggedIn()) {
    redirect('/');
}

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $getUserContent = getUserContent($pdo, $id);
    $getPosts = getPostsByUser($id, $pdo);
} else {
    redirect('/');
}

?>

<?php if (isset($message)) : ?>
    <p class="default-error"><?php echo $message ?></p>
<?php endif; ?>



<section>
    <div class="user-userpage">

        <div class="user-username">
            <p><?php echo $getUserContent['username']; ?></p>
        </div>
        <div class="profile-profilepicture">
            <img src="<?= '/app/users/profilepicture/' . $getUserContent['profilepicture'] ?>" alt="">
        </div>

        <div class="user-biography">
            <?php echo $getUserContent['biography']; ?>
        </div>

    </div>

    <?php foreach ($getPosts as $posts) : ?>

        <?php $isLikedByUser = isLikedByUser($posts['id'], $_SESSION['user']['id'], $pdo); ?>
        <?php $likes = countLikes($posts['id'], $pdo); ?>


        <div class="user-wrapper">
            <div class="user-box">
                <p class="post-date">Uploaded:
                    <?php $date = explode(" ", $posts['created_at']); ?>
                    <?php echo $date[0]; ?></p>
                <img class="uploaded-pictures" src="<?php echo 'app/posts/uploads/' . $posts['user_id'] . '/' . $posts['image'] ?>" alt="">

                <div data-id="<?= $posts['id'] ?>" class="user-likes">
                    <p class="post-likes likes-post<?= $posts['id']; ?>"><?= $likes ?></p>
                    <form class="like-form" method="post">
                        <input type="hidden" name="post_id" value="<?= $posts['id']; ?>">
                        <input type="hidden" name="action" value="<?= $isLikedByUser ? 'unlike' : 'like'; ?>">
                        <button data-id="<?= $posts['id'] ?>" class="like-button" type="submit" name="like">
                            <i class="far fa-heart like-button-<?= $posts['id'] ?> like-button-heart <?= $isLikedByUser ? 'hidden' : '' ?>"></i>
                            <i class="fas fa-heart like-button-<?= $posts['id'] ?> like-button-heart liked <?= $isLikedByUser ? '' : 'hidden' ?>"></i>
                        </button>
                    </form>
                </div> <!-- likes  -->

                <div class="user-description">
                    <p><?php echo $posts['description'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
</section>
<?php require __DIR__ . '/views/footer.php'; ?>