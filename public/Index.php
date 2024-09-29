<?php

namespace public;


use src\Condition;
use src\Message;
use src\Validator;

spl_autoload_register(function ($className) {
    $loadClass = '../' . str_replace('\\', '/', $className) . '.php';
    require_once $loadClass;
});


$validator = Validator::build()
    ->addCheck(1, Condition::build(), Message::ofFail(200, '200也是错误'))
    ->addCheck(2, Condition::build(), Message::ofFail(300, "未来魔法校"))
    ->addCheck(3, Condition::build(), Message::ofFail(400, "400错误"));
$handleRes = $validator->handle();
if ($handleRes->isSuccess()){
    var_dump('成功');
}
