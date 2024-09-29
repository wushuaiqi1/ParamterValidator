<?php

namespace src;

use src\factory\SampleFactory;

/**
 * @Author: 武帅祺
 * @Date: 2024/9/25
 * @Time：18:43
 * @Description：参数校验节点数据结构
 */
class CheckNode extends SampleFactory
{
    private null|int|float|string $value;

    private Condition $condition;
    private Message $message;

    private CheckNode $nextCheckNode;



    public function handleNode(CheckNode &$node)
    {
        $value = $node->getValue();
        $node->getCondition()->checkCondition($value);
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

    public function getValue(): mixed
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
