<?php

require 'connecting.php';

$app = new \atk4\ui\App('Dolzhnik');
$app->initLayout('Centered');

$user = new Friends($db);
$user->load($_SESSION['id']);
$friend = $user->ref('Zajm');

$crud = $app->layout->add('CRUD');
$crud->setModel($friend);

$user = new Friends($db);
$user->load($_SESSION['id']);
$friend = $user->ref('Vozvrat');

$crud = $app->layout->add('CRUD');
$crud->setModel($friend);

$app->add(['Button','Верни меня!',])->on('click',function() use($app){
    return new \atk4\ui\jsExpression('document.location="main.php"');
});
