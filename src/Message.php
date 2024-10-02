<?php

namespace src;
/**
 * @Author: 武帅祺
 * @Date: 2024/9/25
 * @Time：18:49
 * @Description：消息结构
 */
class Message
{
    private int $code;
    private string $message;

    private function __construct(int $code, string $message)
    {
        $this->code = $code;
        $this->message = $message;
    }

    public static function ofSuccess(): Message
    {
        return new Message(200, "success");
    }

    public static function ofFail(int $code, string $message): Message
    {
        if ($code == 200) {
            $code = 400;
        }
        return new Message($code, $message);
    }

    public function isSuccess(): bool
    {
        return $this->code == 200;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}