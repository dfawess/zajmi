<?php
require 'connecting.php';
if($_SESSION['admin_access']='gfaigfuoawgybfuwgyawugfy'){
  $app = new \atk4\ui\App('Login Admin');
  $app->initLayout('Centered');
  $check = new \atk4\data\Model(new \atk4\data\Persistence_Array($a));
  $check->addField('password',['type'=>'password','required'=>TRUE]);

  $form = $app->layout->add('Form');
  $form->setModel($check);
  $form->onSubmit(function ($form) {
    $form->model->save();
    if($form->model['password']=='pOSWARD'){
    $_SESSION['admin_access']='gfaigfuoawgybfuwgyawugfy';
    return new \atk4\ui\jsExpression('document.location = "admin.php" ');
  }else{
    return $form->error('password', "Durak?");
  }
  });
}else{
  return new \atk4\ui\jsExpression('document.location="index.php"');
}
