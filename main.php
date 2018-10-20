<?php

require 'connecting.php';

if(isset($_SESSION['zajemnik'])){
if($_SESSION['zajemnik']=='keksawgybfuwgyawugfy'){

$db = new \atk4\data\Persistence_SQL('mysql:dbname=zajmi;host=localhost','root','');

$app = new \atk4\ui\App('Dolzhnik');
$app->initLayout('Centered');

$user = new Zajemnik($db);
$user->load($_SESSION['user_id']);
$friend = $user->ref('Friends');

$crud = $app->layout->add('CRUD');
$crud->setModel($friend);
$crud->addQuickSearch(['surname','phone_number','name']);
$crud->addDecorator('name', new \atk4\ui\TableColumn\Link('kek.php?id={$id}'));

$app->add(['Button','Выйти',])->on('click',function() use($app){
  if (isset($_SESSION['zajemnik'])) {
    unset($_SESSION['zajemnik']);
  }
  return new \atk4\ui\jsExpression('document.location="index.php"');
});

}else{
  header('Location: index.php');
}
}else{
  header('Location: index.php');
}
