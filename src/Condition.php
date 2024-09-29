<?php

namespace src;

use src\factory\SampleFactory;

/**
 * @Author: 武帅祺
 * @Date: 2024/9/25
 * @Time：18:50
 * @Description：校验条件
 */
class Condition extends SampleFactory
{
    private int|float $lessThan;
    private int|float $greaterThan;
    private int|float|string|bool $equal;
    private array $between;
    private array $in;
    private string $like;
    private string $contain;

    public function __construct()
    {

    }

    public function checkCondition(null|int|float|string $value)
    {
        if (is_int($value)){
//            var_dump(is_integer($value));
            $a = $this->getGreaterThan()??null;
            var_dump($a);
            var_dump(null!=$this->getGreaterThan() );
        }
    }



    public function getLessThan(): float|int
    {
        return $this->lessThan;
    }

    public function getGreaterThan(): float|int
    {
        return $this->greaterThan;
    }

    public function getEqual(): float|bool|int|string
    {
        return $this->equal;
    }

    public function getBetween(): array
    {
        return $this->between;
    }

    public function getIn(): array
    {
        return $this->in;
    }

    public function getLike(): string
    {
        return $this->like;
    }

    public function getContain(): string
    {
        return $this->contain;
    }

    public function setLessThan(float|int $lessThan): Condition
    {
        $this->lessThan = $lessThan;
    }

    public function setGreaterThan(float|int $greaterThan): Condition
    {
        $this->greaterThan = $greaterThan;
        return $this;
    }

    public function setEqual(float|bool|int|string $equal): Condition
    {
        $this->equal = $equal;
        return $this;
    }

    public function setBetween(array $between): Condition
    {
        $this->between = $between;
        return $this;
    }

    public function setIn(array $in): Condition
    {
        $this->in = $in;
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

}