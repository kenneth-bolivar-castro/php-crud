<?php
require_once 'bootstrap.php';

/** @var Stuff $stuff */
$stuff = new Stuff();

/** @var Users $user */
$user = new Users();
if($user->isAnonymous()) {
    header('Location: /login.php');
}
?>
<html>
<head>
    <title>PHP - MySQL CRUD</title>
</head>
<body>
    <h1>Welcome <?php echo $user->getUsername(); ?>!</h1>
    <ul>
        <?php foreach ($stuff->findAll() as $item): ?>
            <li>
                <a href="/details.php?id=<?php echo $item->id; ?>"> <?php echo $item->name ?> </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <h3><a href="logout.php" style="color: red">Logout</a></h3>
</body>
</html>
