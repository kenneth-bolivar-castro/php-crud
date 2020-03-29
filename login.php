<?php
require 'bootstrap.php';

$message = NULL;
if('POST' == $_SERVER['REQUEST_METHOD']) {
    $user = new Users($_POST);

    if($user->login()) {
        header('Location: /index.php');
    }
    else {
        $message = 'Check your credentials.';
    }
}
?>
<html>
<head>
    <title>Log in</title>
</head>
<body>
<?php if(!is_null($message)): ?>
    <h3><?php echo $message; ?></h3>
<?php endif; ?>
<form action="login.php" method="post">
    <label for="username">Username</label> <input type="text" name="username" id="username" autocomplete="off" /><br>
    <label for="password">Password</label> <input type="password" name="password" id="password" autocomplete="off" /><br>
    <input type="submit" value="Log-in">
</form>
</body>
</html>
