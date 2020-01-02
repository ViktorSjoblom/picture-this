<?php

declare(strict_types=1);
require __DIR__ . '/../autoload.php';

if (isLoggedIn() && isset($_POST['confirm-password'])) {
    $password = trim($_POST['confirm-password']);
    $id = (int) $_SESSION['user']['id'];
    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if (password_verify($password, $user['password'])) {
        if ($_POST['biography'] == "") {
            $biography = $_SESSION['user']['biography'];
        } else {
            $biography = trim(filter_var($_POST['biography'], FILTER_SANITIZE_STRING));
            $statement = $pdo->prepare('UPDATE users SET biography = :biography WHERE id = :id');
            $statement->bindParam(':biography', $biography, PDO::PARAM_STR);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            $_SESSION['user']['biography'] = $biography;
        }
        if ($_POST['name'] == "") {
            $name = $_SESSION['user']['name'];
        } else {
            $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
            $statement = $pdo->prepare('UPDATE users SET name = :name WHERE id = :id');
            $statement->bindParam(':name', $name, PDO::PARAM_STR);
            $statement->bindParam(':id', $id, PDO::PARAM_STR);
            $statement->execute();
            $_SESSION['user']['name'] = $name;
        }
        if ($_POST['username'] == "") {
            $username = $_SESSION['user']['username'];
        } elseif (isset($_POST['username'])) {
            $username = $_POST['username'];
            $statement = $pdo->prepare('SELECT username FROM users WHERE username = :username');
            $statement->bindParam(':username', $username, PDO::PARAM_STR);
            $statement->execute();
            $usernamesDB = $statement->fetch(PDO::FETCH_ASSOC);
            if ($username == $usernamesDB['username']) {
                $_SESSION['message'] = 'Sorry, this user already exists';
            } else {
                $changedUsername = trim(filter_var($username, FILTER_SANITIZE_STRING));
                $statement = $pdo->prepare('UPDATE users SET username = :username WHERE id = :id');
                $statement->bindParam(':username', $changedUsername, PDO::PARAM_STR);
                $statement->bindParam(':id', $id, PDO::PARAM_STR);
                $statement->execute();
                $_SESSION['user']['username'] = $username;
            }
        }
        $_SESSION['message'] = 'Your settings has been updated';
        redirect('/../profile.php');
    } else {
        $_SESSION['message'] = 'Incorrect password';
    }
}
redirect('/../settings.php');
