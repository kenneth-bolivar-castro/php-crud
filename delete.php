<?php
require_once 'bootstrap.php';

/** @var Stuff $stuff */
$stuff = new Stuff();
if($stuff->deleteById($_REQUEST['id'])) {
    echo "Item deleted";
}
else {
    echo "An issue while deleting the item.";
}
