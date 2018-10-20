<?php

require 'connecting.php';

$app = new \atk4\ui\App('Login');
$app->initLayout('Centered');

$user = new Zajemnik($db);
$form = $app->layout->add('Form');
$form->setModel(new Zajemnik($db),['login','password']);
$form->buttonSave->set('Войти');
$form->onSubmit(function($form) use ($user){
  $user->tryLoadBy('login',$form->model['login']);

  if ($form->model['password']==null){
    $user->unload();
    $er = (new \atk4\ui\jsNotify('Неправильный пароль/логин'));
    $er->setColor('red');
    return $er;
  }
  if ($user['password'] == $form->model['password']) {
    $_SESSION['user_id'] = $user->id;
    $_SESSION['zajemnik']='keksawgybfuwgyawugfy';
    return new \atk4\ui\jsExpression('document.location="main.php"');
  } else {
    $user->unload();
    $er = (new \atk4\ui\jsNotify('Неправильный пароль/логин'));
    $er->setColor('red');
    return $er;
  }
});

$app->add(['Button','Я Админ',])->on('click',function() use($app){
    $_SESSION['admin_access']='gfaigfuoawgybfuwgyawugfy';
    return new \atk4\ui\jsExpression('document.location="loginadmin.php"');
});
