<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isLoggedIn() && isset($_POST['comment'])) {
    var_dump($_POST);
    var_dump($_SESSION['user']['id']);
    $postId = trim(filter_var($_POST['postid'], FILTER_SANITIZE_NUMBER_INT));
    $userId = trim(filter_var($_POST['userid'], FILTER_SANITIZE_NUMBER_INT));
    $comment = trim(filter_var($_POST['comment'], FILTER_SANITIZE_STRING));
    // If the form is not posted by the logged in user we logout
    /* if ($_SESSION['user']['id'] !== $userId) {
        redirect('logout.php');
    } */
}
else {
    $statement = $pdo->prepare("INSERT INTO comments (user_id, post_id, content)
    VALUES(:user_id, :post_id, :content)");

   if (!$statement) {
       die(var_dump($pdo->errorInfo()));
   }

   $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
   $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
   $statement->bindParam(':content', $comment, PDO::PARAM_STR);

   $statement->execute();

   $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
}