<?php
declare(strict_types = 1);

namespace App\Domain\Route\Instruction;

use App\Domain\Type\Human;

/**
 * Инструкция
 */
interface Instruction
{
    /**
     * @param Human $human
     */
    public function apply(Human $human): void;
}