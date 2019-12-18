<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

//Checks if password is set
if (isLoggedIn() && isset($_POST['current-password'], $_POST['new-password'], $_POST['repeat-new-password'])) {
    $currentPassword = trim($_POST['current-password']);
    $newPassword = trim($_POST['new-password']);
    $repeatNewPassword = trim($_POST['repeat-new-password']);
    $id = (int) $_SESSION['user']['id'];

    // Get old password from database
    $statement = $pdo->query('SELECT * FROM users WHERE id = :id');

    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Checks if typed in current password matches password in database
    if (password_verify($currentPassword, $user['password'])) {

        // Checks if twice typed in new password matches
        if ($newPassword == $repeatNewPassword) {

            // If yes update password in database
            $statement = $pdo->prepare('UPDATE users SET password = :password WHERE id = :id');
            // hash password to database
            $statement->bindParam(':password', password_hash($newPassword, PASSWORD_DEFAULT), PDO::PARAM_STR);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);

            $statement->execute();

            $_SESSION['message'] = "Your password has been changed!";
        } else {
            $_SESSION['message'] = "New passwords don't match!";
        }
    } else {
        $_SESSION['message'] = "Old password doesn't match!";
    }
} else {
    redirect('/');
}

redirect('/../settings.php');
