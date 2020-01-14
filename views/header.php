<?php require __DIR__ . '/../app/autoload.php'; ?>

<?php if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo $config['title']; ?></title>
    <script src="https://kit.fontawesome.com/83f8941984.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/styles/main.css">
    <link rel="stylesheet" href="/assets/styles/navbar.css">
    <link rel="stylesheet" href="/assets/styles/login.css">
    <link rel="stylesheet" href="/assets/styles/profile.css">
    <link rel="stylesheet" href="/assets/styles/footer.css">
    <link rel="stylesheet" href="/assets/styles/upload.css">
    <link rel="stylesheet" href="/assets/styles/settings.css">
    <link rel="stylesheet" href="/assets/styles/index.css">
    <link rel="stylesheet" href="/assets/styles/register.css">
    <link rel="stylesheet" href="/assets/styles/user.css">
</head>

<body>

    <?php require __DIR__ . '/navigation.php'; ?>