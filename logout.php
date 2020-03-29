<?php
require 'bootstrap.php';

$user = new Users();
$user->logout();

header('Location: /');
