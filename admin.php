<?php

require 'connecting.php';

$app = new \atk4\ui\App('Admin');
$app->initLayout('Admin');

require 'visual.php';

if(isset($_SESSION['admin_access'])){
if($_SESSION['admin_access']=='gfaigfuoawgybfuwgyawugfy'){

$crud = $app->layout->add('CRUD');
$crud->setModel(new Friends($db));
$crud->addQuickSearch(['surname','phone_number','name']);

$crud = $app->layout->add('CRUD');
$crud->setModel(new Zajemnik($db));
$crud->addQuickSearch(['surname','phone_number','name']);

$crud = $app->layout->add('CRUD');
$crud->setModel(new Zajm($db));

$crud = $app->layout->add('CRUD');
$crud->setModel(new Vozvrat($db));

}else{
  header('Location: index.php');
}
}else{
  header('Location: index.php');
}
