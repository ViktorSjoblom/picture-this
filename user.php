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
    <p><?php echo $message ?></p>
<?php endif; ?>



<section class="">
    <div class="profile-userpage">
        <div class="profile-user">
            <?php echo $getUserContent['username']; ?>
        </div>

        <div class="profile-profilepicture">
            <img src="<?= '/app/users/profilepicture/' . $getUserContent['profilepicture'] ?>" alt="">
        </div>

        <div class="profile-biography">
            <?php echo $getUserContent['biography']; ?>
        </div>

    </div>

    <?php foreach ($getPosts as $posts) : ?>

        <?php $isLikedByUser = isLikedByUser($posts['id'], $_SESSION['user']['id'], $pdo); ?>
        <?php $likes = countLikes($posts['id'], $pdo); ?>

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

        <img class="uploaded-pictures" src="<?php echo 'app/posts/uploads/' . $posts['user_id'] . '/' . $posts['image'] ?>" alt="">
        <p class="post-date">
            <?php $date = explode(" ", $posts['created_at']); ?>
            <?php echo $date[0]; ?></p>
        <div class="description">
            <p><?php echo $posts['description'] ?></p>
        </div>
        </div>
    <?php endforeach; ?>

</section>
<?php require __DIR__ . '/views/footer.php'; ?>