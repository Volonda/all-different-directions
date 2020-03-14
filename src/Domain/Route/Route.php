<?php
declare(strict_types = 1);

namespace App\Domain\Route;

use App\Domain\Route\Instruction\Instruction;
use App\Domain\Route\Instruction\InstructionCollection;
use App\Domain\Type\Human;

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
     * @param Human $human
     *
     * @return bool
     */
    public function proceed(Human $human): void
    {
        /** @var Instruction $instruction */
        foreach($this->instructions as $instruction)
        {
            $instruction->apply($human);
        }

        $human->makeHasArrived();
    }
}