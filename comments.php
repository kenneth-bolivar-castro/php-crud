<?php


$comments = empty($_SESSION['messages']) ? [] : $_SESSION['messages'];
print json_encode($comments);
