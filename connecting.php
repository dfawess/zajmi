<?php

session_start();

require 'vendor/autoload.php';

if (isset($_ENV['CLEARDB_DATABASE_URL'])) {
     $db = \atk4\data\Persistence::connect($_ENV['CLEARDB_DATABASE_URL']);
 } else {
     $db = \atk4\data\Persistence::connect('mysql:host=127.0.0.1;dbname=zajmi;charset=utf8', 'root', '');


}

class Zajemnik extends \atk4\data\Model {
    public $table = 'zajemnik';
function init(){
    parent::init();
    $this->addField('name');
    $this->addField('surname');
    $this->addField('login');
    $this->addField('password',['type'=>'password']);
    $this->addField('phone',['default'=>'+371']);
    $this->hasMany('Friends',new Friends);
  }
}

class Friends extends \atk4\data\Model {
    public $table = 'friends';
function init(){
    parent::init();
    $this->addField('name');
    $this->addField('surname');
    $this->addField('phone',['default'=>'+371']);
    $this->hasOne('zajemnik_id', new Zajemnik)->addTitle();
    $this->hasMany('Vozvrat',new Vozvrat())->addField('total_vozvrat',['aggregate'=>'sum', 'field'=>'value']);
    $this->hasMany('Zajm',new Zajm())->addField('total_zajm',['aggregate'=>'sum', 'field'=>'value']);
  }
}

class Zajm extends \atk4\data\Model {
    public $table = 'zajm';
function init(){
    parent::init();
    $this->addField('value',['type'=>'money']);
    $this->addField('date',['type'=>'date']);
    $this->hasOne('friends_id', new Zajemnik)->addTitle();
  }
}

class Vozvrat extends \atk4\data\Model {
    public $table = 'vozvrat';
function init(){
    parent::init();
    $this->addField('value',['type'=>'money']);
    $this->addField('date',['type'=>'date']);
    $this->hasOne('friends_id', new Zajemnik)->addTitle();
  }
}

class ReminderBox extends \atk4\ui\View {
    public $ui='piled segment';
    public function setModel(\atk4\data\Model $friends) {
        $this->add(['Header','Please repay my loan, '.$friends['name']]);
        $this->add(['Text','I have loaned you a total of ' . $friends['total_zajm']
        . '€ from which you still owe me ' . ($friends['total_zajm']-$friends['total_vozvrat']) . '€. Please pay back!']);
        $this->add(['Text','Thanks!']);
  }
}
