<?php require __DIR__ . '/views/header.php'; ?>

<section class="edit-section">
    <h1 class="edit-headline">Register User</h1>

    <form class="edit-form" role="form" action="app/users/register.php" method="post">

        <div class="edit-div">
            <div class="edit-label">
                <label for="name">Name</label>
            </div>
            <input class="edit-input" type="text" name="name" placeholder="Name" required>
        </div>

        <div class="edit-div">
            <div class="edit-label">
                <label for="email">Email</label>
            </div>
            <input class="edit-input" type="email" name="email" placeholder="Email" required>
        </div>

        <div class="edit-div">
            <div class="edit-label">
                <label for="username">Username</label>
            </div>
            <input class="edit-input" type="text" name="username" placeholder="Username" required>
        </div>

        <div class="edit-div">
            <div class="edit-label">
                <label for="password">Password</label>
            </div>
            <input class="edit-input" type="password" name="password" placeholder="Password" required>
        </div>

        <div class="edit-div">
            <div class="edit-label">
                <label for="password-repeat">Repeat password</label>
            </div>
            <input class="edit-input" type="password" name="password-repeat" placeholder="Repeat password" required>
        </div>

        <button type="submit" class="edit-button">Register</button>

        <?php if (isset($message)) : ?>
            <p><?php echo $message ?></p>
        <?php endif; ?>

    </form>
    <p>Already have an account? Log in <a class="create-account-here" href="/login.php">here!</a></p>
</section>

<?php require __DIR__ . '/views/footer.php';
