<?php
declare(strict_types = 1);

namespace App\Domain\Route\Instruction;


use App\Domain\Type\Degree;
use App\Domain\Type\Human;

/**
 * Инструкция повернуться
 */
final class TurnInstruction implements Instruction
{
    /**
     * @var Degree
     */
    private Degree $degree;

    /**
     * @param Degree $degree
     */
    public function __construct(Degree $degree)
    {
        $this->degree = $degree;
    }

    /**
     * @param Human $human
     */
    public function apply(Human $human): void
    {
        $human->changeCourse(new Degree($human->currentCourse()->value() + $this->degree->value()));
    }
}