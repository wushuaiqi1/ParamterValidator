<?php

namespace tests;

use src\Condition;
use src\Message;
use src\Validator;

require_once '../public/Index.php';

$condition1 = Condition::build()
    ->setEqual(1)
    ->setBetweenLeft(0)
    ->setBetweenRight(1)
    ->setIn([1, 2, 3])
    ->setGreaterThan(0)
    ->setLessThan(10);
$validator1 = Validator::build()
    ->addCheck(1, $condition1, Message::ofFail(300, "传入int值不合法"));
var_dump($validator1->handle());

$condition2 = Condition::build()
    ->setIn(['magic', 'school', 'course', 'like'])
    ->setContain('like')
    ->setEqual('like')
    ->setBetweenLeft('a')
    ->setBetweenRight('z');
$validator2 = Validator::build()
    ->addCheck('like', $condition2, Message::ofFail(300, "传入int值不合法"));
var_dump($validator2->handle());


var_dump('like' > 'a');


