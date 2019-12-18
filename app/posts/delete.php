<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isLoggedIn() && isset($_POST['post_id'])) {
    $postId = $_POST['post_id'];
    $userId = (int) $user['id'];
    $userFolder = $userId;

    $userPosts = getPostsByUser($userId, $pdo);

    foreach ($userPosts as $userPost) {
        if ($postId == $userPost['id']) {
            $imageName = $userPost['image'];

            $statement = $pdo->prepare('DELETE FROM posts WHERE id = :id AND image = :image');

            if (!$statement) {
                die(var_dump($pdo->errorInfo()));
            }

            $statement->bindParam(':id', $postId, PDO::PARAM_STR);
            $statement->bindParam(':image', $imageName, PDO::PARAM_STR);

            $statement->execute();

            unlink(__DIR__ . '/uploads/' . $userFolder . '/' . $imageName . '');

            $_SESSION['message'] = 'Your post has been deleted!';
        }
    }
    redirect('/profile.php');
}

redirect('/');
