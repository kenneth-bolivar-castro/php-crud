<?php
require_once 'bootstrap.php';

/** @var stuff $stuff */
$stuff = new Stuff($_GET);

// Check when there are string parameters available.
if(!empty($_GET['name']) && !empty($_GET['description']) && !isset($_GET['id'])) {
$id = $stuff->create();
} elseif (!empty($_GET['id'])) {
$updated = $stuff->updateItem();
$item = $stuff->findById();
}

?>
<html>
<head>
    <title>Admin stuff form</title>
</head>
<body>

<?php if(isset($id)): ?>
    <h3>New item created: <?php echo $id; ?></h3>
<?php endif; ?>

<?php if(!empty($updated)): ?>
    <h3>Item saved!</h3>
<?php endif; ?>

<form action="form.php" method="get">
    <?php if(isset($item)): ?>
        <input type="hidden" name="id" value="<?php echo $item->id ?>">
    <?php endif; ?>

    <label for="name">Name: </label>
    <input type="text" name="name" id="name" autocomplete="off" value="<?php echo isset($item) ? $item->name : null ?>" ><br/>

    <label for="description">Description: </label>
    <input type="text" name="description" id="description" autocomplete="off" value="<?php echo isset($item) ? $item->description : null ?>"><br/>
    <input type="submit" value="Save">
</form>
</body>
</html>
