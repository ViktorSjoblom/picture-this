<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isLoggedIn() && isset($_POST['action'], $_POST['post_id'])) {
    $action = $_POST['action'];
    $postId = $_POST['post_id'];
    $userId = (int) $user['id'];

    $date = date('d M Y');

    if ($action === 'like') {
        $action = json_encode($action);
        $statement = $pdo->prepare('INSERT INTO likes(user_id, post_id, created_at) VALUES(:user_id, :post_id, :created_at)');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
        $statement->bindParam(':created_at', $date, PDO::PARAM_STR);

        $statement->execute();

        $likes = $statement->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $statement = $pdo->prepare('DELETE FROM likes WHERE user_id = :user_id AND post_id = :post_id');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);

        $statement->execute();

        $unlike = $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    $statement = $pdo->prepare('SELECT COUNT(*) FROM likes WHERE post_id = :post_id');
    $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $statement->execute();
    $likes = $statement->fetch(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($likes["COUNT(*)"]);
} else {
    redirect('/');
}
