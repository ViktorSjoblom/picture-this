<?php

declare(strict_types=1);
require __DIR__ . '/../autoload.php';
if (isset($_POST['name'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['password-repeat'])) {

    if ($_POST['password'] !== $_POST['password-repeat']) {
        $_SESSION['message'] = "Your passwords do not match, please try again!";
        redirect('/register.php');
    }



    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (emailExists($email, $pdo)) {
        $_SESSION['message'] = "The email is already in use, please try again!";
        redirect('/register.php');
    }

    if (usernameExists($username, $pdo)) {
        $_SESSION['message'] = "That username is already in use, please try again!";
        redirect('/register.php');
    }

    // if (!emailExists($email, $pdo) && (!userExists($username, $pdo))) {
    //     redirect('/login.php');
    //     $_SESSION['message'] = "You've created an new account! Please log in here!";
    // }

    $profilepicture = 'default-profilepicture.png';


    $statement = $pdo->prepare(
        'INSERT INTO users (email, name, username, password, profilepicture)
        VALUES (:email, :name, :username, :password, :profilepicture)'
    );

    $user = $statement->fetch(PDO::FETCH_ASSOC);


    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->bindParam(':profilepicture', $profilepicture, PDO::PARAM_STR);
    $statement->execute();

    redirect('/index.php');
    $_SESSION['message'] = 'You created an account! Please login in.';
};

redirect('/register.php');
