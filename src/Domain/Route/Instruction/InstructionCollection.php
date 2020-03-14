<?php
declare(strict_types = 1);

namespace App\Domain\Route\Instruction;

/**
 * Коллекция инструкций
 */
class InstructionCollection extends \ArrayIterator
{
    /**
     * @param Instruction[] $collection
     */
    public function __construct(array $collection)
    {
        foreach($collection as $entry)
        {
            \assert($entry instanceof Instruction);
        }

        parent::__construct($collection);
    }

    /**
     * @param Instruction $value
     */
    public function append($value): void
    {
        \assert($value instanceof Instruction);

        parent::append($value);
    }
}