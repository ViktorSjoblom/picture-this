<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

//Checks if email is set
if (isLoggedIn() && isset($_POST['current-email'], $_POST['new-email'], $_POST['repeat-new-email'])) {
    $currentEmail = trim(filter_var($_POST['current-email'], FILTER_SANITIZE_EMAIL));
    $newEmail = trim(filter_var($_POST['new-email'], FILTER_SANITIZE_EMAIL));
    $repeatNewEmail = trim(filter_var($_POST['repeat-new-email'], FILTER_SANITIZE_EMAIL));
    $id = (int) $_SESSION['user']['id'];

    $statement = $pdo->query('SELECT email FROM users WHERE id = :id');

    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Checks if typed in current email matches email in database
    if ($currentEmail == $user['email']) {

        // Checks if twice typed in new email matches
        if ($newEmail == $repeatNewEmail) {

            // If yes update email in database
            $statement = $pdo->prepare('UPDATE users SET email = :email WHERE id = :id');

            $statement->bindParam(':email', $newEmail, PDO::PARAM_STR);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);

            $statement->execute();

            $_SESSION['message'] = "Your email has been changed!";

            $_SESSION['user']['email'] = $newEmail;
        // If new emails don't match, die page and echo something
        } else {
            $_SESSION['message'] = "New emails don't match!";
        }

        // If old email don't match database email, die page and echo something
    } else {
        $_SESSION['message'] = "Old email doesn't match!";
    }
} else {
    redirect('/');
}

redirect('/../settings.php');
