<?php require __DIR__ . '/views/header.php'; ?>
<?php if (!isLoggedIn()) {
    redirect('index.php');
}
?>
<?php
if (isset($_GET['search'])) : {
        $search = filter_var($_GET['search'], FILTER_SANITIZE_STRING);
        $searchresults = getSearchResult($search, $pdo);
    }
?>
    <!-- Display the results -->
    <div class="feed-wrapper">
        <h1>Search results</h1>
        <h3>
            <?php if (empty($searchresults)) {
    echo "Not results where found for $search";
}
            ?>
        </h3>
        <?php foreach ($searchresults as $searchresult) : ?>
            <!-- Display the searchresult with userinfo and link it to the profile -->
            <form action="/user.php" method="get">
                <button class="user-button" type="submit" name="id" value="<?php echo $searchresult["id"] ?>">
                    <img class="mini-profilepicture" src="<?= '/app/users/profilepicture/' . $searchresult['profilepicture'] ?>" alt="<?php echo $searchresult['username']; ?> avatar" loading="lazy">
                    <p class="username-text"><?php echo $searchresult['username']; ?></p>
                    <p class="biography"><?php echo $searchresult["biography"] ?></p>
                </button>
            </form>
            <form action="/user.php" method="get">
            <?php endforeach; ?>
    </div>


    <?php require __DIR__ . '/views/footer.php'; ?>
<?php endif; ?>