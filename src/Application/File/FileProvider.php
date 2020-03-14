<?php
declare(strict_types = 1);

namespace App\Application\File;

use App\Domain\PathResearch;
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
     * @return \Iterator<int,PathResearch>|PathResearch[]
     *
     * @throws \App\Domain\Exception\DomainException
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


        while(($line = \fgets($file)) !== false)
        {
            $line = \trim($line);

            if('' === $line)
            {
                continue;
            }

            if(true === \is_numeric($line))
            {
                $askedCount = (int) $line;

                if(\count($routes) > 0)
                {
                    $result = $this->createPathResearch($routes);

                    $routes = [];

                    yield $result;
                }

                continue;
            }

            if(0 === $askedCount)
            {
                yield from [];
            }

            $routes[] = new Row($line);

            $askedCount--;
        }

        \fclose($file);

        yield from [];
    }

    /**
     * @param Row[] $rows
     *
     * @return PathResearch
     *
     * @throws \App\Application\File\FileParserException
     * @throws \App\Domain\Exception\DomainException
     */
    private function createPathResearch(array $rows): PathResearch
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

        return new PathResearch($pathCollection);
    }
}
