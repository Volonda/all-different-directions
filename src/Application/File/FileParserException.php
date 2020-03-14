<?php
declare(strict_types = 1);

namespace App\Application\File;

use App\Application\Exception\ApplicationException;
use Throwable;

/**
 * File parser exception
 */
class FileParserException extends ApplicationException
{
    /**
     * @var string|null
     */
    private ?string $context;

    /**
     * @param string         $message
     * @param string|null    $context
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message, ?string $context = null, $code = 0, Throwable $previous = null)
    {
        $this->context = $context;

        if(null !== $this->context)
        {
            $message = $message . ' (' . $this->context . ')';
        }

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string|null
     */
    public function getContext(): ?string
    {
        return $this->context;
    }
}
