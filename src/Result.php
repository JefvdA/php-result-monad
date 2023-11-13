<?php

declare(strict_types=1);

namespace Jefvda\PhpResultMonad;

use Exception;

/**
 * @template T
 */
final readonly class Result
{
    /**
     * @param T|null $value
     */
    public function __construct(
        private mixed $value,
        private ?Exception $exception,
        private bool $isOk,
    ) {
    }

    /**
     * @param T $value
     * @return Result<T> self
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
     * @return Result<null> self
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
     * @return T|null
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    public function getException(): ?Exception
    {
        return $this->exception;
    }

    public function isOk(): bool
    {
        return $this->isOk;
    }

    public function match(callable $valueCallback, callable $exceptionCallback): mixed
    {
        if ($this->isOk()) {
            return $valueCallback($this->getValue());
        } else {
            return $exceptionCallback($this->getException());
        }
    }
}
