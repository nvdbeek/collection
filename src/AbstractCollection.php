<?php declare(strict_types = 1);

namespace Aeviiq\Collection;

use Aeviiq\Collection\Exception\InvalidArgumentException;
use Doctrine\Common\Collections\ArrayCollection as BaseArrayCollection;

abstract class AbstractCollection extends BaseArrayCollection implements Collection
{
    /**
     * @inheritdoc
     */
    public function __construct(array $elements = [])
    {
        parent::__construct();
        foreach ($elements as $key => $element) {
            $this->set($key, $element);
        }
    }

    /**
     * @inheritdoc
     */
    public function set($key, $value): void
    {
        $this->typeCheck($value);
        parent::set($key, $value);
    }

    /**
     * @inheritdoc
     */
    public function add($element): bool
    {
        $this->typeCheck($element);

        return parent::add($element);
    }

    public function first()
    {
        $first = parent::first();
        if (false === $first) {
            return null;
        }

        return $first;
    }

    public function last()
    {
        $last = parent::last();
        if (false === $last) {
            return null;
        }

        return $last;
    }

    /**
     * @return mixed[]
     */
    public function map(\Closure $func): array
    {
        return array_map($func, $this->toArray());
    }

    /**
     * @param mixed $element
     *
     * @throws InvalidArgumentException When the element is not of the expected type.
     */
    abstract protected function typeCheck($element): void;
}