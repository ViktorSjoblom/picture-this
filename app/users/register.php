<?php

declare(strict_types=1);
require __DIR__ . '/../autoload.php';
if (isset($_POST['name'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['password-repeat'])) {

    if ($_POST['password'] !== $_POST['password-repeat']) {
        $_SESSION['error'] = "Your passwords do not match, please try again!";
        redirect('/register.php');
    }



    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (emailExists($email, $pdo)) {
        $_SESSION['error'] = "The email is already in use, please try again!";
        redirect('/register.php');
    }

    if (userExists($username, $pdo)) {
        $_SESSION['error'] = "That username is already in use, please try again!";
        redirect('/register.php');
    }

    // if (!emailExists($email, $pdo) && (!userExists($username, $pdo))) {
    //     redirect('/login.php');
    //     $_SESSION['error'] = "You've created an new account! Please log in here!";
    // }

    $statement = $pdo->prepare(
        'INSERT INTO users (email, name, username, password)
        VALUES (:email, :name, :username, :password)'
    );

    $user = $statement->fetch(PDO::FETCH_ASSOC);


    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->execute();
};
redirect('/');
