<?php

namespace src;

use CheckException;
use src\factory\SampleFactory;

/**
 * @Author: 武帅祺
 * @Date: 2024/9/25
 * @Time：18:43
 * @Description：参数校验节点数据结构
 */
class CheckNode extends SampleFactory
{
    private int|float|string $value;
    private Condition $condition;
    private Message $message;
    private CheckNode $nextCheckNode;

    /**
     *  单节点处理
     * @param CheckNode $node 当前节点
     * @return Message 返回结果，校验通过返回成功，否则返回失败
     */
    public function handleNode(CheckNode &$node): Message
    {
        $checkRes = $node->getCondition()->checkCondition($node->getValue());
        if (!$checkRes) {
            return $this->message;
        }
        return Message::ofSuccess();
    }


    public function appendCheckNode(mixed $value, Condition $condition, Message $message): void
    {
        if (!isset($this->nextCheckNode)) {
            $this->nextCheckNode = self::buildWithParam($value, $condition, $message);
            return;
        }
        // 当前节点存在next值
        $cur = $this->nextCheckNode;
        while (true) {
            if (!isset($cur->nextCheckNode)) {
                $cur->nextCheckNode = self::buildWithParam($value, $condition, $message);
                return;
            }
            $cur = $cur->nextCheckNode;
        }
    }

    public static function buildWithParam(mixed $value, Condition $condition, Message $message): CheckNode
    {
        return self::build()
            ->setValue($value)
            ->setCondition($condition)
            ->setMessage($message);
    }

    public function setValue(mixed $value): CheckNode
    {
        $this->value = $value;
        return $this;
    }

    public function setCondition(Condition $condition): CheckNode
    {
        $this->condition = $condition;
        return $this;
    }

    public function setMessage(Message $message): CheckNode
    {
        $this->message = $message;
        return $this;
    }

    public function getValue(): string|int|float
    {
        return $this->value;
    }

    public function getCondition(): Condition
    {
        return $this->condition;
    }

    public function getMessage(): Message
    {
        return $this->message;
    }

    public function getNextCheckNode(): CheckNode|null
    {
        return $this->nextCheckNode ?? null;
    }

}
