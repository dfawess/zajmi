<?php

require 'vendor/autoload.php';

use \atk4\ui\Button;

$layout = $app->layout;
$layout->leftMenu->addItem(['Main page','icon'=>'building'],['admin']);
$layout->leftMenu->addItem(['Log out','icon'=>'book'],['logout']);
