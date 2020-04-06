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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
    <hr/>
    <label for="comments">COMMENT HERE:</label>
    <div id="comments" contenteditable="true" style="border: 2px solid blue;"></div>
    <button>Send</button>
    <div id="messages" style="background-color: purple"></div>
    <a href="#" id="hide-messages">Message toggle</a>
    <script src="script.js"></script>
</body>
</html>
