<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isLoggedIn() && isset($_POST['comment'])) {
    $postId = trim(filter_var($_POST['postid'], FILTER_SANITIZE_NUMBER_INT));
    $userId = trim(filter_var($_POST['userid'], FILTER_SANITIZE_NUMBER_INT));
    $comment = trim(filter_var($_POST['comment'], FILTER_SANITIZE_STRING));
    $date = date("Y-m-d H:i:s");

    // Insert sanitized comment to db
    $statement = $pdo->prepare("INSERT INTO comments (user_id, post_id, content, date)
    VALUES(:user_id, :post_id, :content, :date)");

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $statement->bindParam(':content', $comment, PDO::PARAM_STR);
    $statement->bindParam(':date', $date, PDO::PARAM_STR);
    $statement->execute();

    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);

    redirect('/');
}
redirect('/');
