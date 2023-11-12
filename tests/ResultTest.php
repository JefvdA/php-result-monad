<?php

declare(strict_types=1);

namespace JefvdA\PhpResultMonad\Tests;

use Exception;
use Jefvda\PhpResultMonad\Result;
use PHPUnit\Framework\TestCase;

final class ResultTest extends TestCase
{
    public function testCreateFromValueReturnsCorrectResultThatIsOk(): void
    {
        $value = 'This is the value of the result!';
        $result = Result::createFromValue($value);

        self::assertEquals($value, $result->getValue());
        self::assertNull($result->getException());
        self::assertTrue($result->isOk());
    }

    public function testCreateFromExceptionReturnsCorrectResultThatIsNotOk(): void
    {
        $exception = new Exception('This is the exception of the result!');
        $result = Result::createFromException($exception);

        self::assertNull($result->getValue());
        self::assertEquals($exception, $result->getException());
        self::assertFalse($result->isOk());
    }
}
