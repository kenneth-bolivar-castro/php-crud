<?php
require_once 'bootstrap.php';

// Be sure `id` is available.
if(!empty($_GET['id'])) {

    /** @var Stuff $stuff */
    $stuff = new Stuff($_REQUEST);
    $item = $stuff->findById();
}
?>
<html>
<head>
    <title>Details</title>
</head>
<body>

    <?php if(isset($item)): ?>
        <h1><?php echo $item->name ?></h1>
        <strong><?php echo $item->description ?></strong>
        <hr>
        <a href="/form.php?id=<?php echo $item->id ?>">Edit</a> ||
        <a href="/delete.php?id=<?php echo $item->id ?>" style="color: red;">Delete</a>
    <?php else: ?>
        <h5>ID is missing.</h5>
    <?php endif; ?>
</body>
</html>

