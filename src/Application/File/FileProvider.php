<?php
declare(strict_types = 1);

namespace App\Application\File;

use App\Application\Exception\ApplicationException;
use App\Domain\PathResearcher;
use App\Domain\PotentialPath;
use App\Domain\Route\Route;
use App\Domain\Route\RoutePointer;

/**
 * File test cases extractor
 */
class FileProvider
{
    /**
     * @var string
     */
    private string $path;

    /**
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * Iterate test data
     *
     * @return \Iterator<int,PathResearcher>|PathResearcher[]
     *
     * @throws ApplicationException
     */
    public function iterate(): \Iterator
    {
        if(false === \file_exists($this->path))
        {
            throw new ApplicationException(\sprintf('file %s not found', $this->path));
        }

        $file = \fopen($this->path, "r");

        if(false === $file)
        {
            throw new ApplicationException(\sprintf('failed to read file %s', $this->path));
        }

        $askedCount = 0;
        $routes = [];
        $lineNumber = 0;

        while(($line = \fgets($file)) !== false)
        {
            $lineNumber++;
            $line = \trim($line);

            if('' === $line)
            {
                continue;
            }

            if(0 === $askedCount)
            {
                if(true === \is_numeric($line))
                {
                    if(0 === $askedCount = (int) $line)
                    {
                        break;
                    }

                    //skip line with asked questions count
                    continue;
                }
                else
                {
                    throw new FileParserException(
                        \sprintf('Expected row with questions count in line %d', $lineNumber),
                        $line
                    );
                }
            }

            $routes[] = new Row($line);

            $askedCount--;

            if(0 === $askedCount)
            {
                $result = $this->createPathResearch($routes);

                $routes = [];

                yield $result;
            }
        }

        if(0 !== $askedCount)
        {
            throw new FileParserException(\sprintf('last test missed cases count %d', $askedCount));
        }

        \fclose($file);

        //if empty file
        yield from [];
    }

    /**
     * @param Row[] $rows
     *
     * @return PathResearcher
     *
     * @throws \App\Application\File\FileParserException
     */
    private function createPathResearch(array $rows): PathResearcher
    {
        $pathCollection = [];

        foreach($rows as $row)
        {
            $pathCollection[] = new PotentialPath(
                new RoutePointer(
                    $row->initialLocation(),
                    $row->initialCourse()
                ),
                new Route($row->instructions())
            );
        }

        return new PathResearcher($pathCollection);
    }
}
