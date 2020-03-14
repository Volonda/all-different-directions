<?php
declare(strict_types = 1);

namespace App\Domain\Route\Instruction;

use App\Domain\Type\Degree;
use App\Domain\Route\RoutePointer;

/**
 * Instruction to change course
 *
 * Turning on current place
 */
final class TurnInstruction implements Instruction
{
    /**
     * @var Degree
     */
    private Degree $degree;

    /**
     * @param Degree $degree - units to turn
     */
    public function __construct(Degree $degree)
    {
        $this->degree = $degree;
    }

    /**
     * @param RoutePointer $pointer
     *
     * @throws \App\Domain\Exception\DomainException
     */
    public function apply(RoutePointer $pointer): void
    {
        $pointer->changeCourse(new Degree($pointer->currentCourse()->value() + $this->degree->value()));
    }
}