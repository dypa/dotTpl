<?php
include 'view.php';

$tpl = new \dotTpl\View('test.tpl');
$tpl['var'] = 123;
$tpl->test = 456;
//var_dump($tpl);
echo $tpl;
//var_dump(get_class_methods($tpl));
