<?php
declare(strict_types = 1);

namespace App\Domain\Route;

use App\Domain\Route\Instruction\Instruction;
use App\Domain\Route\Instruction\InstructionCollection;

class Route
{
    /**
     * @var InstructionCollection
     */
    private InstructionCollection $instructions;

    /**
     * @param InstructionCollection $instructions
     */
    public function __construct(InstructionCollection $instructions)
    {
        $this->instructions = $instructions;
    }

    /**
     * @param RoutePointer $pointer
     *
     * @return bool
     */
    public function proceed(RoutePointer $pointer): void
    {
        /** @var Instruction $instruction */
        foreach($this->instructions as $instruction)
        {
            $instruction->apply($pointer);
        }

        $pointer->makeHasArrived();
    }
}