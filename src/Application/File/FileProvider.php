<?php
declare(strict_types = 1);

namespace App\Application\File;

use App\Application\Exception\ApplicationException;
use App\Domain\PathResearch;
use App\Tests\Domain\PathResearchTest;

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

            if(true === empty($line))
            {
                continue;
            }

            if(true === \is_numeric($line))
            {
                $askedCount = (int) $line;

                if(\count($routes) > 0)
                {
                    $result = $this->createTestCaseData($routes);

                    $routes = [];

                    yield $result;
                }
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

    private function createTestCaseData(array $rows): PathResearch
    {
        foreach($rows as $row)
        {
          var_dump($row);
          die();
        }

        new PathResearch();
    }
}
