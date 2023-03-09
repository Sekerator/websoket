<form method="post">
    <input type="text" name="login" required>
    <input type="submit" name="submit">
</form>

<?php
if(isset($_POST['submit'])) {
    setcookie('login', $_POST['login']);
    header("Location: http://test/game.php");
}