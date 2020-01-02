<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isLoggedIn() && isset($_POST['delete-account'])) {
    $id = (int) $user['id'];

    if ($user[''] !== 'default-profilepicture.png') {
        unlink(__DIR__ . '//' . $user['']);
    }
    $posts = getPostsByUser($id, $pdo);

    foreach ($posts as $post) {
        unlink(__DIR__ . '/../posts/uploads/' . $user['id'] . '/' . $post['image']);
    }
    rmdir(__DIR__ . '/../posts/uploads/' . $user['id']);

    $statement = $pdo->prepare('DELETE FROM users WHERE id = :id');

    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    $statement->execute();

    $statement = $pdo->prepare('DELETE FROM posts WHERE user_id = :id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    $statement->execute();

    $statement = $pdo->prepare('DELETE FROM likes WHERE user_id = :id');

    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    $statement->execute();
}

session_destroy();

redirect('/');
