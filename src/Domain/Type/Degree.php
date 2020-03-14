<?php
declare(strict_types = 1);

namespace App\Domain\Type;

use App\Domain\Exception\DomainException;

/**
 * Курс
 */
class Degree
{
    /**
     * Градусы
     *
     * @var float
     */
    private float $degree;

    /**
     * @param float $degree
     *
     * @throws DomainException
     */
    public function __construct(float $degree)
    {
        if(\abs($degree) > 360.0)
        {
            throw new DomainException('Угол может быть от -360 до +360 граудсов');
        }

        $this->degree = $degree;
    }

    /**
     * @return float
     */
    public function value(): float
    {
        return $this->degree;
    }
}