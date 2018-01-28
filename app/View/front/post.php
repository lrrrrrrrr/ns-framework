<?php
include __DIR__ . '/../header.php';
?>
    <div>
        <?php
        echo '<div class="post">
                <div class="title">' . $post['title'] . '</div>
                <div class="body">' . $post['text'] . '</div>
                <div class="author">Author id: ' . $post['authorId'] . '</div>
                </div>';
        ?>
    </div>
    <div>
        Comments:
        <?php
            foreach ($comments as $comment) {
                echo '<div class="comment">
                        <div class="message">' . $comment['message'] . '</div> 
                        <div class="author">Author id:' . $comment['authorId'] . '</div> 
                      </div>';
            }
        ?>
    </div>
    <div>
        <form action="" method="post">
            <div class="body">
                Comment: <textarea name="message"></textarea>
                <input type="hidden" name="entity" value="comments" />
                <input type="hidden" name="postId" value="<?=$_GET['id']?>" />
            </div>
            <input type="submit" name="submit" value="Add"/>
        </form>
    </div>
<?php
include __DIR__ . '/../footer.php';
