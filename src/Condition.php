<?php

namespace src;

use src\exception\ConditionTypeException;
use src\factory\SampleFactory;

/**
 * @Author: 武帅祺
 * @Date: 2024/9/25
 * @Time：18:50
 * @Description：校验条件
 */
class Condition extends SampleFactory
{
    private int|float $greaterThan;
    private int|float $lessThan;
    private int|float|string $equal;
    private string|int|float $betweenLeft;
    private string|int|float $betweenRight;
    private string $like;
    private string $contain;
    private array $in;

    /**
     * @desc 校验条件核心函数，目前仅支持int、float、string类型的值
     * @param int|float|string $value
     * @return bool
     */
    public function checkCondition(int|float|string $value): bool
    {
        if (is_int($value) || is_float($value) || is_double($value)) {
            return $this->_checkNumber($value);
        }
        if (is_string($value)) {
            return $this->_checkString($value);
        }
        return true;
    }

    private function _checkString(string $value): bool
    {
        return $this->_checkEqualThan($value)
            && $this->_checkBetween($value)
            && $this->_checkLike($value)
            && $this->_checkContains($value)
            && $this->_checkIn($value);
    }

    private function _checkNumber(int|float $value): bool
    {
        return $this->_checkGreaterThan($value)
            && $this->_checkLessThan($value)
            && $this->_checkEqualThan($value)
            && $this->_checkBetween($value)
            && $this->_checkIn($value);
    }

    private function _checkGreaterThan(int|float $value): bool
    {
        if (!isset($this->greaterThan)) {
            return true;
        }
        return $this->greaterThan <= $value;
    }

    private function _checkLessThan(int|float $value): bool
    {
        if (!isset($this->lessThan)) {
            return true;
        }
        return $this->lessThan >= $value;
    }

    private function _checkEqualThan(int|float|string $value): bool
    {
        if (!isset($this->equal)) {
            return true;
        }
        return $this->equal == $value;
    }

    private function _checkBetween(string|int|float $value): bool
    {
        if (!isset($this->betweenLeft) || !isset($this->betweenRight)) {
            return true;
        }
        return ($this->betweenLeft <= $value) && ($value <= $this->betweenRight);
    }

    private function _checkIn(string|int|float $value): bool
    {
        if (!isset($this->in)) {
            return true;
        }
        return in_array($value, $this->in);
    }

    private function _checkLike(string $value): bool
    {
        if (!isset($this->like)) {
            return true;
        }
        return str_contains($value, $this->contain);
    }

    private function _checkContains(string $value): bool
    {
        return $this->_checkLike($value);
    }

    public function setGreaterThan(float|int $greaterThan): Condition
    {
        $this->greaterThan = $greaterThan;
        return $this;
    }

    public function setLessThan(float|int $lessThan): Condition
    {
        $this->lessThan = $lessThan;
        return $this;
    }

    public function setEqual(float|int|string $equal): Condition
    {
        $this->equal = $equal;
        return $this;
    }

    /**
     * @throws ConditionTypeException
     */
    public function setBetweenLeft(float|int|string $betweenLeft): Condition
    {
        if (isset($this->betweenRight) && gettype($betweenLeft) != gettype($this->betweenRight)) {
            throw new ConditionTypeException('两值比较，类型必须相同');
        }
        $this->betweenLeft = $betweenLeft;
        return $this;
    }

    /**
     * @throws ConditionTypeException
     */
    public function setBetweenRight(float|int|string $betweenRight): Condition
    {
        if (isset($this->betweenLeft) && gettype($betweenRight) != gettype($this->betweenLeft)) {
            throw new ConditionTypeException('两值比较，类型必须相同');
        }
        $this->betweenRight = $betweenRight;
        return $this;
    }

    public function setLike(string $like): Condition
    {
        $this->like = $like;
        return $this;
    }

    public function setContain(string $contain): Condition
    {
        $this->contain = $contain;
        return $this;
    }

    public function setIn(array $in): Condition
    {
        $this->in = $in;
        return $this;
    }

}