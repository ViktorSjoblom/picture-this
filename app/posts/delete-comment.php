<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// $_POST['user_id'] must be equal to global variable $userId which is the logged in user.
if (isset($_POST['comment_id'], $_POST['user_id']) && $_POST['user_id'] === $userId) {

    if (isLoggedIn()) {
        $commentId = trim(filter_var($_POST['comment_id'], FILTER_SANITIZE_NUMBER_INT));

        // update sanitized comment 
        $statement = $pdo->prepare("DELETE FROM comments WHERE id = :id");

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }
        $statement->bindParam(':id', $commentId, PDO::PARAM_STR);
        $statement->execute();

        /* $comments = $statement->fetchAll(PDO::FETCH_ASSOC); */
    }
}

redirect('/');
