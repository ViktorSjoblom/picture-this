<?php

declare(strict_types=1);

if (!function_exists('redirect')) {
    /**
     * Redirect the user to given path.
     *
     * @param string $path
     *
     * @return void
     */
    function redirect(string $path)
    {
        header("Location: ${path}");
        exit;
    }
}

/**
 * Get data from database using email
 * @param  string   $email []
 * @return array     [Array of userdata]
 */
function emailExists(string $email, object $pdo): array
{
    $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Get data from database using username
 * @param  string   $username []
 * @return array     [Array of userdata]
 */
function usernameExists(string $username, object $pdo): array
{
    $statement = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Checks if user is logged in
 *
 * @param int $id
 *
 * @return bool
 */
function isLoggedIn(): bool
{
    return isset($_SESSION['user']);
}
if (isLoggedIn()) {
    $user = $_SESSION['user'];
}

/**
 * Fetches all posts from a specific user, using ID
 *
 * @param int $id
 *
 * @param  object $pdo
 *
 * @return array
 */
function getPostsByUser(int $id, object $pdo): array
{
    $statement = $pdo->prepare('SELECT * FROM posts WHERE user_id = :user_id');
    $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
    $statement->execute();
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}

/**
 * Fetches the posts in the database
 *
 * @param object $pdo
 *
 * @return array
 */
function getPosts(object $pdo): array
{
    $statement = $pdo->prepare('SELECT posts.id, posts.image, users.id
     as user_id, users.username, posts.description, posts.created_at, posts.updated_at
     FROM posts
     JOIN users ON posts.user_id = users.id
     ORDER BY created_at DESC');
    $statement->execute();
    $allPosts = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $allPosts;
}


/**
 * Checks if given post is liked by given user
 *
 * @param int $postId
 *
 * @param int $userId
 *
 * @param object $pdo
 *
 * @return bool
 */
function isLikedByUser(int $postId, int $userId, object $pdo): bool
{
    $statement = $pdo->prepare('SELECT * FROM likes
                                WHERE post_id = :post_id
                                AND user_id = :user_id');
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $statement->execute();
    $isLikedByUser = $statement->fetch(PDO::FETCH_ASSOC);
    return $isLikedByUser ? true : false;
}

/**
 * Get and count likes for a given post
 *
 * @param int $postId
 *
 * @param object $pdo
 *
 * @return string
 */
function countLikes(int $postId, object $pdo): string
{
    $statement = $pdo->prepare('SELECT COUNT(*) FROM likes
                                WHERE post_id = :post_id');
    $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $statement->execute();
    $likes = $statement->fetch(PDO::FETCH_ASSOC);
    return $likes["COUNT(*)"];
}
