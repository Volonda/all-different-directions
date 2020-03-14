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
     * @var string
     */
    private string $context;

    /**
     * @param string         $message
     * @param string         $context
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message, string $context, $code = 0, Throwable $previous = null)
    {
        $this->context = $context;

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function getContext(): string
    {
        return $this->context;
    }
}
