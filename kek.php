<?php

$id=$_GET['id'];
session_start();
$_SESSION['id']=$id;
header('Location: dvacruda.php');
