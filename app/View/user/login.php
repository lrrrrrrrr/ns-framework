<?php
include __DIR__ . '/../header.php';
?>
<div>
    <?php
    echo '<div class="post">
                <form action="" method="post">
                    <div class="title">login: <input type="text" name="login" /></div>
                    <div class="body">password: <input type="text" name="password" /></div>
                    <input type="hidden" name="entity" value="login" />
                    <input type="submit" name="submit" value="Login" />
                    </div>
                </form>';
    ?>
</div>
<?php
include __DIR__ . '/../footer.php';
?>
