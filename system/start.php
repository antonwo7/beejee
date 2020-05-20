<?php
include 'classes/Autoloader.php';

Autoloader::register();

$db = new Database();
$router = new Router();
