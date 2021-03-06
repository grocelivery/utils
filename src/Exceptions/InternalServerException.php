<?php

declare(strict_types=1);

namespace Grocelivery\Utils\Exceptions;

use Exception;
use Grocelivery\Utils\Interfaces\ResponseExceptionInterface;
use Illuminate\Http\Response;

/**
 * Class InternalServerException
 * @package Grocelivery\Utils\Exceptions
 */
class InternalServerException extends Exception implements ResponseExceptionInterface
{
    /** @var string */
    protected $message = "Internal server error.";
    /** @var int */
    protected $code = Response::HTTP_INTERNAL_SERVER_ERROR;
    /** @var array */
    private $errors = [];

    /**
     * @param string $message
     * @return ResponseExceptionInterface
     */
    public function setMessage(string $message): ResponseExceptionInterface
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     * @return ResponseExceptionInterface
     */
    public function setErrors(array $errors): ResponseExceptionInterface
    {
        $this->errors = $errors;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    /**
     * @param string $error
     * @return ResponseExceptionInterface
     */
    public function addError(string $error): ResponseExceptionInterface
    {
        $this->errors[] = $error;
        return $this;
    }
}
