<?php

require 'connecting.php';

$app = new \atk4\ui\App('Dolzhnik');
$app->initLayout('Centered');

$friend= new Friends($db);
$friend->load($_SESSION['id']);
$zajm = $friend->ref('Zajm');
$vozvrat = $friend->ref('Vozvrat');

$crud = $app->layout->add('CRUD');
$crud->setModel($zajm,['value','date']);

$crud = $app->layout->add('CRUD');
$crud->setModel($vozvrat,['value','date']);

$app->add(['Button','Верни меня!',])->on('click',function() use($app){
    return new \atk4\ui\jsExpression('document.location="main.php"');
});
$reminder = new ReminderBox();
$reminder->setModel($friend);
$app->add($reminder);
