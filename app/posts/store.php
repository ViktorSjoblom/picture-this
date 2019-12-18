<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isLoggedIn() && isset($_POST['description'], $_FILES['image'])) {
    $description = trim(filter_var($_POST['description'], FILTER_SANITIZE_STRING));
    $image = $_FILES['image'];

    if ($image['type'] !== 'image/jpeg' && $image['type'] !== 'image/png') {
        $_SESSION['message'] = 'The image file type is not allowed.';
    } elseif ($image['size'] >= 3000000) {
        $_SESSION['message'] = 'The uploaded file exceeded the filesize limit.';
    } elseif (filter_var($image['name'], FILTER_SANITIZE_STRING)) {
        if (isset($user['id'])) {
            $id = (int) $user['id'];
            $extension = pathinfo($image['name'])['extension'];
            $userFolder = $id;
            $filePath = __DIR__ . "/uploads/$userFolder/";
            $dateAndTime = date('d-M-Y-H:i:s');
            $imageName = $id . '_' . $dateAndTime . '.' . $extension;
            $updatedAt = "";

            $statement = $pdo->prepare("INSERT INTO posts(image, description, user_id, updated_at)
             VALUES(:image, :description, :user_id, :updated_at)");

            if (!$statement) {
                die(var_dump($pdo->errorInfo()));
            }

            $statement->bindParam(':image', $imageName, PDO::PARAM_STR);
            $statement->bindParam(':description', $description, PDO::PARAM_STR);
            $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
            $statement->bindParam(':updated_at', $updated_at, PDO::PARAM_STR);

            $statement->execute();

            $images = $statement->fetchAll(PDO::FETCH_ASSOC);

            if (!is_dir(__DIR__ . "/uploads/$userFolder")) {
                mkdir(__DIR__ . "/uploads/$userFolder");
            };

            move_uploaded_file($image['tmp_name'], $filePath . $imageName);
            $_SESSION['message'] = 'Your post has been uploaded';

            redirect('/profile.php');
        }
    }
}

redirect('/');
// redirect('/upload.php');
