<?php
require_once 'bootstrap.php';

/** @var Stuff $stuff */
$stuff = new Stuff();

?>
<html>
<head>
    <title>PHP - MySQL CRUD</title>
</head>
<body>
    <h1>Welcome!</h1>
    <ul>
        <?php foreach ($stuff->findAll() as $item): ?>
            <li>
                <a href="/details.php?id=<?php echo $item->id; ?>"> <?php echo $item->name ?> </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
