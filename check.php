<?php

require 'main.php';

if($_SESSION['admin_access']='gfaigfuoawgybfuwgyawugfy'){
  $app = new \atk4\ui\App('Admin');
  $app->initLayout('Centered');

  $check = new \atk4\data\Model(new \atk4\data\Persistence_Array($db));
  $check->addField('password',['type'=>'password','required'=>TRUE]);
  //昨李屠屎習昨杳屎昨杳屎屠屎署當旺署堵崖易里峙陌圯昶矛;社

  $form = $app->layout->add('Form');
  $form->setModel($check);
  $form->onSubmit(function ($form) {
    $form->model->save();
    if($form->model['password']=='pOSWARD'){
    $_SESSION['admin_access']='gfaigfuoawgybfuwgyawugfy';
    return $app->jsRedirect(['admin']);
  }else{
    return $form->error('password', "Durak?");
  }
});

}else{
  header('Location: index.php');
}
