<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';


if (isset($_POST['name'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['password-repeat'])) {

    if ($_POST['password'] !== $_POST['password-repeat']) {
        $_SESSION['message'] = "Your passwords do not match, please try again!";
        redirect('/register.php');
    }

    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $password = trim(password_hash($_POST['password'], PASSWORD_DEFAULT));

    if (emailExists($email, $pdo)) {
        $_SESSION['message'] = "The email is already in use, please try again!";
        redirect('/register.php');
    }

    if (usernameExists($username, $pdo)) {
        $_SESSION['message'] = "That username is already in use, please try again!";
        redirect('/register.php');
    }

    if (!emailExists($email, $pdo) && (!usernameExists($username, $pdo))) {
        redirect('/login.php');
        $_SESSION['message'] = "You've created an new account!";
    }

    $profilePicture = 'default-profilepicture.png';
    $defaultBio = 'Nothing here yet...';


    $statement = $pdo->prepare(
        'INSERT INTO users (name, email, password, username, profilepicture, biography)
        VALUES (:name, :email, :password, :username, :profilepicture, :biography)'
    );

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->bindParam(':profilepicture', $profilePicture, PDO::PARAM_STR);
    $statement->bindParam(':biography', $defaultBio, PDO::PARAM_STR);
    $statement->execute();


    redirect('/login.php');
};

redirect('/register.php');
