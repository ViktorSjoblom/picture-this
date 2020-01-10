<?php

require __DIR__ . '/views/header.php';

?>
<section>
    <div class="upload-wrapper">
        <h2>Upload a new post!</h2>


        <div class="upload-container">
            <form class="upload-post-group" action="/app/posts/store.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="image">Choose an image to upload</label>
                    <input class="image-input" type="file" accept="image/jpeg, image/png" name="image">
                    <label for="description">Description</label>
                    <textarea class="description-field" name="description" placeholder="Write something here"></textarea>
                    <button class="primary-button" type="submit" name="button">Upload</button>
                </div>
            </form>
        </div>
    </div>

</section>

<?php require __DIR__ . '/views/footer.php'; ?>