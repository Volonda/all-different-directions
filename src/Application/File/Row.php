<?php
declare(strict_types = 1);

namespace App\Application\File;

use App\Domain\Route\Instruction\InstructionCollection;
use App\Domain\Route\Instruction\TurnInstruction;
use App\Domain\Route\Instruction\WalkInstruction;
use App\Domain\Type\Degree;
use App\Domain\Type\Distance;
use App\Domain\Type\Location;

/**
 * Test case row parser
 */
class Row
{
    /**
     * walk type
     */
    private const WALK_INSTRUCTION = 'walk';

    /**
     * turn type
     */
    private const TURN_INSTRUCTION = 'turn';

    /**
     * raw file line data
     *
     * @var string
     */
    private string $data;

    /**
     * @param string $rawData
     */
    public function __construct(string $rawData)
    {
        $this->data = $rawData;
    }

    /**
     * @return InstructionCollection
     * @throws FileParserException
     * @throws \App\Domain\Exception\DomainException
     */
    public function instructions(): InstructionCollection
    {
        $instructionsData = \preg_split('#start[\d\.\- ]+#', $this->data);

        if(false === isset($instructionsData[1]))
        {
            throw new FileParserException('failed to parse instructions', $this->data);
        }

        $matches = [];
        \preg_match_all('#(?:[ ]*([\w]+)[ ]+([\d\.\-]+))#', $instructionsData[1], $matches);


        $collection = new InstructionCollection();

        if(false === isset($matches[1]))
        {
            throw new FileParserException(
                'failed to parse instructions. Failed to parse instruction type',
                $this->data
            );
        }

        if(false === isset($matches[2]))
        {
            throw new FileParserException(
                'failed to parse instructions. Failed to parse instruction value',
                $this->data
            );
        }

        foreach($matches[1] as $key => $type)
        {
            $value = $matches[2][$key] ?? null;

            if(false === \is_numeric($matches[2][$key]))
            {
                throw new FileParserException(
                    \sprintf('failed to parse instructions. Unsupported instruction type %s', $value),
                    $this->data
                );
            }

            if(self::WALK_INSTRUCTION === $type)
            {
                $collection->append(new WalkInstruction(new Distance((float) $value)));
            }
            else if(self::TURN_INSTRUCTION === $type)
            {
                $collection->append(new TurnInstruction(new Degree((float) $value)));
            }
        }

        return $collection;
    }

    /**
     * @return Location
     * @throws FileParserException
     * @throws \App\Domain\Exception\DomainException
     */
    public function initialLocation(): Location
    {
        $matches = [];

        \preg_match('#([\d.\-]+)[ ]+([\d.\-]+)[ ]+start#', $this->data, $matches);

        if(false === isset($matches[1]) || false === \is_numeric($matches[1]))
        {
            throw new FileParserException('failed to parse initial X coordinate', $this->data);
        }

        if(false === isset($matches[2]) || false === \is_numeric($matches[2]))
        {
            throw new FileParserException('failed to parse initial Y coordinate', $this->data);
        }

        return new Location((float) $matches[1], (float) $matches[2]);
    }

    /**
     * @return Degree
     * @throws FileParserException
     * @throws \App\Domain\Exception\DomainException
     */
    public function initialCourse(): Degree
    {
        $matches = [];

        \preg_match('#start[ ]+([\d.\-]+)#', $this->data, $matches);

        if(false === isset($matches[1]) || false === \is_numeric($matches[1]))
        {
            throw new FileParserException('failed to parse initial course', $this->data);
        }

        return new Degree((float) $matches[1]);
    }
}
