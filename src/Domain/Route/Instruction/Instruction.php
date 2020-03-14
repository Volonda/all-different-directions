<?php
declare(strict_types = 1);

namespace App\Domain\Route\Instruction;

use App\Domain\Route\RoutePointer;

/**
 * Route instruction
 *
 * How to change current position state
 */
interface Instruction
{
    /**
     * @param RoutePointer $pointer
     */
    public function apply(RoutePointer $pointer): void;
}