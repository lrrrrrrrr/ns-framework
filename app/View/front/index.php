<?php
include __DIR__ . '/../header.php';
?>
    <div>
        <?php
        foreach ($posts as $post) {
            echo '<div class="post">
                    <div class="title"><a href="?route=/front/post&id=' . $post['id'] . '">' . $post['title'] . '</a></div>
                    <div class="body">' . $post['text'] . '</div>
                    <div class="author">Author id: ' . $post['authorId'] . '</div>
                    </div>';
        }
        ?>
    </div>
<?php
include __DIR__ . '/../footer.php';
