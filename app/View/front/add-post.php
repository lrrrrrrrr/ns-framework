<?php
include __DIR__ . '/../header.php';
?>
    <div>
        <?php
        echo '<div class="post">
                <form action="" method="post">
                    <div class="title">Title: <input type="text" name="title" /></div>
                    <div class="body">Text: <textarea name="text"></textarea></div>
                    <input type="hidden" name="entity" value="post" />
                    <input type="submit" name="submit" value="Add" />
                    </div>
                </form>';
        ?>
    </div>
<?php
include __DIR__ . '/../footer.php';
