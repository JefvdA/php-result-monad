<?php

declare(strict_types=1);

namespace JefvdA\PhpResultMonad;

use Exception;

/**
 * Represents the result of an action. <br>
 * Can be created from:
 *  - A value with a generic datatype
 *  - An exception
 *
 * @template T
 *
 * @package Jefvda/PhpResultMonad
 */
final readonly class Result
{
    /**
     * @param T|null $value The value associated with the result.
     * @param Exception|null $exception The exception that explains why the result was not successful
     * @param bool $isSuccess Indicates whether the action was successful
     */
    private function __construct(
        private mixed $value,
        private ?Exception $exception,
        private bool $isSuccess,
    ) {
    }

    /**
     * @param T $value The value associated with the result
     * @return Result<T> The successful Result which includes the value
     */
    public static function createFromValue(mixed $value): self
    {
        return new self(
            $value,
            null,
            true,
        );
    }

    /**
     * @param Exception $exception The exception that explains why the result was not successful
     * @return Result<null> The not successful Result that includes the exception
     */
    public static function createFromException(Exception $exception): self
    {
        return new self(
            null,
            $exception,
            false,
        );
    }

    /**
     * @return T|null The value associated with the result
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    /**
     * @return Exception|null The exception that explains why the result was not successful
     */
    public function getException(): ?Exception
    {
        return $this->exception;
    }

    /**
     * @return bool Indicates whether the action was successful
     */
    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    /**
     * @param callable $valueCallback The callback that will be called with the Result's value if the Result is successful
     * @param callable $exceptionCallback The callback that will be called with the Result's exception if the Result is not successful
     * @return mixed The return value of the callback that has been called
     */
    public function match(callable $valueCallback, callable $exceptionCallback): mixed
    {
        if ($this->isSuccess())
        {
            return $valueCallback($this->getValue());
        }
        else
        {
            return $exceptionCallback($this->getException());
        }
    }
}
