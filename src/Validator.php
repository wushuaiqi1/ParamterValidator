<?php

namespace src;

use CheckException;

/**
 * @Author: 武帅祺
 * @Date: 2024/9/25
 * @Time：19:06
 * @Description：参数校验器
 */
class Validator
{
    private CheckNode $rootNode;

    private function __construct()
    {

    }

    public static function build(): Validator
    {
        return new Validator();
    }

    public function addCheck(mixed $source, Condition $condition, Message $message): Validator
    {
        if (!isset($this->rootNode)) {
            $this->rootNode = CheckNode::buildWithParam($source, $condition, $message);
            return $this;
        }
        $this->rootNode->appendCheckNode($source, $condition, $message);
        return $this;
    }

    /**
     * 全局校验器，按照节点顺序进行校验，全部校验通过将返回成功
     * @return Message 提示信息
     */
    public function handle(): Message
    {
        $curNode = $this->rootNode;
        while ($curNode != null) {
            // 处理当前工作节点
            $message = $curNode->handleNode($curNode);
            if (!$message->isSuccess()) {
                return $message;
            }
            // 获取下一个工作节点
            $curNode = $curNode->getNextCheckNode();
        }
        return Message::ofSuccess();
    }
}