<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Checks if there is an image to upload
if (isLoggedIn() && isset($_FILES['profilepicture'])) {
    $profilepicture = $_FILES['profilepicture'];
    $extension = pathinfo($_FILES['profilepicture']['name'])['extension'];
    $userName = $_SESSION['user']['username'];
    $filePath = __DIR__ . '/profilepicture/';
    $id = (int) $_SESSION['user']['id'];

    $profilepictureName = $userName . '.' . $extension;

    // Checks if image is of right kind and isn't to big
    if ($profilepicture['type'] !== 'image/jpeg' && $profilepicture['type'] !== 'image/png') {
        $_SESSION['message'] = 'The image file type is not allowed!';
    } elseif ($profilepicture['size'] >= 3000000) {
        $_SESSION['message'] = 'The uploaded file is too big!.';
    } else {
        filter_var($profilepicture['name'], FILTER_SANITIZE_STRING);
        // Updates the database column profilepicture with the set image
        $statement = $pdo->prepare('UPDATE users SET profilepicture = :profilepicture WHERE id = :id');

        $statement->bindParam(':profilepicture', $profilepictureName, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        $statement->execute();

        // Moves image to directory
        move_uploaded_file($profilepicture['tmp_name'], $filePath . $profilepictureName);
    }
    // Updates session variable to use the newly set image as profilepicture
    $_SESSION['message'] = 'Your new profile picture has been uploaded!';
    $_SESSION['user']['profilepicture'] = $profilepictureName;
    redirect('/../profile.php');
} else {
    redirect('/');
}
