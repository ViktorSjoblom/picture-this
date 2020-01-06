<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isLoggedIn() && isset($_GET['delete-account'])) {
    $id = (int) $_GET['delete-account'];

    $statement = $pdo->prepare(
        "DELETE FROM users WHERE id = :id"
    );
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(":id", $id, PDO::PARAM_INT);
    $statement->execute();
    $user = $statement->fetchAll(PDO::FETCH_ASSOC);

    unset($_SESSION['user']);
    $_SESSION['message'] = "Your account has been deleted.";
    redirect('/');
}

redirect('/');
