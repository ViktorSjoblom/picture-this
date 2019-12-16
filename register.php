<?php require __DIR__ . '/views/header.php'; ?>


<article>
    <h1>Register new account</h1>

    <form action="app/users/login.php" method="post">
        <div class="form-group">

            <label for="email">Name</label>
            <input class="form-control" type="name" name="name" id="name" placeholder="Name" required>

            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="Email" required>

            <label for="email">Username</label>
            <input class="form-control" type="username" name="username" id="username" placeholder="Username" required>

            <label for="email">Password</label>
            <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>